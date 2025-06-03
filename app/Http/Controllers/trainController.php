<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class trainController extends Controller
{
      public function showMyTrains()
    {
        return view('Trains');
    }
      public function createTrain()
    {
        return view('createTrain');
    }


}
