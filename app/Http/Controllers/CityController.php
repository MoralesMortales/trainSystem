<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities; // Importa el modelo City
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    /**
     * Muestra la vista de gestión de ciudades.
     */
    public function manageCities()
    {
        $cities = cities::all(); // Obtener todas las ciudades de la base de datos
        return view('main.manageCitys', compact('cities'));
    }

    /**
     * Almacena una nueva ciudad en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cities', 'name')->where(fn ($query) => $query->whereRaw('LOWER(name) = LOWER(?)', [$request->name])),
            ],
        ], [
            'name.unique' => 'Esta ciudad ya existe en la base de datos.',
            'name.required' => 'El nombre de la ciudad es obligatorio.',
            'name.string' => 'El nombre de la ciudad debe ser una cadena de texto.',
            'name.max' => 'El nombre de la ciudad no puede exceder los 255 caracteres.',
        ]);

        $city = cities::create(['name' => $request->name]);

        return response()->json(['message' => 'Ciudad agregada exitosamente.', 'city' => $city], 201);
    }

    /**
     * Elimina una ciudad de la base de datos.
     */
    public function destroy(cities $city) // Laravel Route Model Binding
    {
        $city->delete();

        return response()->json(['message' => 'Ciudad eliminada exitosamente.'], 200);
    }
}