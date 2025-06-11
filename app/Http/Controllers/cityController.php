<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities;
use Exception;

class cityController extends Controller
{
    public function showCities()
    {
        $cities = cities::all();
        return view('main/manageCitys', ['cities' => $cities]);
    }
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:cities,name'
    ]);

    try {
        $city = cities::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ciudad creada exitosamente',
            'city' => [
                'id' => $city->id,
                'name' => $city->name
            ]
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al crear la ciudad: ' . $e->getMessage()
        ], 500);
    }
}

    public function destroy(cities $city)
    {
    try {
        $city->delete();
        return response()->json([
            'success' => true,
            'message' => 'Ciudad eliminada correctamente'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar la ciudad'
        ], 500);
    }
    }

}
