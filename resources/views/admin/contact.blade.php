@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Contact_us</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Contact_us</h6>
        </nav>
  

@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Contact_us table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <!-- Your buttons or other content -->
                            </div>
                            <div class="col-md-1 text-end">
                                <input type="text" id="searchInput" class="form-control" style="height: 40px;width:290px;" placeholder="Search...">
                            </div>
                        </div>
                        <table class="display" id="contact_us">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Id</th>                                      
                                    <th class="align-middle text-center">Name</th>
                                    <th class="align-middle text-center">Email</th>
                                    <th class="align-middle text-center">Subject</th> 
                                    <th class="align-middle text-center">Message</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contactForms as $contactForm)
                                <tr>
                                    <td class="align-middle text-center">
                                        <span>{{ $contactForm->id }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span>{{ $contactForm->name }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span>{{ $contactForm->email }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span>{{ $contactForm->subject }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span>{{ $contactForm->message }}</span>
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
@endsection  

@section('script')
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script>
    $(document).ready(function() {
        // Function to perform search
        function performSearch(query) {
            var csrfToken = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("contact_us.search") }}', // Updated route name
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    query: query
                },
                success: function(response) {
                    var contactData = response.contactdata; // Updated variable name
                    var tbody = $('#contact_us tbody'); // Updated table ID
                    tbody.empty();

                    $.each(contactData, function(index, contact) { // Updated variable name
                        var row = '<tr>' +
                            '<td class="align-middle text-center">' + contact.id + '</td>' +
                            '<td class="align-middle text-center">' + contact.name + '</td>' +
                            '<td class="align-middle text-center">' + contact.email + '</td>' +
                            '<td class="align-middle text-center">' + contact.subject + '</td>' +
                            '<td class="align-middle text-center">' + contact.message + '</td>' +
                            '</tr>';
                        tbody.append(row);
                    });
                }
            });
        }

        // Listen for changes in the search input field
        $('#searchInput').on('keyup', function() {
            var query = $(this).val();
            performSearch(query);
        });

        var table = $('#contact_us').DataTable({ // Updated table ID
            columns: [
                { data: 'id', searchable: true }, 
                { data: 'name', searchable: true }, // Updated column names
                { data: 'email', searchable: true }, // Updated column names
                { data: 'subject', searchable: true }, // Updated column names
                { data: 'message', searchable: true }, // Updated column names
            ],
            dom: '<"row"<"col-md-6"B>>' + 
                 'rt' + 
                 '<"row"<"col-md-6"i><"col-md-6 text-end"p>>',
        });
    });
</script>
<style>
    .btn-success {  
        background-color:  #e91e63 !important;
        border-color:  #e91e63 !important;
        color: white !important;
        border-radius: 8px !important;
    }
</style>
@endsection
