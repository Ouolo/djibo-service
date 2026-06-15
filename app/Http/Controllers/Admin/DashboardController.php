<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'     => Actualite::count(),
            'publiees'  => Actualite::where('publie', true)->count(),
            'brouillons'=> Actualite::where('publie', false)->count(),
            'recentes'  => Actualite::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
