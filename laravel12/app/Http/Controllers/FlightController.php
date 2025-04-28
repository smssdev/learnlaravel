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
        /* lazy loadings */
        // $flights = Flight::all();
        // foreach ($flights as $flight) {
        //     // الوصول إلى العلاقة بدون تحميلها مسبقًا
        //     echo $flight->bookings;  // سيؤدي هذا إلى ظهور خطأ إذا كان lazy loading ممنوعًا
        // }
        // return $flights;

        /* eager loadings */

        // Eager load 'bookings' with only 'flight_id' and 'name' columns
        $flights = Flight::with(['bookings' => function ($query) {
            $query->select('flight_id', 'name'); // Only load 'flight_id' and 'name' from bookings
        }])->get();

        // Transform the result to include only booking names and exclude the bookings array
        return $flights->map(function ($flight) {
            // Assign booking names to a new property
            $flight->booking_names = $flight->bookings->pluck('name');

            // Remove the original bookings relationship completely
            unset($flight->bookings);

            return $flight;
        });;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $flight = new Flight();
        if ($request->has('flight_name'))   $flight->flight_name = $request->input('flight_name');  // إضافة الاسم من المعلمات
        if ($request->has('counter'))   $flight->counter = $request->input('counter');  // إضافة الاسم من المعلمات
        $flight->save();
        return $flight;
    }

    public function incrementCounter($id)
    {
        $flight = Flight::findOrFail($id);

        // زيادة العداد بدون تعديل التاريخ
        // $flight->increment('counter');
        Flight::withoutTimestamps(fn() => $flight->increment('counter'));
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
