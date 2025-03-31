<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function gerente()
    {
        return view('dashboard.gerente');
    }

    public function empleado()
    {
        return view('dashboard.empleado');
    }

    public function cliente()
    {
        return view('dashboard.cliente');
    }
}

