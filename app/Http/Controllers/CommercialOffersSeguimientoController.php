<?php

namespace App\Http\Controllers;

use App\Models\CommercialOffersSeguimiento;
use App\Models\CommercialOffersSeguimientoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommercialOffersSeguimientoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commercialOffersSeguimientos = CommercialOffersSeguimiento::orderByDesc('id')->get();
        return $this->showAll($commercialOffersSeguimientos);
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
        
        $validationRules = [
            'status' => 'required|string',
            'description' => 'required|string',
            'commercial_offer_id' => 'required|integer|exists:commercial_offers,id',
            'probability' => 'required|string',
        ];
        
        if(intval($data['files_length']) > 0){
            for ($i=0; $i < $data['files_length']; $i++) { 
                $validationRules['file_'.$i] = 'file|mimes:xlsx,docx,jpg,png,pdf,zip,rar,dwg';
            }
        }
        
        $validator = Validator::make($data, $validationRules );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return DB::transaction(function() use ($request, $data) {

        $savedFilesManagement = [];
        try{
        
            $created_seguimiento = CommercialOffersSeguimiento::create([
                'status' => $request->post('status'),
                'description' => $request->post('description'),
                'commercial_offer_id' => $request->post('commercial_offer_id'),
                'probability' => $request->post('probability'),
            ]);


            if(intval($data['files_length']) > 0){
                //save seguimiento files
                for ($i=0; $i < intval($data['files_length']); $i++) { 
                   $file = null;
                   if ($request->hasFile('file_'.$i)) {
                       $file = $request->file('file_'.$i);
                       $file = $this->saveFile($file, 'commercialOffersSeguimientosFiles');
                       array_push($savedFilesManagement, $file['server_hash_name']);
                   }
       
                    CommercialOffersSeguimientoFile::create([
                       'file' => $file,
                       'commercial_offers_seguimiento_id' => $created_seguimiento['id']
                   ]);
               }
            }
        
            if($created_seguimiento){
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
            Storage::delete($savedFilesManagement);
            // throw $ex;
            return response()->json(['status' => false, 'message' => 'something went wrong registro dog o usuario'.$ex], 400);
        }});
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommercialOffersSeguimiento  $commercialOffersSeguimiento
     * @return \Illuminate\Http\Response
     */
    public function show(CommercialOffersSeguimiento $commercialOffersSeguimiento)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommercialOffersSeguimiento  $commercialOffersSeguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommercialOffersSeguimiento $commercialOffersSeguimiento)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommercialOffersSeguimiento  $commercialOffersSeguimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommercialOffersSeguimiento $commercialOffersSeguimiento)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByIdOffer($idOffer)
    {
        $commercialOffersSeguimientos = CommercialOffersSeguimiento::with('commercial_offers_seguimiento_files')->where('commercial_offer_id', $idOffer)->orderByDesc('id')->get();
        return $this->showAll($commercialOffersSeguimientos);
    }
}
