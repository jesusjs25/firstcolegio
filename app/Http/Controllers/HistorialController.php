<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index()
    {
        $historiales = Historial::all();
        return view('admin.historial.index', compact('historiales'));
    }
}