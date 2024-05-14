
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Results</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Results</h6>
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
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Results</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <button class="btn-success" id="addCourseBtn" style="height: 35px;margin-left:17px;">ADD</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <input type="text" id="searchInput" class="form-control" style="height: 40px;width:290px;" placeholder="Search...">
                            </div>
                        </div>

                        <table class="table align-items-center mb-0" id="results">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Image</th>
                                    <th class="align-middle text-center">Name</th>
                                    <th class="align-middle text-center">Subjects</th>
                                    <th class="align-middle text-center">Percentage(%)</th>
                                    <th class="align-middle text-center">Standard</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                <tr>
                                    <td class="align-middle text-center">
                                        @if ($result->students)
                                        <img src="{{$result->students->photo}}" alt="Student Photo" class="thumbnail" style="height:50px;width:50px;">
                                        @else
                                        <span class="text-xs font-weight-bold mb-0">No Image Found</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($result->students)
                                        <span class="">{{ $result->students->name }}</span>
                                        @else
                                        <span class="text-xs font-weight-bold mb-0">No Student Assigned</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($result->students)
                                        <span class="">{{ $result->students->subjects }}</span>
                                        @else
                                        <span class="text-xs font-weight-bold mb-0">No Teacher Assigned</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        @php
                                        // Check if marks are set and not empty
                                        if (isset($result->marks) && !empty($result->marks)) {
                                        // Convert comma-separated marks into an array of numbers
                                        $marksArray = explode(',', $result->marks);

                                        // Calculate total marks
                                        $totalMarks = array_sum($marksArray);

                                        // Calculate percentage
                                        $totalSubjects = count($marksArray);
                                        $totalPossibleMarks = $totalSubjects * 100; // Assuming each subject is out of 100 marks
                                        $percentage = ($totalMarks / $totalPossibleMarks) * 100;

                                        // Display percentage with two decimal places
                                        echo number_format($percentage, 2) . '%';
                                        } else {
                                        // If marks are not set or empty, display an empty string
                                        echo '';
                                        }
                                        @endphp
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="">{{$result->students->grade}}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-success">{{ isset($result->status) ? $result->status : '' }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('results.edit', ['id' => isset($result->results_id) ? $result->results_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">edit</i> <!-- Edit icon -->
                                        </a>
                                        <a href="{{ route('results.view', ['id' => isset($result->results_id) ? $result->results_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                            <i class="material-icons opacity-10">visibility</i> <!-- View icon -->
                                        </a>
                                        <a href="{{ route('results.delete', ['id' => isset($result->results_id) ? $result->results_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                            <i class="material-icons opacity-10">delete</i> <!-- View icon -->
                                        </a>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#addCourseBtn').click(function() {
            window.location.href = '{{ route("results.form") }}';
        });

        // Function to perform search
        function performSearch(query) {
            var csrfToken = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("results.search") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    query: query
                },
                success: function(response) {
                    var resultData = response.resultdata;
                    var tbody = $('#results tbody');
                    tbody.empty();

                    $.each(resultData, function(index, result) {

                        var editUrl = '{{ route('results.edit', ['id' => ':id']) }}';
                        editUrl = editUrl.replace(':id', result.results_id);
                        var viewUrl = '{{ route('results.view', ['id' => ':id']) }}';
                        viewUrl = viewUrl.replace(':id', result.results_id);
                        var deleteUrl = '{{ route('results.delete', ['id' => ':id']) }}';
                        deleteUrl = deleteUrl.replace(':id', result.results_id);

                        var marksArray = result.marks.split(',').map(Number);
                        var totalMarks = marksArray.reduce((a, b) => a + b, 0);
                        var totalSubjects = marksArray.length;
                        var totalPossibleMarks = totalSubjects * 100;
                        var percentage = (totalMarks / totalPossibleMarks) * 100;

                        var row = '<tr>' +
                            '<td><img src="' + result.students.photo + '" alt="Avatar" class="thumbnail" style="height:50px;width:50px;"></td>' +
                            '<td>' + result.students.name + '</td>' +
                            '<td>' + result.students.subjects + '</td>' +
                            '<td>' + percentage.toFixed(2) + '</td>' +
                            '<td>' + result.students.grade + '</td>' +
                            '<td class="align-middle text-center"><span class="badge badge-sm bg-gradient-success">' + result.status + '</span></td>' +
                            '<td>' +
                            '<a href="' + editUrl + '" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">' +
                            '<i class="material-icons opacity-10">edit</i>' +
                            '</a>' +
                            '<a href="' + viewUrl + '" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">' +
                            '<i class="material-icons opacity-10">visibility</i>' +
                            '</a>' +
                            '<a href="' + deleteUrl + '" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">' +
                            '<i class="material-icons opacity-10">delete</i>' +
                            '</a>' +
                            '</td>' +
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

        var table = $('#results').DataTable({
            columns: [
                { data: 'image', searchable: true },
                { data: 'name', searchable: true },
                { data: 'subjects', searchable: true },
                { data: 'percentage', searchable: true },
                { data: 'standard', searchable: false },
                { data: 'status', searchable: false },
                { data: 'action', searchable: false }
            ],
            dom: '<"row"<"col-md-6"B>>' +
                'rt' +
                '<"row"<"col-md-6"i><"col-md-6 text-end"p>>',
            buttons: [

                {
                    extend: 'pdfHtml5',
                    text: 'Download PDF',
                    className: 'btn-secondary',
                    filename: 'results_pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    className: 'btn-secondary',
                    filename: 'results_csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                }
            ]
        });
    });
</script>
<style>
    .btn-success {
        background-color: #4CAF50 !important;
        border-color: #4CAF50 !important;
        color: white !important;
        border-radius: 5px !important;
    }
</style>
@endsection
