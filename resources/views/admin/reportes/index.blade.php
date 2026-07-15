@extends ('layouts.reportes')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa; min-height: 100vh;">
    
    <div class="card shadow-sm mb-4" style="border: none; border-radius: 10px;">
        <div class="card-body text-white" style="background: linear-gradient(135deg, #17a2b8, #117a8b); border-radius: 10px; padding: 25px;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="m-0 font-weight-bold" style="font-size: 1.6rem; letter-spacing: 0.5px;">Reportes Académicos</h3>
                    <p class="m-0 text-white-50 mt-1">Monitoreo en tiempo real del rendimiento estudiantil, materias y calificaciones globales.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow-sm h-100" style="border: none; border-radius: 10px;">
                <div class="card-header bg-white py-3" style="border-bottom: 1px solid #f1f1f1; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <h6 class="m-0 font-weight-bold text-secondary" style="font-size: 1rem;">Distribución General de Rendimiento</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center" style="padding: 20px;">
                    <div style="position: relative; height: 280px; width: 100%;">
                        <canvas id="pieRendimientoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow-sm h-100" style="border: none; border-radius: 10px;">
                <div class="card-header bg-white py-3" style="border-bottom: 1px solid #f1f1f1; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <h6 class="m-0 font-weight-bold text-secondary" style="font-size: 1rem;">Tasa de Aprobación Global</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center" style="padding: 20px;">
                    <div style="position: relative; height: 280px; width: 100%;">
                        <canvas id="doughnutAprobadosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow-sm h-100" style="border: none; border-radius: 10px;">
                <div class="card-header bg-white py-3" style="border-bottom: 1px solid #f1f1f1; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <h6 class="m-0 font-weight-bold text-secondary" style="font-size: 1rem;">Promedio de Notas por Materia</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center" style="padding: 20px;">
                    <div style="position: relative; height: 280px; width: 100%;">
                        <canvas id="barMateriasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow-sm h-100" style="border: none; border-radius: 10px;">
                <div class="card-header bg-white py-3" style="border-bottom: 1px solid #f1f1f1; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <h6 class="m-0 font-weight-bold text-secondary" style="font-size: 1rem;">Evolución del Promedio de Calificaciones</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center" style="padding: 20px;">
                    <div style="position: relative; height: 280px; width: 100%;">
                        <canvas id="lineMesesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- 1. GRÁFICO DE PIE (DISTRIBUCIÓN DE NOTAS) ---
        const ctxPie = document.getElementById('pieRendimientoChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Deficiente (0-09)', 'Regular (10-14)', 'Excelente (15-20)'],
                datasets: [{
                    data: [{{ $rangoDeficiente }}, {{ $rangoRegular }}, {{ $rangoExcelente }}],
                    backgroundColor: ['#e74c3c', '#f1c40f', '#2ecc71'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // --- 2. GRÁFICO DE DOUGHNUT (APROBADOS VS REPROBADOS) ---
        const ctxDoughnut = document.getElementById('doughnutAprobadosChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Aprobados (Nota ≥ 10)', 'Reprobados (Nota < 10)'],
                datasets: [{
                    data: [{{ $aprobados }}, {{ $reprobados }}],
                    backgroundColor: ['#17a2b8', '#e67e22'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                },
                cutout: '65%' // Hace que el centro sea hueco y estilizado
            }
        });

        // --- 3. GRÁFICO DE BARRAS (PROMEDIOS POR MATERIA) ---
        const ctxMaterias = document.getElementById('barMateriasChart').getContext('2d');
        new Chart(ctxMaterias, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelsMaterias) !!},
                datasets: [{
                    label: 'Promedio Obtenido',
                    data: {!! json_encode($datosMaterias) !!},
                    backgroundColor: 'rgba(23, 162, 184, 0.85)',
                    borderColor: '#17a2b8',
                    borderWidth: 1.5,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        max: 20,
                        ticks: { stepSize: 5 }
                    }
                }
            }
        });

        // --- 4. GRÁFICO DE LÍNEA (EVOLUCIÓN MENSUAL) ---
        const ctxMeses = document.getElementById('lineMesesChart').getContext('2d');
        new Chart(ctxMeses, {
            type: 'line',
            data: {
                labels: {!! json_encode($labelsMeses) !!},
                datasets: [{
                    label: 'Promedio del Mes',
                    data: {!! json_encode($datosMeses) !!},
                    borderColor: '#117a8b',
                    backgroundColor: 'rgba(17, 122, 139, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3, // Curvatura suave de la línea
                    pointBackgroundColor: '#117a8b',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        max: 20,
                        ticks: { stepSize: 5 }
                    }
                }
            }
        });

    });
</script>
@endsection