<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\trains; // Asegúrate de importar tu modelo Train
use App\Models\cities;  // Asegúrate de importar tu modelo City
use Illuminate\Validation\ValidationException;

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

        // Retornar la vista 'main.Travel.NewTravel' y pasar los datos de trenes y ciudades
        return view('main.Travel.NewTravel', compact('trains', 'cities'));
    }

    /**
     * Almacena un nuevo viaje en la base de datos.
     */
    public function store(Request $request)
    {
        try {
            // 1. Validación de los datos
            $validatedData = $request->validate([
                'train_id' => 'required|integer|exists:trains,train_id',
                'departureDay' => 'required|date|after_or_equal:today', // 'after_or_equal:today' permite hoy o después
                'departureHour' => 'required|string',
                'origin' => 'required|integer|exists:cities,id',
                'destiny' => 'required|integer|exists:cities,id|different:origin',
                'cost_vip' => 'required|numeric|min:0.01',
                'cost_normal' => 'required|numeric|min:0.01',
                'cost_turist' => 'required|numeric|min:0.01',
            ]);

            // 2. Generar travelCode si no lo generas automáticamente en la base de datos
            // Si travelCode es auto-generado por la BD, puedes eliminar esta línea.
            // Si no lo es, debes asegurarte de que sea único.
            $validatedData['travelCode'] = \Illuminate\Support\Str::random(10); // Genera una cadena aleatoria de 10 caracteres como ejemplo.
                                                                           // O puedes usar \Illuminate\Support\Str::uuid()->toString();

            // 3. Crear el viaje
            $travel = Travel::create($validatedData);

            // 4. Devolver una respuesta JSON de éxito
            return response()->json([
                'message' => 'Viaje creado exitosamente.',
                'travel' => $travel
            ], 201); // 201 Created

        } catch (ValidationException $e) {
            // Si hay errores de validación, devolverlos en formato JSON
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            // Capturar cualquier otro error del servidor
            return response()->json([
                'message' => 'Ocurrió un error inesperado al crear el viaje.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }
}