@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            {{-- Titre --}}
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard Directeur</h1>
                </div>

                {{-- Graphiques --}}
                <div class="row">
                    {{-- Absence Chart --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card p-3 rounded shadow-sm h-100">
                            <div id="absenceChart"
                                 class="h-80"
                                 data-jours='@json($absenceJours)'
                                 data-pourcentages='@json($absencePourcentages)'>
                            </div>
                        </div>
                    </div>

                    {{-- Avancement Chart --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card p-3 rounded shadow-sm h-100">
                            <div id="tauxChart"
                                 class="h-80"
                                 data-jours='@json($avancementJours)'
                                 data-pourcentages='@json($avancementPourcentages)'>
                            </div>
                        </div>
                    </div>

                    {{-- Missions Bar Chart --}}
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card p-3 rounded shadow-sm h-100">
                            <div id="missionsChart"
                                 class="h-80"
                                 data-dates='@json($missionDates)'
                                 data-counts='@json($missionCounts)'>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Missions Détails --}}
               
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const drawPieChart = (elId, labelKey, seriesKey, title) => {
            const el = document.querySelector(elId);
            if (el) {
                const labels = JSON.parse(el.dataset[labelKey]);
                const series = JSON.parse(el.dataset[seriesKey]);

                new ApexCharts(el, {
                    chart: { type: 'pie', height: 300 },
                    labels: labels,
                    series: series,
                    title: { text: title, align: 'center' },
                    colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560'],
                    dataLabels: {
                        formatter: val => val.toFixed(1) + '%'
                    }
                }).render();
            }
        };

        const drawBarChart = (elId, xKey, yKey, title) => {
            const el = document.querySelector(elId);
            if (el) {
                const categories = JSON.parse(el.dataset[xKey]);
                const data = JSON.parse(el.dataset[yKey]);

                new ApexCharts(el, {
                    chart: { type: 'bar', height: 300 },
                    series: [{ name: 'Nombre de Missions', data: data }],
                    xaxis: { categories: categories },
                    title: { text: title, align: 'center' },
                    colors: ['#008FFB'],
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                position: 'top'
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: val => val,
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    }
                }).render();
            }
        };

        drawPieChart('#absenceChart', 'jours', 'pourcentages', 'Absence Pourcentage');
        drawPieChart('#tauxChart', 'jours', 'pourcentages', 'Avancement Pourcentage');
        drawBarChart('#missionsChart', 'dates', 'counts', 'Missions En Cours');
    });
</script>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const toastElList = [].slice.call(document.querySelectorAll('.toast'))
        toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl).show()
        })
    });
</script>

@endsection
