@include('admin.header')
@include('admin.sidebar')
@stack('nav')

<div class="container">
    @yield('main')
</div>

@include('admin.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/js/core/popper.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/js/plugins/smooth-scrollbar.min.js') }}"></script>

@yield('script')

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
<script src="{{ asset('/js/material-dashboard.min.js') }}"></script>
</body>
</html>
