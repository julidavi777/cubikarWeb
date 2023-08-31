<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;

class ChapterApuMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $apuMaterials = $chapter->apuMaterials;
        return response()->json($apuMaterials);
    }
}
