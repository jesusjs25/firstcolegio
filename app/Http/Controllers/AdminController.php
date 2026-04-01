<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class AdminController extends Controller                    // Controlador para la sección de administración
{
    public function admin()                         
    {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalCourses = Course::count();
        $totalSubjects = Subject::count();

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