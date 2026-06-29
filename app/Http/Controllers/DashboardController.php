<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();

        $usuariosHoy = User::whereDate('created_at', Carbon::today())->count();

        $usuariosMesPasado = User::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $ultimosUsuarios = User::latest()->take(5)->get();

        $usuariosPorDia = User::selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        $fechas = $usuariosPorDia->pluck('fecha');
        $totales = $usuariosPorDia->pluck('total');

        return view('dashboard', compact(
            'totalUsuarios',
            'usuariosHoy',
            'usuariosMesPasado',
            'ultimosUsuarios',
            'fechas',
            'totales'
        ));
    }
}