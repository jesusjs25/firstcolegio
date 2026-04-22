<?php
namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

public function index()
    {
    $totalEstudiantes = \App\Models\User::role('Alumno')->count(); 
    $totalProfesores  = \App\Models\User::role('Profesor')->count();
    $totalMaterias    = \App\Models\Materia::count();
    //$totalCursos      = \App\Models\Course::count(); 

        $inscripciones = User::role('Alumno')
    ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
    ->whereYear('created_at', date('Y'))
    ->groupBy('month')
    ->orderBy('month')
    ->pluck('count', 'month')
    ->all();

$chartData = [];
for ($i = 1; $i <= 12; $i++) {
    $chartData[] = $inscripciones[$i] ?? 0;

$nuevosUsuarios = \App\Models\User::latest()->take(3)->get();
$actividadesSistema = \App\Models\Activity::with('user')->latest()->take(5)->get();

}
    return view('admin.index', compact(
        'totalEstudiantes', 
        'totalProfesores', 
        'totalMaterias', 
        // 'totalCursos'
        'chartData',
        'nuevosUsuarios',
        'actividadesSistema'
    ));
    }
}
