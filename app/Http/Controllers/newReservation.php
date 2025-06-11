<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Travels;
use App\Models\trains;

use Illuminate\Support\Collection;

use function GuzzleHttp\json_decode;

class newReservation extends Controller
{
    public function reservingOnlyme()
    {
        $travelData = session('travelData');
        $DataReserve = session('DataReserve');

        return view('main/Reservation/Reserving/OnlyMe', [
            'travelData' => $travelData,
            'DataReserve' => $DataReserve
        ]);
    }

    public function reservingMeAndOthers()
    {
        $travelData = session('travelData');
        $DataReserve = session('DataReserve');

        // Obtener los asientos ya reservados para este viaje
        $reservedSeats = Seat::join('reservations', 'seats.reservationNumber', '=', 'reservations.reservationNumber')
            ->where('reservations.travelCode', $travelData['travelCode'])
            ->select('seats.class', 'seats.seat')
            ->get()
            ->groupBy('class');

        $train = trains::find($travelData['train_id']);

        $availableSeats = [
            'VIP' => $this->getAvailableSeats('VIP', $train->vipCapacity, $reservedSeats->get('VIP', collect([]))),
            'Turist' => $this->getAvailableSeats('Turist', $train->turistCapacity, $reservedSeats->get('Turist', collect([]))),
            'Normal' => $this->getAvailableSeats('Normal', $train->economicCapacity, $reservedSeats->get('Normal', collect([])))
        ];

        return view('main/Reservation/Reserving/MeandOthers', [
            'travelData' => $travelData,
            'DataReserve' => $DataReserve,
            'availableSeats' => $availableSeats
        ]);
    }

public function reservingMeAndOthersPostPost(Request $request)
{
    $validatedData = $request->validate([
        'persons' => 'required|array|min:1',
        'persons.*.fullname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
        'persons.*.gender' => 'required|in:M,F,O',
        'persons.*.age' => 'required|integer|min:1|max:999',
        'persons.*.class' => 'required|in:Turist,Normal,VIP',
        'persons.*.seat' => [
            'required',
            'string',
            function ($attribute, $value, $fail) use ($request) {
                // Obtener el índice de la persona
                $index = explode('.', $attribute)[1];
                $class = $request->input("persons.{$index}.class");

                // Verificar si el asiento está disponible para esa clase
                $availableSeats = []; // Aquí deberías obtener los asientos disponibles para $class

                if (!in_array($value, $availableSeats)) {
                    $fail("El asiento seleccionado no está disponible para la clase $class.");
                }
            }
        ],
        'persons.*.seat_cost' => 'required|numeric|min:0',
    ], [
        'persons.required' => 'Debe haber al menos una persona para la reserva.',
        'persons.*.fullname.required' => 'El nombre completo es obligatorio.',
        'persons.*.fullname.regex' => 'El nombre solo puede contener letras y espacios.',
        'persons.*.gender.required' => 'El género es obligatorio.',
        'persons.*.age.required' => 'La edad es obligatoria.',
        'persons.*.age.integer' => 'La edad debe ser un número entero.',
        'persons.*.age.min' => 'La edad mínima es 1 año.',
        'persons.*.age.max' => 'La edad máxima permitida es 999 años.',
        'persons.*.class.required' => 'La clase es obligatoria.',
        'persons.*.seat.required' => 'El asiento es obligatorio.',
        'persons.*.seat_cost.required' => 'El costo del asiento es obligatorio.',
    ]);

    // Si la validación pasa, procesar los datos...
    // $validatedData contendrá los datos validados

    // Ejemplo de cómo acceder a los datos:
    foreach ($validatedData['persons'] as $person) {
        // Procesar cada persona
    }

    // Redireccionar o retornar respuesta
    return redirect()->route('myreservation')->with('success', 'Reserva realizada con éxito');
}

    private function getAvailableSeats($class, $capacity, $reservedSeats)
    {
        $allSeats = range(0, $capacity);
        $reservedSeatNumbers = $reservedSeats->pluck('seat')->toArray();
        return array_diff($allSeats, $reservedSeatNumbers);
    }
    public function reservingOthers()
    {
        $travelData = session('travelData');
        $DataReserve = session('DataReserve');

        return view('main/Reservation/Reserving/Others', [
            'travelData' => $travelData,
            'DataReserve' => $DataReserve
        ]);
    }

    public function showCreateAvailableReservations()
    {
        $travels = Travels::all();
        $trains = trains::all();

        return view('main/Reservation/NewReservation',  [
            'travels' => $travels,
            'trains' => $trains
        ]);
    }


    public function reservingTravel(Travels $travel)
    {

        return view('main/Reservation/Reserving/Reserving')->with('travel', $travel);
    }

    public function reservingTravelStep2(Request $request)
    {

        $validateData = $request->validate([
            'Reserva' => 'required|string|max:255',
            'Num_passport' => 'required|integer',
            'Gender' => 'required|string|max:255',
            'Age' => 'required|integer|max:255',
            'reserving_option' => 'required|string|max:255',
        ]);

        $travelData = json_decode($request->input('travelData'), true);

        if ($validateData['reserving_option'] == "others") {
            return redirect()->route('reservingOthers')->with([
                'travelData' => is_object($travelData) ? $travelData->toArray() : $travelData,
                'DataReserve' => $validateData
            ]);
        } else if ($validateData['reserving_option'] == "meandothers") {
            return redirect()->route('reservingMeAndOthers')->with([
                'travelData' => is_object($travelData) ? $travelData->toArray() : $travelData,
                'DataReserve' => $validateData
            ]);
        } else if ($validateData['reserving_option'] == "onlyme") {
            return redirect()->route('reservingonlyme')->with([
                'travelData' => is_object($travelData) ? $travelData->toArray() : $travelData,
                'DataReserve' => $validateData
            ]);
        }




        return redirect()->route('menu')->with('success', 'User created successfully!');
    }
}
