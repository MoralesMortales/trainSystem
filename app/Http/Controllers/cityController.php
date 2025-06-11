<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities; // Asegúrate de que este sea el namespace correcto para tu modelo City
use Illuminate\Validation\ValidationException;

class CityController extends Controller
{
    /**
     * Muestra la lista de todas las ciudades para la gestión.
     */
    public function index()
    {
        $cities = cities::all(); // Recupera todas las ciudades
        return view('main.manageCitys', compact('cities'));
    }

    /**
     * Almacena una nueva ciudad en la base de datos.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:cities,name', // Asegúrate de que el nombre sea único
            ]);

            $city = cities::create([
                'name' => $request->name,
            ]);

            return response()->json(['message' => 'Ciudad agregada exitosamente.', 'city' => $city], 201);
        } catch (ValidationException $e) {
            // Devuelve errores de validación si el nombre ya existe, etc.
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Captura cualquier otro error del servidor
            return response()->json(['message' => 'Ocurrió un error al agregar la ciudad.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Elimina la ciudad especificada de la base de datos.
     * @param int $id El ID de la ciudad a eliminar.
     */
    public function destroy($id)
    {
        try {
            // Busca la ciudad por su ID. Si no la encuentra, lanzará una excepción ModelNotFoundException (404).
            $city = cities::findOrFail($id);
            $city->delete(); // Elimina la ciudad de la base de datos

            // Responde con un mensaje de éxito en formato JSON
            return response()->json(['message' => 'Ciudad eliminada exitosamente.'], 200); // 200 OK

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Si la ciudad no fue encontrada
            return response()->json(['message' => 'La ciudad no existe o ya ha sido eliminada.'], 404); // 404 Not Found
        } catch (\Illuminate\Database\QueryException $e) {
            // Captura errores de base de datos, como restricciones de clave foránea
            // Esto ocurre si intentas eliminar una ciudad que está siendo referenciada por otra tabla (ej. en 'travels')
            return response()->json(['message' => 'No se puede eliminar la ciudad porque está asociada a otros registros (ej. viajes).', 'error' => $e->getMessage()], 409); // 409 Conflict
        } catch (\Exception $e) {
            // Captura cualquier otro error inesperado
            return response()->json(['message' => 'Ocurrió un error inesperado al intentar eliminar la ciudad.', 'error' => $e->getMessage()], 500); // 500 Internal Server Error
        }
    }
}