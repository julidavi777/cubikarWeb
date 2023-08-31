<?php

namespace App\Http\Controllers;

use App\Models\ApuTransportPrice;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApuTransportPriceController extends Controller
{
    public function index()
    {
        $apuTransportPrices = ApuTransportPrice::get();


        $apuTransportPrices = $apuTransportPrices->map(function ($item){


           $item['unit_value'] = $this->getDefinedValue($item["unit_price_eje_value"], $item["unit_price_bogota_value"], $item["unit_price_medellin_value"]);
           
           return $item;
        });

        return response()->json($apuTransportPrices);
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
        $apuTransportPrice = ApuTransportPrice::findOrFail($id);

        return response()->json($apuTransportPrice);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'description' => 'required|string',
                'unit' => 'required|string',
                'unit_price_eje_value' => 'integer',
                'unit_price_bogota_value' => 'integer',
                'unit_price_medellin_value' => 'integer',
            ]);

            $apuTransportPrice = ApuTransportPrice::create([
                'description' => $request->input('description'),
                'unit' => $request->input('unit'),
                'unit_price_eje_value' => $request->input('unit_price_eje_value'),
                'unit_price_bogota_value' => $request->input('unit_price_bogota_value'),
                'unit_price_medellin_value' => $request->input('unit_price_medellin_value'),
            ]);

            return response()->json($apuTransportPrice, 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'description' => 'string',
                'unit' => 'string',
                'unit_price_eje_value' => 'integer',
                'unit_price_bogota_value' => 'integer',
                'unit_price_medellin_value' => 'integer',
            ]);

            $apuTransportPrice = ApuTransportPrice::findOrFail($id);
            $apuTransportPrice->description = $request->input('description', $apuTransportPrice->description);
            $apuTransportPrice->unit = $request->input('unit', $apuTransportPrice->unit);
            $apuTransportPrice->unit_price_eje_value = $request->input('unit_price_eje_value', $apuTransportPrice->unit_price_eje_value);
            $apuTransportPrice->unit_price_bogota_value = $request->input('unit_price_bogota_value', $apuTransportPrice->unit_price_bogota_value);
            $apuTransportPrice->unit_price_medellin_value = $request->input('unit_price_medellin_value', $apuTransportPrice->unit_price_medellin_value);
            $apuTransportPrice->save();

            return response()->json($apuTransportPrice);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

   /*  public function destroy($id)
    {
        $apuTransportPrice = ApuTransportPrice::findOrFail($id);
        $apuTransportPrice->delete();

        return response()->json(['message' => 'Apu Transport Price deleted successfully']);
    } */
}
