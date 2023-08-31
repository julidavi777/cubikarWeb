<?php

namespace App\Http\Controllers;

use App\Models\ApuInternalChapter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApuInternalChapterController extends Controller
{
    public function index()
    {
        $apuInternalChapters = ApuInternalChapter::all();

        return response()->json($apuInternalChapters);
    }

    public function show($id)
    {
        $apuInternalChapter = ApuInternalChapter::findOrFail($id);

        return response()->json($apuInternalChapter);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
            ]);

            $apuInternalChapter = ApuInternalChapter::create([
                'name' => $request->input('name'),
            ]);

            return response()->json($apuInternalChapter, 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'string',
            ]);

            $apuInternalChapter = ApuInternalChapter::findOrFail($id);
            $apuInternalChapter->name = $request->input('name', $apuInternalChapter->name);
            $apuInternalChapter->save();

            return response()->json($apuInternalChapter);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

   /*  public function destroy($id)
    {
        $apuInternalChapter = ApuInternalChapter::findOrFail($id);
        $apuInternalChapter->delete();

        return response()->json(['message' => 'Apu Internal Chapter deleted successfully']);
    } */
}
