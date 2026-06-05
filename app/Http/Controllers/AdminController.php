<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $rainfall = [
            ['year' => 2026, 'rainfall' => 950, 'risk' => 'Laag'],
            ['year' => 2027, 'rainfall' => 1010, 'risk' => 'Gemiddeld'],
            ['year' => 2028, 'rainfall' => 1120, 'risk' => 'Hoog'],
            ['year' => 2029, 'rainfall' => 1150, 'risk' => 'Hoog'],
            ['year' => 2030, 'rainfall' => 1050, 'risk' => 'Gemiddeld'],
        ];

        return view('admin.dashboard', compact('rainfall'));
    }

    public function users()
    {
        return view('admin.users');
    }

    public function reports()
    {
        return view('admin.reports');
    }
}