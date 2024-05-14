
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('/img/logo2.png')}}">
  <title>
    Divine Life Management System
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{asset('/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('/css/material-dashboard.css')}}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
          <a class="navbar-brand font-weight-bolder"  id="navbar-brand-link">
              Divine Life Management
            </a>
            <button class="navbar-toggler shadow-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{ url('admin/signin') }}">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Sign In
                  </a>
                </li>
              </ul> 
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('{{asset('/img/illustrations/illustration-signup.jpg')}}'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  <p class="mb-0">Enter your email and password to register</p>
                </div>
                <div class="card-body">
                <form id="signupform" action="{{route('signup')}}" method="POST" onsubmit="return validateForm()">
                  @csrf
                  <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" autocomplete="name">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" autocomplete="email">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                  </div>
                  <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                          I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign Up</button>
                      <!-- <a href="{{ route('google.redirect') }}" class="btn btn-lg bg-gradient-primary btn-lg w-50 mt-4 mb-0">Sign up with Google</a> -->
                  </div>
                  <br>
                  <div class="alert alert-danger" id="errorAlert" style="display: none; color: black;"></div>
                </form>

              <script>
                  function validateForm() {
                      var name = document.getElementById('name').value;
                      var email = document.getElementById('email').value;
                      var password = document.getElementById('password').value;

                      if (name.trim() === '') {
                          showError('Name is required');
                          return false;
                      }

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
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>@endif
                  @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('signin') }}" class="text-primary text-gradient font-weight-bold">Sign in </a>
                    <br> 
                    sign in with Google
                    <a href="{{ route('google.redirect') }}" class="text-primary text-gradient font-weight-bold">here</a>.
                </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="{{asset('/js/core/popper.min.js')}}"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="{{asset('/js/plugins/perfect-scrollbar.min.js')}}"></script>
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
  <script src="{{asset('/js/material-dashboard.min.js')}}"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
</body>
</html>