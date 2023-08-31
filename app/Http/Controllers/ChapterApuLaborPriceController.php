<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;

class ChapterApuLaborPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $apuLaborPrices = $chapter->apuLaborPrices;
        return response()->json($apuLaborPrices);
    }
}
