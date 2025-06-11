<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trains;
use App\Models\cities;
use App\Models\Travels;
use Illuminate\Support\Str; // ¡Esta es la línea que falta!

class TravelController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo viaje.
     * Recupera los trenes y ciudades para poblar los selectores.
     */
    public function showCreateTravelView()
    {
        // Recuperar todos los trenes
        $trains = trains::all(); 

        // Recuperar todas las ciudades
        $cities = cities::all(); 

        return view('main/Travel/NewTravel',  [
            'trains' => $trains,
            'cities' => $cities
        ]);
    }

    public function showMyTravelView()
    {

        $trains = trains::all();
        $travels = Travels::all();

        return view('main/Travel/MyTravels',  [
            'trains' => $trains,
            'travels' => $travels
        ]);
    }

    public function postCreateTravelView(Request $request)
    {
        $validatedData = $request->validate([
            'train_id' => 'required|numeric',
            'CostVIP' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'CostNormal' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'CostTurists' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'originCity' => 'required|string',
            'destinyCity' => 'required|string|different:originCity',
            'DepartmentDay' => 'required|date|after:today|before_or_equal:2050-12-31',
            'DepartmentHour' => 'required|date_format:H:i',
        ]);

        $travelCode = 'TRV-' . Str::upper(Str::random(6));

        $travel = Travels::create([
            'travelCode' => $travelCode,
            'train_id' => $validatedData['train_id'],
            'departureDay' => $validatedData['DepartmentDay'],
            'departureHour' => $validatedData['DepartmentHour'],
            'origin' => $validatedData['originCity'],
            'destiny' => $validatedData['destinyCity'],
            'CostVIP' => $validatedData['CostVIP'],
            'CostNormal' => $validatedData['CostNormal'],
            'CostTurists' => $validatedData['CostTurists'],
            'status' => true
        ]);

        $travel->save();

        return redirect()->route('menu')->with('success', 'Travel created successfully!');
    }

}
