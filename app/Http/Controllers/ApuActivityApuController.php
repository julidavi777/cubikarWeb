<?php

namespace App\Http\Controllers;

use App\Models\ApuActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApuActivityApuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $apus = ApuActivity::with('apu')->where('id', $id)
                ->get()
                ->pluck('apu')
                ->values();

        return response()->json(["data" => $apus]);
    }
}
