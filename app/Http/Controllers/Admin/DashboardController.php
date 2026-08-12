<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Realisation;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'          => Actualite::count(),
            'publiees'       => Actualite::where('publie', true)->count(),
            'brouillons'     => Actualite::where('publie', false)->count(),
            'recentes'       => Actualite::latest()->take(5)->get(),
            'total_reals'    => Realisation::count(),
            'reals_actives'  => Realisation::where('actif', true)->count(),
            'reals_recentes' => Realisation::latest()->take(4)->get(),
        ];

        // ── Statistiques des visiteurs ──
        $now = Carbon::now();

        $visitStats = [
            'today'        => Visit::whereDate('visited_at', $now->toDateString())->count(),
            'today_unique' => Visit::whereDate('visited_at', $now->toDateString())->distinct('ip_address')->count('ip_address'),
            'week'         => Visit::where('visited_at', '>=', $now->copy()->startOfWeek())->count(),
            'week_unique'  => Visit::where('visited_at', '>=', $now->copy()->startOfWeek())->distinct('ip_address')->count('ip_address'),
            'month'        => Visit::where('visited_at', '>=', $now->copy()->startOfMonth())->count(),
            'month_unique' => Visit::where('visited_at', '>=', $now->copy()->startOfMonth())->distinct('ip_address')->count('ip_address'),
            'total'        => Visit::count(),
            'total_unique' => Visit::distinct('ip_address')->count('ip_address'),
        ];



        // Données pour le graphique des 7 derniers jours
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $chartData[] = [
                'label'   => $date->locale('fr')->isoFormat('ddd D'),
                'visits'  => Visit::whereDate('visited_at', $date->toDateString())->count(),
                'unique'  => Visit::whereDate('visited_at', $date->toDateString())->distinct('ip_address')->count('ip_address'),
            ];
        }

        // Visites des dernières 24h par heure (pour le mini-graphique)
        $hourlyData = [];
        for ($h = 23; $h >= 0; $h--) {
            $start = $now->copy()->subHours($h)->startOfHour();
            $end   = $now->copy()->subHours($h)->endOfHour();
            $hourlyData[] = Visit::whereBetween('visited_at', [$start, $end])->count();
        }

        return view('admin.dashboard', compact('stats', 'visitStats', 'chartData', 'hourlyData'));
    }
}
