<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function postCreateTravelView(Request $request)
    {
        $validatedData = $request->validate([
            'train_id' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'CostVIP' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'CostNormal' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'CostTurists' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'originCity' => 'required|string',
            'destinyCity' => 'required|string|different:originCity',
            'DepartmentDay' => 'required|date|after:today|before_or_equal:2050-12-31',
            'DepartmentHour' => 'required|date_format:H:i',
        ]);


        return redirect()->route('menu')->with('success', 'Travel created successfully!');
    }
}
