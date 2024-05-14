@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>

@section('main')
@if(session('success'))
<div class="custom-alert" role="alert">
    {{ session('success') }}
    <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
</div>
@endif
<style>
    .custom-alert {
        padding: 15px;
        background-color: #4CAF50;
        color: white;
        margin-bottom: 15px;
        border: 1px solid transparent;
        border-radius: 4px;
        font-size: 28px;
    }

    .close-btn {
        cursor: pointer;
        position: absolute;
        right: 20px;
        top: 5px;
        color: white;
        font-size: 36px;
        font-weight: bold;
    }
</style>
<div id="content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Students</p>
                            <h4 class="mb-0">{{ $totalStudents }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-{{ $iconClass }} text-sm font-weight-bolder">{{ $percentageChange }}</span> than last year</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Teachers</p>
                            <h4 class="mb-0">{{ $totalTeachers }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-{{ $iconClass3 }} text-sm font-weight-bolder">{{ $percentageChangeTeachers }}</span> than last year</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">book</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Courses</p>
                            <h4 class="mb-0">{{ $totalCourses }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-{{ $iconClass2 }} text-sm font-weight-bolder">{{ $percentageFallCourses }}</span> than last Sem</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">domain</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Classes</p>
                            <h4 class="mb-0">{{ $totalClasses }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{ floor($totalClasses / 10) * 10 }}+</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-5 col-md-6 mt-5 mb-4 mx-5">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <div id="app">
                                <canvas id="chart-bar" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0 ">Attendance Data</h4>
                        <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons opacity-10">event_available</i>
                            <p class="mb-0 text-sm search-target">Students Attendance</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mt-5 mb-4 mx-4">
                <div class="card z-index-2  ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                            <div id="app">
                                <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0 ">Result Data</h4>
                        <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons opacity-10">assessment</i>
                            <p class="mb-0 text-sm">Students Performance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4 mx-2">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="text-center mb-2">
                            <h4 class="text-success">Toppers Of Divine Life</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Image</th>
                                    <th class="align-middle text-center">Name</th>
                                    <th class="align-middle text-center">Standard</th>
                                    <th class="align-middle text-center">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topStudents as $student)
                                @php
                                $name = $student->students->name;
                                $standard = $student->students->grade;
                                $image = $student->students->photo;
                                $percentage = $student->percentage;
                                @endphp
                                <tr>
                                    <td class="align-middle text-center">
                                        {{-- Check if the course has a related teacher --}}
                                        <img src="{{ $image }}" alt="Student Photo" class="thumbnail" style="height:50px;width:50px;">
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{ $name }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{ $standard }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="progress-wrapper w-75 mx-auto">
                                            <div class="progress-info">
                                                <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold">{{ $percentage }}</span>
                                                </div>
                                            </div>
                                            <div class="align-middle text-center">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percentage }}%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/plugins/chartjs.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Vue({
        el: '#app',
        mounted() {
            // Chart.js initialization for bar chart
            var ctx2 = document.getElementById("chart-bar").getContext("2d");
            new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: "Present",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 255, 255, .8)",
                        pointBorderColor: "transparent",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderWidth: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        data: <?php echo json_encode($totalPresentPerMonth); ?>,
                        maxBarThickness: 6
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

            // Chart.js initialization for line chart
            var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");
            new Chart(ctx3, {
                type: "line",
                data: {
                    labels: <?php echo json_encode($sortedGrades); ?>,
                    datasets: [{
                        label: "Result",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 255, 255, .8)",
                        pointBorderColor: "transparent",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderWidth: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        data: <?php echo json_encode($sortedPercentages); ?>,
                        maxBarThickness: 6
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#f8f9fa',
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    });
</script>
@endsection
