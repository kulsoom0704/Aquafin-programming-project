<?php

namespace App\Http\Controllers;

use App\Models\Materiaal;

class MateriaalController extends Controller
{
    public function index()
    {
        // Haal alle materialen op uit de database
        $materialen = Materiaal::all();

        // Stuur de gegevens naar de view
        return view('materiaal.index', compact('materialen'));
    }
}