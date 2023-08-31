<?php

namespace App\Http\Controllers;

use App\Models\CommercialOffer;
use App\Models\ProjectManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectManagementController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'gantt_schema' => 'required|array',
            'commercial_offer_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $found_project_management = ProjectManagement::where('commercial_offer_id', $request->post("commercial_offer_id"))->first();
        
        if(isset($found_project_management)){


            $found_project_management->gantt_schema = json_encode($request->post("gantt_schema"))  ;


            $updated = $found_project_management->update();
    
            if ($updated) {
                return response()->json([
                    "status" => true,
                    "message" => "updated sucessfully"
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "cannot update"
                ], 400);
            }

        }else{

            $validator = Validator::make($data, [
                'commercial_offer_id' => 'required|integer|unique:project_managements,commercial_offer_id',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            
            $created = ProjectManagement::insert([
                "gantt_schema" => json_encode($request->post("gantt_schema")) ,
                "commercial_offer_id" => $request->post("commercial_offer_id"),
            ]);
    
            if ($created) {
                return response()->json([
                    "status" => true,
                    "message" => "created sucessfully"
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "cannot create"
                ], 400);
            }
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectManagement  $projectManagement
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectManagement $projectManagement)
    {
        //
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectManagement  $projectManagement
     * @return \Illuminate\Http\Response
     */
    public function showByIdCommercialOffer($id)
    {
        $commmercial_offer = CommercialOffer::with('project_management')->where('id', $id)->first();

        $schema = [];
        if(isset($commmercial_offer->project_management)){
            $schema =  $commmercial_offer->project_management->gantt_schema;
            return response()->json([
                "data" => json_decode($schema)
            ]);
        }
        return response()->json([
            "data" =>  $schema
        ]);


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectManagement  $projectManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectManagement $projectManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectManagement  $projectManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectManagement $projectManagement)
    {
        //
    }
}
