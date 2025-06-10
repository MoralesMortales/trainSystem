<?php

namespace App\Http\Controllers;

use App\Models\trains;
use App\Models\cities;

class travelController extends Controller
{

    public function showCreateTravelView()
    {
        $trains = trains::all();
        $cities = cities::all();

        return view('main/Travel/NewTravel',  [
    'trains' => $trains,
    'cities' => $cities
]);
    }
}
