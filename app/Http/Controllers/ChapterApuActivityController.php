<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterApuActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $apuActivities = $chapter->apuActivities;
        return response()->json($apuActivities);
    }
}
