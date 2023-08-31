<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::all();

        return response()->json($chapters);
    }

    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);

        return response()->json($chapter);
    }

    public function store(Request $request)
    {
       
        try {
            $this->validate($request, [
                //'sequential' => 'required|integer',
                'name' => 'required|string',
            ]);

            $lastChapterSeq = Chapter::get()->sortByDesc('sequential')->values();

            $chapter = Chapter::create([
                'sequential' => $lastChapterSeq[0]['sequential'] + 1,
                'name' => $request->input('name'),
            ]);

            return response()->json($chapter, 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'sequential' => 'integer',
                'name' => 'string',
            ]);

            $chapter = Chapter::findOrFail($id);
            $chapter->sequential = $request->input('sequential', $chapter->sequential);
            $chapter->name = $request->input('name', $chapter->name);
            $chapter->save();

            return response()->json($chapter);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /* public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return response()->json(['message' => 'Chapter deleted successfully']);
    } */
}
