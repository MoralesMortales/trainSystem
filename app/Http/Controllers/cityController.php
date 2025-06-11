<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities;

class cityController extends Controller
{
    public function showCities()
    {
        $cities = cities::all();
        return view('main.trains.myTrains', ['cities' => $cities]);
    }
      public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name'
        ]);

        cities::create($validated);

        return back()->with('success', 'City created successfully');
    }

    public function destroy(cities $city)
    {
        $city->delete();
        return back()->with('success', 'City destoyed successfully');
    }

}
