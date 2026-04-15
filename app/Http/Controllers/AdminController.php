<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

/**
    * Gestion de funciones administrativas
    ** Este controlador maneja las funciones administrativas del sistema, como la visualización de estadísticas y la gestión de usuarios.
    *  Se encarga de recopilar datos relevantes para el administrador y presentarlos en la vista correspondiente.
*/

class AdminController extends Controller
{
    public function admin()
    {
    // Estadísticas generales de estudiantes, profesores, cursos y materias
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalCourses = Course::count();
        $totalSubjects = Subject::count();

    // Retornar la vista con las estadísticas y los datos necesarios para el dashboard
        return view('admin.index', compact(
            'totalStudents',
            'totalTeachers',
            'totalCourses',
            'totalSubjects'
        ));
    }
}

// Estadísticas de estudiantes por mes
$studentsByMonth = Student::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    ->groupBy('month')
    ->pluck('total', 'month');

// Promedio general por curso
    
    /* $gradesAverage = DB::table('grades')
    ->selectRaw('course_id, AVG(score) as average')
    ->groupBy('course_id')
    ->get(); */
    

    // Últimos estudiantes y profesores registrados
    $latestStudents = Student::latest()->take(3)->get();
$latestTeachers = Teacher::latest()->take(2)->get(); 