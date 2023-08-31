<?php

namespace App\Http\Controllers;

use App\Models\ApuLaborAnalysisItem;
use App\Models\ApuLaborPrice;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ApuLaborPriceController extends Controller
{
    public function index()
    {
        $apuLaborAnalysisItems = ApuLaborPrice::with('chapter')->get();


        $apuLaborAnalysisItems = $apuLaborAnalysisItems->map(function ($item){


            $item['unit_value'] = $this->getDefinedValue($item["unit_price_eje_value"], $item["unit_price_bogota_value"], $item["unit_price_medellin_value"]);
            
            return $item;
         });

        return response()->json($apuLaborAnalysisItems);
    }

    public function getDefinedValue($var1, $var2, $var3) {
        if (isset($var1)) {
            return $var1;
        } elseif (isset($var2)) {
            return $var2;
        } elseif (isset($var3)) {
            return $var3;
        } else {
            return 0;
        }
    }

    public function show($id)
    {
        $apuLaborAnalysisItem = ApuLaborPrice::with('chapter')->findOrFail($id);

        return response()->json($apuLaborAnalysisItem);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'description' => 'required|string',
            'unit' => 'required|string',
            'unit_price_eje_value' => 'integer',
            'unit_price_bogota_value' => 'integer',
            'unit_price_medellin_value' => 'integer',
            'chapter_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $apuLaborAnalysisItem = ApuLaborPrice::create([
            'description' => $request->input('description'),
            'unit' => $request->input('unit'),
            'unit_price_eje_value' => $request->input('unit_price_eje_value'),
            'unit_price_bogota_value' => $request->input('unit_price_bogota_value'),
            'unit_price_medellin_value' => $request->input('unit_price_medellin_value'),
            'chapter_id' => $request->input('chapter_id'),
        ]);

        return response()->json($apuLaborAnalysisItem, 201);
       
    }

    public function update(Request $request, $id)
    { $data = $request->all();

        $validator = Validator::make($data, [
            'description' => 'required|string',
            'unit' => 'required|string',
            'unit_price_eje_value' => 'nullable|integer',
            'unit_price_bogota_value' => 'nullable|integer',
            'unit_price_medellin_value' => 'nullable|integer',
            'chapter_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $apuLaborAnalysisItem = ApuLaborPrice::findOrFail($id);
        $apuLaborAnalysisItem->description = $request->input('description', $apuLaborAnalysisItem->description);
        $apuLaborAnalysisItem->unit = $request->input('unit', $apuLaborAnalysisItem->unit);
        $apuLaborAnalysisItem->unit_price_eje_value = $request->input('unit_price_eje_value', $apuLaborAnalysisItem->unit_price_eje_value);
        $apuLaborAnalysisItem->unit_price_bogota_value = $request->input('unit_price_bogota_value', $apuLaborAnalysisItem->unit_price_bogota_value);
        $apuLaborAnalysisItem->unit_price_medellin_value = $request->input('unit_price_medellin_value', $apuLaborAnalysisItem->unit_price_medellin_value);
        $apuLaborAnalysisItem->chapter_id = $request->input('chapter_id', $apuLaborAnalysisItem->chapter_id);
        $apuLaborAnalysisItem->save();

        return response()->json($apuLaborAnalysisItem);
    }

    /* public function destroy($id)
    {
        $apuLaborAnalysisItem = ApuLaborAnalysisItem::findOrFail($id);
        $apuLaborAnalysisItem->delete();

        return response()->json(['message' => 'Apu Labor Analysis Item deleted successfully']);
    } */
}
