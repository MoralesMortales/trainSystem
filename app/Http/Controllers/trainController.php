<?php

namespace App\Http\Controllers;
use App\Models\trains;
use Illuminate\Http\Request;

class trainController extends Controller
{
      public function showMyTrains()
    {
        $trains = trains::all();
        return view('main.trains.myTrains', ['trains' => $trains]);
    }

      public function createTrain()
    {
        return view('main.trains.createTrain');
    }

    public function createTrainSubmit(Request $request)
    {
         $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'capacity' => 'required|integer',
            'maxVelocity' => 'required|float',
            'vipCapacity' => 'integer',
            'turistCapacity' => 'integer',
            'economicCapacity' => 'integer',
        ]);

        /* $train = new trains(); */

        /* $train->email = $validatedData['email']; */

        /* $train->cedula = $validatedData['cedula']; */

        /* $train->isEmployee = 0; */

        /* $train->save(); */

        return redirect()->back()->with('success', 'User created successfully!');
    }



}
