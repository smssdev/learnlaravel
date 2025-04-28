<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights= Flight::all();
        return $flights;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $flight = new Flight();
        $flight->flight_name = $request->input('flight_name');  // إضافة الاسم من المعلمات
        $flight->save();
        return $flight;
    }

    public function incrementCounter($id)
{
    $flight = Flight::findOrFail($id);

    // زيادة العداد بدون تعديل التاريخ
    // $flight->increment('counter');
    Flight::withoutTimestamps(fn () => $flight->increment('counter'));
    return response()->json([
        'message' => 'تمت زيادة العداد بنجاح',
        'counter' => $flight->counter
    ]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlightRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlightRequest $request, Flight $flight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        //
    }
}
