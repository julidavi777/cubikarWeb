<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomersContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with('customersContacts')->get()->sortBy('name')->values();
  
        return $this->showAll($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'identification_type' => 'required|integer',
            'identification' => 'required|integer|unique:customers',
            'digit_v' => 'nullable|integer',
            'name' => 'nullable|string|max:50',
            'surname' => 'nullable|string|max:50',
            'phone_number' => 'required|integer',
            'address' => 'required|string|max:50',
            'municipio_id' => 'required|integer|exists:municipios,id',
            'departamento_id' => 'required|integer|exists:departamentos,id',
            'email' => 'required|string',
            /* 'nombre_contacto_comercial' => 'required|string',
            'commercial_contact_1' => 'required|integer',
            'commercial_contact_2' => 'nullable|integer',
            'commercial_contact_3' => 'nullable|integer', */
            'form_contacto1' => 'nullable|json',
            'form_contacto2' => 'nullable|json',
            'form_contacto_facturacion' => 'nullable|json',
            'form_contacto_pagos' => 'nullable|json',
            'razon_social' => 'nullable|string|max:50',
            'razon_comercial' => 'nullable|string|max:50',
            'rut_file' => 'nullable|file|mimes:doc,docx,jpg,png,pdf',
            'camara_commerce_file' => 'nullable|file|mimes:doc,docx,jpg,png,pdf',
            'income_statement_file' => 'nullable|file|mimes:doc,docx,jpg,png,pdf',
            'cliente_logo' => 'nullable|file|mimes:jpg,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return DB::transaction(function() use ($request) {
            try{

        //SAVING FILES

            $rut_file_json_urls = null;
        if ($request->hasFile('rut_file')) {
            $file = $request->file('rut_file');
            $rut_file_json_urls = $this->saveFile($file, 'customersFiles');

        }

        $camara_commerce_file_json_urls = null;
        if ($request->hasFile('camara_commerce_file')) {
            $file = $request->file('camara_commerce_file');
            $camara_commerce_file_json_urls = $this->saveFile($file, 'customersFiles');

        }

        $income_statement_file_json_urls = null;
        if ($request->hasFile('income_statement_file')) {
            $file = $request->file('income_statement_file');
            $income_statement_file_json_urls = $this->saveFile($file, 'customersFiles');

        }

        $cliente_logo_file_json_urls = null;
        if ($request->hasFile('cliente_logo')) {
            $file = $request->file('cliente_logo');
            $cliente_logo_file_json_urls = $this->saveFile($file, 'customersFiles');

        }


        $customer_created = Customer::create([
            'identification_type' => $request->post('identification_type'),
            'identification' => $request->post('identification'),
            'digit_v' => $request->post('digit_v'),
            'name' => $request->post('name'),
            'surname' => $request->post('surname'),
            'phone_number' => $request->post('phone_number'),
            'address' => $request->post('address'),
            'municipio_id' => $request->post('municipio_id'),
            'departamento_id' => $request->post('departamento_id'),
            'email' => $request->post('email'),
            /* 'nombre_contacto_comercial' => $request->post('nombre_contacto_comercial'),
            'commercial_contact_1' => $request->post('commercial_contact_1'),
            'commercial_contact_2' => $request->post('commercial_contact_2'),
            'commercial_contact_3' => $request->post('commercial_contact_3'), */
            'razon_social' => $request->post('razon_social'),
            'razon_comercial' => $request->post('razon_comercial'),
            'rut_file' => $rut_file_json_urls,
            'camara_commerce_file' => $camara_commerce_file_json_urls,
            'income_statement_file' => $income_statement_file_json_urls,
            'cliente_logo' => $cliente_logo_file_json_urls,
        ]);

        if(!is_null($request->post("form_contacto1"))){
            $data = json_decode($request->post("form_contacto1"));
            $data->customer_id = $customer_created->id;
            //dd($data);
            CustomersContact::insert((array) $data);
        }
        if(!is_null($request->post("form_contacto2"))){
            $data = json_decode($request->post("form_contacto2"));
            $data->customer_id = $customer_created->id;
            CustomersContact::insert((array) $data);
        }
        if(!is_null($request->post("form_contacto_facturacion"))){
            $data = json_decode($request->post("form_contacto_facturacion"));
            $data->customer_id = $customer_created->id;
            CustomersContact::insert((array) $data);
        }
        if(!is_null($request->post("form_contacto_pagos"))){
            $data = json_decode($request->post("form_contacto_pagos"));
            $data->customer_id = $customer_created->id;
            CustomersContact::insert((array) $data);
        }

        if($customer_created){
            return response()->json([
                "status" => true,
                "message" => "created sucessfully"
            ],201);
        }else{
            DB::rollback();
            return response()->json([
                "status" => false,
                "message" => "cannot create"
            ],400);
        }
        } catch (\Exception $ex) {
        DB::rollback();
        // throw $ex;
        return response()->json(['status' => false, 'message' => 'something went wrong registro dog o usuario'.$ex], 400);
        }
      });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $this->showOne($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCustomer)
    {
        $customer = Customer::findOrFail($idCustomer);

        $data = $request->all();

        $validator = Validator::make($data, [
            'identification_type' => 'nullable|integer',
            'identification' => 'nullable|integer|unique:customers,identification,'.$customer->id,
            'digit_v' => 'nullable|integer',
            'name' => 'nullable|string|max:50',
            'surname' => 'nullable|string|max:50',
            'phone_number' => 'nullable|integer',
            'address' => 'nullable|string|max:50',
            'municipio_id' => 'nullable|integer|exists:municipios,id',
            'departamento_id' => 'nullable|integer|exists:departamentos,id',
            'email' => 'nullable|string',
            'form_contacto1' => 'nullable|json',
            'form_contacto2' => 'nullable|json',
            'form_contacto_facturacion' => 'nullable|json',
            'form_contacto_pagos' => 'nullable|json',
           /*  'nombre_contacto_comercial' => 'nullable|string',
            'commercial_contact_1' => 'nullable|integer',
            'commercial_contact_2' => 'nullable|integer',
            'commercial_contact_3' => 'nullable|integer', */
            'razon_social' => 'nullable|string|max:50',
            'razon_comercial' => 'nullable|string|max:50',
            'rut_file' => 'nullable|file|mimes:doc,docx,jpg,png,pdf',
            'camara_commerce_file' => 'nullable|file|mimes:doc,docx,jpg,png,pdf',
            'income_statement_file' => 'nullable|file|mimes:doc,docx,jpg,png,pdf',
            'cliente_logo' => 'nullable|file|mimes:jpg,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //return $data;
        return DB::transaction(function() use ($request, $customer) {
            try{
        //SAVING FILES

        $rut_file_json_urls = $customer->rut_file;
        if ($request->hasFile('rut_file')) {
            //DELETE FILE
            if(!is_null($customer->rut_file)){
                unlink(storage_path('app/'.$customer->rut_file['server_hash_name']));
            }

            //SAVE NEW FILE

            $file = $request->file('rut_file');
            $rut_file_json_urls = $this->saveFile($file, 'customersFiles');

        }

        $camara_commerce_file_json_urls = $customer->camara_commerce_file;
        if ($request->hasFile('camara_commerce_file')) {
            //DELETE FILE
            if(!is_null($customer->camara_commerce_file)){
                unlink(storage_path('app/'.$customer->camara_commerce_file['server_hash_name']));
            }

            //SAVE NEW FILE
            $file = $request->file('camara_commerce_file');
            $camara_commerce_file_json_urls = $this->saveFile($file, 'customersFiles');

        }

        $income_statement_file_json_urls = $customer->income_statement_file;
        if ($request->hasFile('income_statement_file')) {
            //DELETE FILE
            if(!is_null($customer->income_statement_file)){
                unlink(storage_path('app/'.$customer->income_statement_file['server_hash_name']));
            }

            //SAVE NEW FILE
            $file = $request->file('income_statement_file');
            $income_statement_file_json_urls = $this->saveFile($file, 'customersFiles');

        }

        $cliente_logo_file_json_urls = $customer->cliente_logo;
        if ($request->hasFile('cliente_logo')) {
            //DELETE FILE
            if(!is_null($customer->cliente_logo)){
                unlink(storage_path('app/'.$customer->cliente_logo['server_hash_name']));
            }

            //SAVE NEW FILE
            $file = $request->file('cliente_logo');
            $cliente_logo_file_json_urls = $this->saveFile($file, 'customersFiles');

        }

        $updated = Customer::where('id', $customer->id)->update([
            'identification_type' => $request->post('identification_type'),
            'identification' => $request->post('identification'),
            'digit_v' => $request->post('digit_v'),
            'name' => $request->post('name'),
            'surname' => $request->post('surname'),
            'phone_number' => $request->post('phone_number'),
            'address' => $request->post('address'),
            'municipio_id' => $request->post('municipio_id'),
            'departamento_id' => $request->post('departamento_id'),
            'email' => $request->post('email'),
           /*  'nombre_contacto_comercial' => $request->post('nombre_contacto_comercial'),
            'commercial_contact_1' => $request->post('commercial_contact_1'),
            'commercial_contact_2' => $request->post('commercial_contact_2'),
            'commercial_contact_3' => $request->post('commercial_contact_3'), */
            'razon_social' => $request->post('razon_social'),
            'razon_comercial' => $request->post('razon_comercial'),
            'rut_file' => $rut_file_json_urls,
            'camara_commerce_file' => $camara_commerce_file_json_urls,
            'income_statement_file' => $income_statement_file_json_urls,
            'cliente_logo' => $cliente_logo_file_json_urls,
        ]);

        if(!is_null($request->post("form_contacto1"))){
            $data = json_decode($request->post("form_contacto1"));
            //$data->customer_id = $customer_created->id;
            //CustomersContact::insert((array) $data);
            //dd($data);
            $recordFound = CustomersContact::where('customer_id', $customer->id)->where('customers_contact_type_id', 1)->first();

            if(!is_null($recordFound)){
                CustomersContact::where('customer_id', $customer->id)->where('customers_contact_type_id', 1)->update((array) $data);
            }else{
                $data->customer_id = $customer->id;
                $data->created_at = now();
                CustomersContact::insert((array) $data);
            }
        }
        if(!is_null($request->post("form_contacto2"))){
            $data = json_decode($request->post("form_contacto2"));

            $recordFound = CustomersContact::where('customer_id', $customer->id)->where('customers_contact_type_id', 2)->first();
            if(!is_null($recordFound)){
                CustomersContact::where('customer_id', $customer->id)->where('customers_contact_type_id', 2)->update((array) $data);
            }else{
                $data->customer_id = $customer->id;
                $data->created_at = now();
                CustomersContact::insert((array) $data);
            }
        }
        if(!is_null($request->post("form_contacto_facturacion"))){
            $data = json_decode($request->post("form_contacto_facturacion"));

            $recordFound = CustomersContact::where('customer_id', $customer->id)->where('customers_contact_type_id', 3)->first();
            if(!is_null($recordFound)){
                CustomersContact::where('customer_id', $customer->id)->where('customers_contact_type_id', 3)->update((array) $data);
            }else{
                $data->customer_id = $customer->id;
                $data->created_at = now();
                CustomersContact::insert((array) $data);
            }
        }
        if(!is_null($request->post("form_contacto_pagos"))){
            $data = json_decode($request->post("form_contacto_pagos"));

            $recordFound = CustomersContact::where('customer_id', $customer->id)->where('customers_contact_type_id', 4)->first();
            if(!is_null($recordFound)){
                CustomersContact::where('customer_id', $customer->id)->where('customers_contact_type_id', 4)->update((array) $data);
            }else{
                $data->customer_id = $customer->id;
                $data->created_at = now();
                CustomersContact::insert((array) $data);
            }
        }

        if ($updated) {
            return response()->json([
                "status" => true,
                "message" => "edited sucessfully"
            ], 200);
        } else {
            DB::rollback();
            return response()->json([
                "status" => false,
                "message" => "cannot edit"

            ], 400);

        }
        } catch (\Exception $ex) {
        DB::rollback();
        // throw $ex;
        return response()->json(['status' => false, 'message' => 'something went wrong registro dog o usuario'.$ex], 400);
        }
      });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function searchFilter(Request $request){
        $paramValue = $request->query('filterParam');
        $paramValueIdentification = $request->query('filterParamIdentification');

        if(!is_null($paramValueIdentification)){
            $customer = Customer::where('identification', $paramValueIdentification)->first();

            if(is_null($customer)){
                return response()->json(["data" => []]);
            }

            return $this->showOne($customer);
        }

        if(is_null($paramValue)){
            $customers = Customer::get();
            return $this->showAll($customers);
        }

        $customers = Customer::with('customersContacts')->where('identification', 'ilike', '%'.$paramValue.'%')->
                               orWhere('name', 'ilike', '%'.$paramValue.'%')->
                               orWhere('surname', 'ilike', '%'.$paramValue.'%')->
                               orWhere('razon_social', 'ilike', '%'.$paramValue.'%')->
                               orWhere('razon_comercial', 'ilike', '%'.$paramValue.'%')
                                ->get();

        return $this->showAll($customers);
    }
}
