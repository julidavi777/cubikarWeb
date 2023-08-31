<?php

namespace App\Http\Controllers;

use App\Models\CommercialOffersManagementFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommercialOffersManagementFileController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_commercial_offer_management = $request->query('commercial_offer_management_id');
        if(!is_null($id_commercial_offer_management)){
            $files = CommercialOffersManagementFile::where('commercial_offers_management_id', $id_commercial_offer_management)->get();
        }else{
            $files = CommercialOffersManagementFile::get();
        }
        return $this->showAll($files);
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
            'file' => 'required|file|mimes:xlsx,doc,docx,jpg,png,pdf',
            'commercial_offers_management_id' => 'required|exists:commercial_offers_managements,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //SAVING FILES

        $file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file = $this->saveFile($file, 'commercialOffersManagementsFiles');
        }

        $created = CommercialOffersManagementFile::create([
            'file' => $file,
            'commercial_offers_management_id' => $request->post('commercial_offers_management_id') 
        ]);

        if($created){
            return response()->json([
                "status" => true,
                "message" => "created sucessfully"
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
     * @param  \App\Models\CommercialOffersManagementFile  $CommercialOffersManagementFile
     * @return \Illuminate\Http\Response
     */
    public function show(CommercialOffersManagementFile $CommercialOffersManagementFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommercialOffersManagementFile  $CommercialOffersManagementFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommercialOffersManagementFile $CommercialOffersManagementFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommercialOffersManagementFile  $CommercialOffersManagementFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommercialOffersManagementFile $CommercialOffersManagementFile)
    {
        //
    }
}
