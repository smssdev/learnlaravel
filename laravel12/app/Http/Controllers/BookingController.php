<?php

namespace App\Http\Controllers;

use App\Models\booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $data= booking::all();
        return $data;
    }
    public function create(Request $request)
    {
        $book = new Booking();
        $book->flight_id = $request->input('flight_id');
        $book->name = $request->input('name');
        $book->save();
        return $book;
    }
}
