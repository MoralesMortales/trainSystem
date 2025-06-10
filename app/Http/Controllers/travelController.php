<?php

namespace App\Http\Controllers;

use App\Models\trains;

class travelController extends Controller
{

    public function showCreateTravelView()
    {
        $trains = trains::all();
        return view('main/Travel/NewTravel', ['trains' => $trains]);
    }
}
