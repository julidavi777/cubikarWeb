<?php

namespace App\Http\Controllers;

use App\Models\Apu;
use App\Models\ApuActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, 
            [
                'schema' => 'required|json',
                'apu_activity_id' => 'required|exists:apu_activities,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if(Apu::where('apu_activity_id', $data['apu_activity_id'])->count() > 0){
            Apu::where('apu_activity_id', $data['apu_activity_id'])->update(
                ['schema' => $data['schema'],]
            );
            return response()->json([
                "message" => "updated successfully"
            ], 200);
        }

        $created = Apu::insert([
            'schema' => $data['schema'],
            'apu_activity_id' => $data['apu_activity_id']
        ]);

        return response()->json([
            "message" => "created"
        ], 201);
    }
}
