<?php

namespace App\Http\Controllers;

use App\Models\ApuTool;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApuToolController extends Controller
{
    public function index()
    {
        $apuTools = ApuTool::all();

        return response()->json($apuTools);
    }

    public function show($id)
    {
        $apuTool = ApuTool::findOrFail($id);

        return response()->json($apuTool);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'description' => 'required|string',
                'unit' => 'required|string',
                'unit_value' => 'required|integer',
                'reference_link' => 'nullable|string',
            ]);

            $apuTool = ApuTool::create([
                'description' => $request->input('description'),
                'unit' => $request->input('unit'),
                'unit_value' => $request->input('unit_value'),
                'reference_link' => $request->input('reference_link'),
            ]);

            return response()->json($apuTool, 201);
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
                'unit_value' => 'integer',
                'reference_link' => 'nullable|string',
            ]);

            $apuTool = ApuTool::findOrFail($id);
            $apuTool->description = $request->input('description', $apuTool->description);
            $apuTool->unit = $request->input('unit', $apuTool->unit);
            $apuTool->unit_value = $request->input('unit_value', $apuTool->unit_value);
            $apuTool->reference_link = $request->input('reference_link', $apuTool->reference_link);
            $apuTool->save();

            return response()->json($apuTool);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /* public function destroy($id)
    {
        $apuTool = ApuTool::findOrFail($id);
        $apuTool->delete();

        return response()->json(['message' => 'Apu Tool deleted successfully']);
    } */
}
