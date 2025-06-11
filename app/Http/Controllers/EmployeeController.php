<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Asegúrate de que el modelo User esté importado

class EmployeeController extends Controller
{
    public function manageEmployees()
    {
        $users = User::all();
        return view('main.EmployeeCreation.ManageEmployees', compact('users'));
    }

    // <-- AÑADE EL SIGUIENTE MÉTODO -->
    public function destroy(User $user)
    {
        // El tipo-hinting (User $user) hace que Laravel automáticamente
        // busque un usuario por el ID proporcionado en la URL y lo inyecte aquí.
        // Si no se encuentra el usuario, Laravel lanzará un 404 automáticamente.

        $user->delete(); // Elimina el usuario de la base de datos

        // Puedes añadir un mensaje de éxito o error si lo deseas
        return redirect()->route('manage.employees')->with('success', 'Usuario eliminado exitosamente.');
    }
}