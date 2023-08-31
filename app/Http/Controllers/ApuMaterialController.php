<?php

namespace App\Http\Controllers;

use App\Models\ApuMaterial;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApuMaterialController extends Controller
{
    public function index()
    {
        $apuMaterials = ApuMaterial::with('chapter')->limit(100)->get();

        return response()->json($apuMaterials);
    }

    public function show($id)
    {
        $apuMaterial = ApuMaterial::with('chapter')->findOrFail($id);

        return response()->json($apuMaterial);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'code' => 'nullable|string',
                'description' => 'required|string',
                'unit' => 'required|string',
                'unit_value' => 'required|integer',
                'reference_link' => 'nullable|string',
                'chapter_id' => 'required|integer',
            ]);

            $apuMaterial = ApuMaterial::create([
                'code' => $request->input('code'),
                'description' => $request->input('description'),
                'unit' => $request->input('unit'),
                'unit_value' => $request->input('unit_value'),
                'reference_link' => $request->input('reference_link'),
                'chapter_id' => $request->input('chapter_id'),
            ]);

            return response()->json($apuMaterial, 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'code' => 'nullable|string',
                'description' => 'string',
                'unit' => 'string',
                'unit_value' => 'integer',
                'reference_link' => 'nullable|string',
                'chapter_id' => 'integer',
            ]);

            $apuMaterial = ApuMaterial::findOrFail($id);
            $apuMaterial->code = $request->input('code', $apuMaterial->code);
            $apuMaterial->description = $request->input('description', $apuMaterial->description);
            $apuMaterial->unit = $request->input('unit', $apuMaterial->unit);
            $apuMaterial->unit_value = $request->input('unit_value', $apuMaterial->unit_value);
            $apuMaterial->reference_link = $request->input('reference_link', $apuMaterial->reference_link);
            $apuMaterial->chapter_id = $request->input('chapter_id', $apuMaterial->chapter_id);
            $apuMaterial->save();

            return response()->json($apuMaterial);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /* public function destroy($id)
    {
        $apuMaterial = ApuMaterial::findOrFail($id);
        $apuMaterial->delete();

        return response()->json(['message' => 'Apu Material deleted successfully']);
    } */
}
