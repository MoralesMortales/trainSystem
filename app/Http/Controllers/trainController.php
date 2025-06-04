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
        $request->merge([
            'vipCapacity' => $request->vipCapacity ?? 0,
            'turistCapacity' => $request->turistCapacity ?? 0,
            'economicCapacity' => $request->economicCapacity ?? 0,
        ]);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'maxVelocity' => 'required|numeric|min:0',
            'vipCapacity' => 'nullable|integer|min:0',
            'turistCapacity' => 'nullable|integer|min:0',
            'economicCapacity' => 'nullable|integer|min:0',
        ]);

        $train = new trains();

        $train->name = $validatedData['name'];
        $train->type = $validatedData['type'];
        $train->status = 0;
        $train->capacity = $validatedData['capacity'];
        $train->maxVelocity = $validatedData['maxVelocity'];
        $train->vipCapacity = $validatedData['vipCapacity'];
        $train->turistCapacity = $validatedData['turistCapacity'];
        $train->economicCapacity = $validatedData['economicCapacity'];

        $train->save();

        return redirect()->route('menu')->with('success', 'Train created successfully!');
    }

    public function updateTrain(trains $train)
    {
        return view('main.trains.updateTrain', ['train' => $train]);
    }

    public function updateTrainSubmit(Request $request, trains $train)
    {
        $request->merge([
            'vipCapacity' => $request->vipCapacity ?? 0,
            'turistCapacity' => $request->turistCapacity ?? 0,
            'economicCapacity' => $request->economicCapacity ?? 0,
        ]);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'maxVelocity' => 'required|numeric|min:0',
            'vipCapacity' => 'nullable|integer|min:0',
            'turistCapacity' => 'nullable|integer|min:0',
            'economicCapacity' => 'nullable|integer|min:0',
        ]);
    $train->update($validatedData);
             $train->save();

return redirect()->route('Trains')->with('success', 'Train updated successfully');
    }


    public function destroy(trains $train)
    {
        $train->delete();

        return redirect()->route('Trains')
            ->with('success', 'Train deleted successfully');
    }
}
