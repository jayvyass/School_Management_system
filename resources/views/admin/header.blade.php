<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('img/logos/logo2.png') }}">
    <title>Divine Life International</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('/css/material-dashboard.css') }}" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<body>
    
<div class="main-content position-relative max-height-vh-100 h-100">
    <!-- <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">  -->
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            @if(request()->is('admin/dashboard'))
                <div class="ms-md-auto pe-md-3 d-flex align-items-center search-container">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Search Content:</label>
                        <input type="text" id="GlobalsearchInput" class="form-control" oninput="highlightSearch()">
                    </div>
                </div>
            @endif
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('logoutt') }}" class="nav-link text-body font-weight-bold px-0" id="logoutLink">
                        <i class="fa fa-sign-out-alt me-sm-1"></i>
                        <span class="d-sm-inline d-none">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
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
    </nav>
</div>
<script>
    document.getElementById('logoutLink').addEventListener('click', function(event) {
        event.preventDefault();
        $('#staticBackdrop').modal('show');
    });

    document.getElementById('confirmLogout').addEventListener('click', function() {
        window.location.href = "{{ route('logoutt') }}"; // Redirect to the logout route
    });

    function highlightSearch() {
        var searchInput = document.getElementById('GlobalsearchInput').value;
        var contentElements = document.querySelectorAll(' #content .search-target ,#content p, #content h6, #content th, #content td, #content .text-end h4');
        contentElements.forEach(function(element) {
            var content = element.textContent || element.innerText; // Get the text content of the element
            var highlightedContent = content.replace(new RegExp(escapeRegExp(searchInput), 'gi'), match => `<span class="highlight">${match}</span>`);
            element.innerHTML = highlightedContent;
        });
    }

    // Function to escape special characters in a regular expression
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Other scripts -->
<style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }
</style>
</body>
</html>
