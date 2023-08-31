<?php

namespace App\Http\Controllers;

use App\Models\CommercialOffer;
use App\Models\CommercialOffersManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommercialOffersManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'requirements_determination' => 'required|string',
            //'current_status' => 'required|string',
            'requirements_verification' => 'nullable|string',
            'commercial_offer_id' => 'required|exists:commercial_offers,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }



        $created = CommercialOffersManagement::create([
            'requirements_determination' => $request->post('requirements_determination'),
            //'current_status' => $request->post('current_status'),
            'requirements_verification' => $request->post('requirements_verification'),
            'commercial_offer_id' => $request->post('commercial_offer_id')
        ]);

        if($created){
            return response()->json([
                "status" => true,
                "message" => "created sucessfully",
                "data" => $created
            ],201);
        }else{
            return response()->json([
                "status" => false,
                "message" => "cannot create"
            ],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommercialOffersManagement  $CommercialOffersManagement
     * @return \Illuminate\Http\Response
     */
    public function show(CommercialOffersManagement $CommercialOffersManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommercialOffersManagement  $CommercialOffersManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $CommercialOffersManagement)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            //'requirements_determination' => 'required|string',
            'current_status' => 'nullable|string',
            //'requirements_verification' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $updated = CommercialOffersManagement::where('id', $CommercialOffersManagement)->update([
            //'requirements_determination' => $request->post('requirements_determination'),
            'current_status' => $request->post('current_status'),
            //'requirements_verification' => $request->post('requirements_verification'),
            //'commercial_offer_id' => $request->post('commercial_offer_id')
        ]);

        if($updated){
            return response()->json([
                "status" => true,
                "message" => "update sucessfully",
            ],201);
        }else{
            return response()->json([
                "status" => false,
                "message" => "cannot update"
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommercialOffersManagement  $CommercialOffersManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommercialOffersManagement $CommercialOffersManagement)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommercialOffersManagement  $CommercialOffersManagement
     * @return \Illuminate\Http\Response
     */
    public function showByIdCommercialOffer($id_commercial_offer)
    {
        $commercial_offer = CommercialOffer::where(['id' => $id_commercial_offer])->first();
        if(is_null($commercial_offer)){
            return response()->json([
                "data" => [],
            ]);
        }

        $commercial_offer->commercial_offers_management;
        $commercial_offer->commercial_offers_management->commercial_offers_management_files;

        return response()->json([
            "data" => $commercial_offer,
        ]);
    }
}
