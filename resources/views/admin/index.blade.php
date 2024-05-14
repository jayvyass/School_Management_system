@extends('admin.admin')
@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Index</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Index</h6>
        </nav>
        
@section('main')
<!-- End Navbar -->
@if(session('success'))
    <div class="custom-alert" role="alert">
        {{ session('success') }}
        <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
@endif
<style>.custom-alert {
    padding: 15px;
    background-color: #4CAF50;
    color: white;
    margin-bottom: 15px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.close-btn {
    cursor: pointer;
    position: absolute;
    right: 20px;
    top: 5px;
    color: white;
    font-size: 20px;
    font-weight: bold;
}
</style>
<div id="content">
<div class="container-fluid py-4">
<h6>If you are not redirected automatically, follow <a href="{{asset(route('dashboard'))}}">this link</a>.</h6>
<div class="row">
  <div class="col-lg-7 position-relative z-index-2">
    <div class="card card-plain mb-4">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-lg-6">
            <div class="d-flex flex-column h-100">
             <h2 class="font-weight-bolder mb-0">General Statistics</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-sm-5">
        <div class="card  mb-2">
  <div class="card-header p-3 pt-2">
    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">group</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize">Students</p>
      <h4 class="mb-0">1000+</h4>
    </div>
  </div>

  <hr class="dark horizontal my-0">
  <div class="card-footer p-3">
    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+20% </span>than last year</p>
  </div>
</div>

        <div class="card  mb-2">
  <div class="card-header p-3 pt-2">
    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">person</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize">Teachers</p>
      <h4 class="mb-0">50+</h4>
    </div>
  </div>

  <hr class="dark horizontal my-0">
  <div class="card-footer p-3">
    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+10% </span>than last year</p>
  </div>
</div>

      </div>
      <div class="col-lg-5 col-sm-5 mt-sm-0 mt-4">
        <div class="card  mb-2">
  <div class="card-header p-3 pt-2 bg-transparent">
    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">book</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize ">Courses</p>
      <h4 class="mb-0 ">100+</h4>
    </div>
  </div>

  <hr class="horizontal my-0 dark">
  <div class="card-footer p-3">
    <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+5% </span>than last year</p>
  </div>
</div>

        <div class="card ">
  <div class="card-header p-3 pt-2 bg-transparent">
    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">domain</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize ">Classes</p>
      <h4 class="mb-0 ">60+</h4>
    </div>
  </div>

  <hr class="horizontal my-0 dark">
  <div class="card-footer p-3">
    <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+30% </span>than last year</p>
  </div>
</div>

      </div>
    </div>

    <div class="row mt-4">
      <div class="col-10">
        <div class="card mb-4 ">
  <div class="d-flex">
    <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
      <i class="material-icons opacity-10" aria-hidden="true">language</i>
    </div>
    <h6 class="mt-3 mb-2 ms-3 ">Admissions by Country</h6>
  </div>
  <div class="card-body p-3">
    <div class="row">
      <div class="col-lg-7 position-relative z-index-2"></div>
      <!-- <div class="col-lg-6 col-md-7"> -->
        <div class="table-responsive" >
          <table class="table align-items-center ">
            <tbody>
              <tr>
                <td class="w-30">
                  <div class="d-flex px-2 py-1 align-items-center">
                    <div>
                      <img src="{{asset('/img/icons/flags/US.png')}}" alt="Country flag">
                    </div>
                    <div class="ms-4">
                      <p class="text-xs font-weight-bold mb-0 ">Country:</p>
                      <h6 class="text-sm font-weight-normal mb-0 ">United States</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Admission:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">37</h6>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Acceptance Rate:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">25%</h6>
                  </div>
                </td>
                <td class="align-middle text-sm">
                  <div class="col text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Avg GPA:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">7.9</h6>
                  </div>
                </td>
              </tr>

              <tr>
                <td class="w-30">
                  <div class="d-flex px-2 py-1 align-items-center">
                    <div>
                      <img src="{{asset('/img/icons/flags/DE.png')}}" alt="Country flag">
                    </div>
                    <div class="ms-4">
                      <p class="text-xs font-weight-bold mb-0 ">Country:</p>
                      <h6 class="text-sm font-weight-normal mb-0 ">Germany</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Admission:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">49</h6>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Acceptance Rate:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">33%</h6>
                  </div>
                </td>
                <td class="align-middle text-sm">
                  <div class="col text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Avg GPA:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">8.2</h6>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-30">
                  <div class="d-flex px-2 py-1 align-items-center">
                    <div>
                      <img src="{{asset('/img/icons/flags/IND.png')}}"style ="height:17px;width:23px" alt="Country flag">
                    </div>
                    <div class="ms-4">
                      <p class="text-xs font-weight-bold mb-0 ">Country:</p>
                      <h6 class="text-sm font-weight-normal mb-0 ">India</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Admission:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">73</h6>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Acceptance Rate:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">59%</h6>
                  </div>
                </td>
                <td class="align-middle text-sm">
                  <div class="col text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Avg GPA:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">8.6</h6>
                  </div>
                </td>
              </tr>

              <tr>
                <td class="w-30">
                  <div class="d-flex px-2 py-1 align-items-center">
                    <div>
                      <img src="{{asset('/img/icons/flags/BR.png')}}" alt="Country flag">
                    </div>
                    <div class="ms-4">
                      <p class="text-xs font-weight-bold mb-0 ">Country:</p>
                      <h6 class="text-sm font-weight-normal mb-0 ">Brasil</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Admission:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">26</h6>
                  </div>
                </td>
                <td>
                  <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Acceptance Rate:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">18%</h6>
                  </div>
                </td>
                <td class="align-middle text-sm">
                  <div class="col text-center">
                    <p class="text-xs font-weight-bold mb-0 ">Avg GPA:</p>
                    <h6 class="text-sm font-weight-normal mb-0 ">6.8</h6>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-6 col-md-5">
        <div id="map" class="mt-0 mt-lg-n4"></div>
      </div>
    </div>
  </div>
</div>
</div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-lg-5 mb-lg-0 mb-4">
    <div class="card z-index-2 mt-4">
  <div class="card-body mt-n5 px-3">
    <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1 mb-3">
      <div class="chart">
        <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
      </div>
    </div>
    <h6 class="ms-2 mt-4 mb-0"> Active Users </h6>
    <p class="text-sm ms-2"> (<span class="font-weight-bolder">+11%</span>) than last week </p>
    <div class="container border-radius-lg">
      <div class="row">
        <div class="col-3 py-3 ps-0">
          <div class="d-flex mb-2">
            <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">groups</i>
            </div>
            <p class="text-xs my-auto font-weight-bold">Users</p>
          </div>
          <h4 class="font-weight-bolder">1000+</h4>
          <div class="progress w-75">
            <div class="progress-bar bg-dark w-70" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="col-3 py-3 ps-0">
          <div class="d-flex mb-2">
            <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">ads_click</i>
            </div>
            <p class="text-xs mt-1 mb-0 font-weight-bold">Clicks</p>
          </div>
          <h4 class="font-weight-bolder">2.7k</h4>
          <div class="progress w-75">
            <div class="progress-bar bg-dark w-60" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="col-3 py-3 ps-0">
          <div class="d-flex mb-2">
            <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">group</i>
            </div>
            <p class="text-xs mt-1 mb-0 font-weight-bold">Enrollment</p>
          </div>
          <h4 class="font-weight-bolder">700</h4>
          <div class="progress w-75">
            <div class="progress-bar bg-dark w-75" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="col-3 py-3 ps-0">
          <div class="d-flex mb-2">
            <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">book</i>
            </div>
            <p class="text-xs mt-1 mb-0 font-weight-bold">Courses</p>
          </div>
          <h4 class="font-weight-bolder">74</h4>
          <div class="progress w-75">
            <div class="progress-bar bg-dark w-90" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  </div>
  <div class="col-lg-7">
    <div class="card z-index-2">
  <div class="card-header pb-0">
    <h6>Admissions overview</h6>
    <p class="text-sm">
      <i class="fa fa-arrow-up text-success"></i>
      <span class="font-weight-bold">21% more</span> in 2024
    </p>
  </div>
  <div class="card-body p-3">
    <div class="bg-gradient-dark shadow-primary border-radius-lg py-3 pe-1 mb-3">
    <div class="chart">
      <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
    </div>
  </div>
</div>

  </div>
</div>

<div class="row">
  <div class="col-12">
    <div id="globe" class="position-absolute end-0 top-10 mt-sm-3 mt-7 me-lg-7">
      <canvas width="700" height="600" class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
    </div>
  </div>
</div>
</div>
<script src="{{asset('/js/plugins/chartjs.min.js')}}"></script>
<script>
   var ctx = document.getElementById("chart-bars").getContext("2d");
new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["M", "T", "W", "T", "F", "S", "S"],
    datasets: [{
      label: "Visitors",
      tension: 0.4,
      borderWidth: 0,
      borderRadius: 4,
      borderSkipped: false,
      backgroundColor: "rgba(255, 255, 255, .8)",
      data: [150, 220, 170, 202, 160, 188, 140],
      maxBarThickness: 6
    }, ],
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
          suggestedMin: 0,
          suggestedMax: 500,
          beginAtZero: true,
          padding: 10,
          font: {
            size: 14,
            weight: 300,
            family: "Roboto",
            style: 'normal',
            lineHeight: 2
          },
          color: "#fff"
        },
      },
      x: {
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
    },
  },
});


var ctx2 = document.getElementById("chart-line").getContext("2d");

new Chart(ctx2, {
  type: "line",
  data: {
    labels: [ "2019", "2020", "2021", "2022", "2023", "2024"],
    datasets: [{
      label: "NewStudents",
      tension: 0,
      borderWidth: 0,
      pointRadius: 5,
      pointBackgroundColor: "rgba(255, 255, 255, .8)",
      pointBorderColor: "transparent",
      borderColor: "rgba(255, 255, 255, .8)",
      borderColor: "rgba(255, 255, 255, .8)",
      borderWidth: 4,
      backgroundColor: "transparent",
      fill: true,
      data: [ 366, 384, 479, 495, 553, 700],
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
</script>
@endsection