
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{asset('/img/logo2.png')}}">
  <title>
  Divine Life Management System
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <script src="https://jsuites.net/v4/jsuites.js"></script>
  <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
  <link id="pagestyle" href="{{asset('/css/material-dashboard.css')}}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-1 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3">
            Divine Life Management
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ url('admin/dashboard') }}">
                      <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                      Dashboard
                  </a>
              </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{route('profile')}}" >
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{route('signup')}}">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Sign Up
                  </a>
                </li>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('{{ asset('/img/university.jpg') }}');">
    <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                    </div>
                    <div class="col-2 text-center px-1">
                    </div>
                    <div class="col-2 text-center me-auto">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
              <form id="signinform" action="{{route('signin')}}" method="POST" class="text-start" onsubmit="return validateForm()">
                @csrf  
                <div class="input-group input-group-outline my-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="input-group input-group-outline mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                </div>
                <p class="mt-4 text-sm text-center">
                    <a  href="{{ route('google.redirect') }}" type="submit" class="login-with-google-btn" >Sign in with Google</a>
                    <style>
                     .login-with-google-btn {
                      transition: background-color .3s, box-shadow .3s;
                        
                      padding: 12px 16px 12px 42px;
                      border: none;
                      border-radius: 3px;
                      box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
                      
                      color: #757575;
                      font-size: 14px;
                      font-weight: 500;
                      font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
                      
                      background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
                      background-color: white;
                      background-repeat: no-repeat;
                      background-position: 12px 11px;
                      
                      &:hover {
                        box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 2px 4px rgba(0, 0, 0, .25);
                      }
                      
                      &:active {
                        background-color: #eeeeee;
                      }
                      
                      &:focus {
                        outline: none;
                        box-shadow: 
                          0 -1px 0 rgba(0, 0, 0, .04),
                          0 2px 4px rgba(0, 0, 0, .25),
                          0 0 0 3px #c8dafc;
                      }
                      
                      &:disabled {
                        filter: grayscale(100%);
                        background-color: #ebebeb;
                        box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
                        cursor: not-allowed;
                      }
                    }

                   </style>
                 <br><br>  Don't have an account?
                    <a href="{{route('signup')}}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                    
                </p>
                <div class="alert alert-danger" id="errorAlert" style="display: none; color: black;"></div>
            </form>

            <script>
                function validateForm() {
                    var email = document.getElementById('email').value;
                    var password = document.getElementById('password').value;

                    if (email.trim() === '') {
                        showError('Email is required');
                        return false;
                    }

                    if (password.trim() === '') {
                        showError('Password is required');
                        return false;
                    }

                    return true;
                }
                
                function showError(message) {
                    var errorAlert = document.getElementById('errorAlert');
                    errorAlert.style.display = 'block';
                    errorAlert.innerHTML = message;
                }
            </script>

                  @if(session('success'))
                      <script>
                          jSuites.notification({
                              name: 'Success',                            
                              message: '{{ strtoupper(session('success')) }}',
                          });
                      </script>
                  @endif
                  @if(session('custom_error'))
                      <script>
                          jSuites.notification({
                              error: 2,
                              name: 'Error',                            
                              message: '{{ strtoupper(session('custom_error')) }}',
                              color: '#32CD32',
                          });
                      </script>
                  @endif
                  @if(session('custom2_error'))
                      <script>
                          jSuites.notification({
                              error: 1,
                              name: 'Error',                            
                              message: '{{ strtoupper(session('custom2_error')) }}',
                          });
                      </script>
                  @endif
                  @if(session('error'))
                      <div id="errorAlert" class="alert alert-danger" style="margin-top: 20px;"> <!-- Adjust margin-top as needed -->
                          <ul style="list-style-type: none; padding-left: 0;"> <!-- Remove default list style and padding -->
                              <li style="color: black;">{{ session('error') }}</li>
                          </ul>
                      </div>
                  @endif    
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-end">
            <div class="col-12 col-md-7 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made by 
                <a href="" class="font-weight-bold text-white" target="_blank">Jay Vyas</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('/js/core/popper.min.js')}}" ></script>
<script src="{{asset('/js/core/bootstrap.min.js')}}" ></script>
<script src="{{asset('/js/plugins/perfect-scrollbar.min.js')}}" ></script>
<script src="{{asset('/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('/js/material-dashboard.min.js')}}"></script>
</body>
</html>