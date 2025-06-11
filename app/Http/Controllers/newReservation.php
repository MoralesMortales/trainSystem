<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Travels;
use App\Models\trains;

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
        // Recuperar los datos de la sesión flash
        $travelData = session('travelData');
        $DataReserve = session('DataReserve');

        return view('main/Reservation/Reserving/MeandOthers', [
            'travelData' => $travelData,
            'DataReserve' => $DataReserve
        ]);
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
