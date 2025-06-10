<?php

namespace App\Http\Controllers;

use App\Models\trains;
use Illuminate\Support\Facades\Validator;
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

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'maxVelocity' => 'required|numeric|min:0',
            'vipCapacity' => 'nullable|integer|min:0',
            'turistCapacity' => 'nullable|integer|min:0',
            'economicCapacity' => 'nullable|integer|min:0',
        ]);

        $validatedData->after(function ($validatedData) use ($request) {
            if ($request->filled(['vipCapacity', 'turistCapacity', 'economicCapacity'])) {
                $sum = $request->vipCapacity + $request->turistCapacity + $request->economicCapacity;
                if ($sum != $request->capacity) {
                    $validatedData->errors()->add(
                        'capacity_mismatch',
                        "La suma de las capacidades (VIP: {$request->vipCapacity}, Turista: {$request->turistCapacity}, Económica: {$request->economicCapacity}) debe ser igual a {$request->capacity}"
                    );
                }
            }
        });

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $validatedData = $validatedData->validated();

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

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'maxVelocity' => 'required|numeric|min:0',
            'vipCapacity' => 'nullable|integer|min:0',
            'turistCapacity' => 'nullable|integer|min:0',
            'economicCapacity' => 'nullable|integer|min:0',
        ]);

        $validatedData->after(function ($validatedData) use ($request) {
            if ($request->filled(['vipCapacity', 'turistCapacity', 'economicCapacity'])) {
                $sum = $request->vipCapacity + $request->turistCapacity + $request->economicCapacity;
                if ($sum != $request->capacity) {
                    $validatedData->errors()->add(
                        'capacity_mismatch',
                        "La suma de las capacidades (VIP: {$request->vipCapacity}, Turista: {$request->turistCapacity}, Económica: {$request->economicCapacity}) debe ser igual a {$request->capacity}"
                    );
                }
            }
        });

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $validatedData = $validatedData->validated();

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
