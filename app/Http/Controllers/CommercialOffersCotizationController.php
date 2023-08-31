<?php

namespace App\Http\Controllers;

use App\Models\CommercialOffersCotization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommercialOffersCotizationController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commercialOffers = CommercialOffersCotization::get();

        $commercialOffers = $commercialOffers->sortBy('id')->values();

        return $this->showAll($commercialOffers);
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
            'valor_cotizado' => 'required|string|max:50',
            'observaciones' => 'required|string|max:50',
            'cotizacion_file' => 'required|file|mimes:xlsx,doc,docx,jpg,png,pdf',
            'commercial_offer_id' =>  'required|integer|exists:commercial_offers,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $contizacion_file_json_urls = null;
        if ($request->hasFile('cotizacion_file')) {
            $file = $request->file('cotizacion_file');
            $contizacion_file_json_urls = $this->saveFile($file, 'commercialOffersContizations');
        }
        
        $created = CommercialOffersCotization::create([
            'valor_cotizado' => $request->post('valor_cotizado'),
            'observaciones' => $request->post('observaciones'),
            'cotizacion_file' => $contizacion_file_json_urls,
            'commercial_offer_id' => $request->post('commercial_offer_id'),
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
     * @param  \App\Models\CommercialOffersCotization  $commercialOffersCotization
     * @return \Illuminate\Http\Response
     */
    public function show(CommercialOffersCotization $commercialOffersCotization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommercialOffersCotization  $commercialOffersCotization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommercialOffersCotization $commercialOffersCotization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommercialOffersCotization  $commercialOffersCotization
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommercialOffersCotization $commercialOffersCotization)
    {
        //
    }
}
