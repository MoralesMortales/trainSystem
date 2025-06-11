<?php

namespace App\Http\Controllers;

use App\Models\reservations;
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
        $travelData = json_decode($request->input('travelData'), true);

        // Verificar que los datos de sesión existan
        if (!$travelData) {
            return redirect()->route('ruta.inicial')->with('error', 'La sesión ha expirado. Por favor, comienza el proceso de reserva nuevamente.');
        }

        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'persons' => 'required|array|min:1',
            'persons.*.fullname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'persons.*.gender' => 'required|in:M,F,O',
            'persons.*.age' => 'required|integer|min:1|max:999',
            'persons.*.class' => 'required|in:Turist,Normal,VIP',
            'persons.*.seat' => [
                'required',
                'string',
                'not_in:0',
                function ($attribute, $value, $fail) use ($travelData) {
                    $index = explode('.', $attribute)[1];
                    $class = request()->input("persons.{$index}.class");

                    // Obtener asientos ya reservados para esta clase
                    $reservedSeats = Seat::join('reservations', 'seats.reservationNumber', '=', 'reservations.reservationNumber')
                        ->where('reservations.travelCode', $travelData['travelCode'])
                        ->where('seats.class', $class)
                        ->pluck('seat')
                        ->toArray();

                    // Obtener capacidad del tren para esta clase
                    $train = trains::find($travelData['train_id']);
                    $capacity = match ($class) {
                        'VIP' => $train->vipCapacity,
                        'Turist' => $train->turistCapacity,
                        'Normal' => $train->economicCapacity,
                        default => 0
                    };

                    // Generar todos los asientos posibles (1 hasta capacidad)
                    $allSeats = range(1, $capacity);

                    // Calcular asientos disponibles
                    $availableSeats = array_diff($allSeats, $reservedSeats);

                    // Verificar si el asiento está disponible
                    if (!in_array($value, $availableSeats)) {
                        $fail("El asiento $value no está disponible en clase $class. Asientos disponibles: " . implode(', ', $availableSeats));
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
            'persons.*.seat.not_in' => 'El número de asiento no puede ser 0.',
            'persons.*.seat_cost.required' => 'El costo del asiento es obligatorio.',
        ]);

        $totalCost = array_sum(array_column($validatedData['persons'], 'seat_cost'));

        $counter = 0;
        foreach ($validatedData['persons'] as $person) {


            if ($counter === 0) {
                $name = $person['fullname'];

                $reservation = reservations::create([
                    'reservationNumber' => uniqid(),
                    'travelCode' => $travelData['travelCode'],
                    'status' => true,
                    'fullname' => $name,
                ]);
            }

            $seatData = [
                'class' => $person['class'],
                'seat' => $person['seat'],
                'gender' => $person['gender'],
                'fullname' => $person['fullname'],
                'age' => $person['age'],
                'reservationNumber' => $reservation->reservationNumber,
                'status' => true,
            ];

            Seat::create($seatData);
            $counter++;
        }

        $reservation = reservations::create([
            'reservationNumber' => uniqid(),
            'travelCode' => $travelData['travelCode'],
            'status' => true,
            'fullname' => $name,
        ]);


        return redirect()->route('menu')->with([
            'success' => 'Reserva realizada con éxito',
            'reservationNumber' => $reservation->reservationNumber
        ]);
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
