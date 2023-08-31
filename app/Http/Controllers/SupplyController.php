<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index()
    {
        return Supply::all();
    }

    public function store(Request $request)
    {
        return Supply::create($request->all());
    }

    public function show($id)
    {
        return Supply::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $supply = Supply::findOrFail($id);
        $supply->update($request->all());
        return $supply;
    }

    public function destroy($id)
    {
        $supply = Supply::findOrFail($id);
        $supply->delete();
        return response()->json(null, 204);
    }
}
