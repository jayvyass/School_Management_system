<body class="g-sidenav-show bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{asset(route('dashboard'))}}" target="_blank">
                <img src="{{asset('/img/logos/logo2.png')}}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">Divine Life Management</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                @if(auth()->user()->roles === 'admin')
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('students') ? 'active' : '' }}" href="{{ route('students') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <span class="nav-link-text ms-1">Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('teachers') ? 'active' : '' }}" href="{{ route('teachers') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">school</i>
                        </div>
                        <span class="nav-link-text ms-1">Teachers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('courses') ? 'active' : '' }}" href="{{ route('courses') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">class</i>
                        </div>
                        <span class="nav-link-text ms-1">Courses</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->roles === 'teacher' || auth()->user()->roles === 'admin')
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('attendance') ? 'active' : '' }}" href="{{ route('attendance') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">event_available</i>
                        </div>
                        <span class="nav-link-text ms-1">Attendance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('results') ? 'active' : '' }}" href="{{ route('results') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">assessment</i>
                        </div>
                        <span class="nav-link-text ms-1">Results</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->roles === 'admin')
                <li>
                    <a class="nav-link text-white" id="frontendManagementToggle">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">menu</i>
                        </div>
                        <span class="nav-link-text ms-1">Frontend Pages</span>
                    </a>
                    <ul class="navbar-nav collapse" id="frontendManagementSubmenu">
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('class') ? 'active' : '' }}" href="{{ route('class') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">class</i>
                                </div>
                                <span class="nav-link-text ms-1">Classes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('banners') ? 'active' : '' }}" href="{{ route('banners') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">photo</i>
                                </div>
                                <span class="nav-link-text ms-1">Banners</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('touch') ? 'active' : '' }}" href="{{ route('touch') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">details</i>
                                </div>
                                <span class="nav-link-text ms-1">Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('facilities') ? 'active' : '' }}" href="{{ route('facilities') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">home</i>
                                </div>
                                <span class="nav-link-text ms-1">Facilities</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('reviews') ? 'active' : '' }}" href="{{ route('reviews') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">star</i>
                                </div>
                                <span class="nav-link-text ms-1">reviews</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('contact_us') ? 'active' : '' }}" href="{{ route('contact_us') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">phone</i>
                                </div>
                                <span class="nav-link-text ms-1">contact</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('users') ? 'active' : '' }}" href="{{ route('users') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">account_circle</i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('logoutt') }}" id="logoutlink">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">exit_to_app</i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel">Logging Out</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Are you sure you want to log out?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="confirmLogout" type="button" class="btn btn-primary">log out</button>
                    </div>
                </div>
            </div>
        </div>
        </hr>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var toggle = document.getElementById("frontendManagementToggle");
                var submenu = document.getElementById("frontendManagementSubmenu");
                var submenuItems = submenu.querySelectorAll(".nav-link");
                toggle.addEventListener("click", function() {
                    if (submenu.classList.contains("show")) {
                        submenu.classList.remove("show");
                    } else {
                        submenu.classList.add("show");
                    }
                });

                submenuItems.forEach(function(item) {
                    item.addEventListener("click", function(event) {
                        submenuItems.forEach(function(submenuItem) {
                            submenuItem.classList.remove("active");
                        });
                        item.classList.add("active");
                        submenu.classList.add("show");
                    });
                });

                document.getElementById('logoutlink').addEventListener('click', function(event) {
                    event.preventDefault();
                    $('#staticBackdrop').modal('show');
                });

                document.getElementById('confirmLogout').addEventListener('click', function() {
                    window.location.href = "{{ route('logoutt') }}"; // Redirect to the logout route
                });
            });
        </script>
  
