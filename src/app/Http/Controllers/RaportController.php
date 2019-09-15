<?php

namespace App\Http\Controllers;

use App\Workstation;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    public function index()
    {
        $workstations = Workstation::all();

        return view('workstations/raport', [
            'workstations' => $workstations,
        ]);
    }
}
