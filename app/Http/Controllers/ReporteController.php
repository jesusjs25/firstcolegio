<?php
namespace App\Http\Controllers;

use App\Models\Reporte;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Models\Nota; // Asegúrate de tener creado tu modelo Nota
use App\Models\User; // Asegúrate de tener creado tu modelo Alumno
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReporteController extends Controller
{
    public function index()
    {
        $añoActual = Carbon::now()->year;

        // --- 1. GRÁFICA DE TORTA (PIE): Distribución de rendimiento ---
        // Clasificación estándar de calificaciones
        $rangoDeficiente = DB::table('notas')->where('valor_nota', '<', 10)->count();
        $rangoRegular = DB::table('notas')->whereBetween('valor_nota', [10, 14.99])->count();
        $rangoExcelente = DB::table('notas')->where('valor_nota', '>=', 15)->count();


        // --- 2. GRÁFICA DE BARRAS: Aprobados vs Reprobados (Umbral >= 10) ---
        $aprobados = DB::table('notas')->where('valor_nota', '>=', 10)->count();
        $reprobados = DB::table('notas')->where('valor_nota', '<', 10)->count();


        // --- 3. GRÁFICA DE LÍNEAS/BARRAS: Evolución de Promedio Mensual ---
        $promedioMeses = DB::table('notas')
            ->select(
                DB::raw("MONTH(created_at) as mes"),
                DB::raw("AVG(valor_nota) as promedio")
            )
            ->whereYear('created_at', $añoActual)
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        $mesesNombres = [
            1 => 'Ene', 2 => 'Feb', 3 => 'Mar', 4 => 'Abr', 5 => 'May', 6 => 'Jun',
            7 => 'Jul', 8 => 'Ago', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dic'
        ];
        
        $labelsMeses = [];
        $datosMeses = [];
        foreach ($promedioMeses as $item) {
            $labelsMeses[] = $mesesNombres[$item->mes] ?? 'Mes ' . $item->mes;
            $datosMeses[] = round($item->promedio, 2);
        }


        // --- 4. NUEVO REPORTE: Promedio de Notas por Materia (¡Súper útil!) ---
        // Hacemos un JOIN con la tabla 'materias' para mostrar los nombres reales de las asignaturas
        $promedioMaterias = DB::table('notas')
            ->join('materias', 'notas.materia_id', '=', 'materias.id')
            ->select(
                'materias.nombre as materia', // Ajusta 'nombre' si la columna de tu tabla se llama distinto (ej. nombre_materia)
                DB::raw("AVG(notas.valor_nota) as promedio")
            )
            ->groupBy('materias.id', 'materias.nombre')
            ->get();

        $labelsMaterias = [];
        $datosMaterias = [];

        foreach ($promedioMaterias as $item) {
            $labelsMaterias[] = $item->materia;
            $datosMaterias[] = round($item->promedio, 2);
        }

        // Retornamos todas las variables compactadas a la vista
        return view('admin.reportes.index', compact(
            'rangoDeficiente', 
            'rangoRegular', 
            'rangoExcelente',
            'aprobados', 
            'reprobados',
            'labelsMeses', 
            'datosMeses',
            'labelsMaterias', 
            'datosMaterias'
        ));
    }

    public function exportarExcel()
{
    $fileName = 'Reporte_Notas_Academica_' . date('Y-m-d') . '.xls';

    // 1. Unimos 'notas' con 'students'
    // 2. Unimos 'students' con 'users' para obtener el nombre y correo reales
    $notas = DB::table('notas')
        ->join('students', 'notas.student_id', '=', 'students.id')
        ->join('users as estudiante', 'students.user_id', '=', 'estudiante.id')
        ->leftJoin('materias', 'notas.materia_id', '=', 'materias.id')
        ->select(
            'estudiante.name as nombre_estudiante',
            'estudiante.email as correo_estudiante',
            'materias.nombre as materia',
            'notas.nombre_nota',
            'notas.valor_nota',
            'notas.fecha_nota'
        )
        ->get();

    return response()->streamDownload(function() use ($notas) {
        echo '
        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <style>
                th { background-color: #117a8b; color: #ffffff; font-weight: bold; border: 1px solid #cccccc; padding: 6px; }
                td { border: 1px solid #cccccc; padding: 6px; text-align: left; }
                .centro { text-align: center; }
            </style>
        </head>
        <body>
            <table>
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Correo Estudiante</th>
                        <th>Materia</th>
                        <th>Evaluación</th>
                        <th>Nota</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($notas as $nota) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($nota->nombre_estudiante) . '</td>';
            echo '<td>' . htmlspecialchars($nota->correo_estudiante) . '</td>';
            echo '<td>' . htmlspecialchars($nota->materia ?? 'Educación física') . '</td>';
            echo '<td>' . htmlspecialchars($nota->nombre_nota) . '</td>';
            echo '<td class="centro"><b>' . $nota->valor_nota . '</b></td>';
            echo '<td class="centro">' . $nota->fecha_nota . '</td>';
            echo '</tr>';
        }

        echo '
                </tbody>
            </table>
        </body>
        </html>';
    }, $fileName, [
        'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
        'Content-Disposition' => "attachment; filename=\"$fileName\"",
    ]);
    }
}