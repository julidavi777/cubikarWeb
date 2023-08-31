<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerApuActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $apuActivities = $customer->apuActivities;
        return response()->json($apuActivities);
    }
}
