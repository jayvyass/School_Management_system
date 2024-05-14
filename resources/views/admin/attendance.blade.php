@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Attendance</li>
            </ol>
              <h6 class="font-weight-bolder mb-0 pe-14">Attendance</h6>
        </nav>
    
@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Attendance Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <button class="btn-success" id="addCourseBtn" style="height: 35px;margin-left:17px;">ADD</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-end">
                                <input type="text" id="searchInput" class="form-control" style="height: 40px;width:290px;" placeholder="Search...">
                            </div>
                        </div>
                        <table class="table align-items-center mb-0" id="attendance">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Avatar</th>
                                    <th class="align-middle text-center">Student</th>
                                    <th class="align-middle text-center">Teacher</th>
                                    <th class="align-middle text-center">Month</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{-- Check if the course has a related teacher --}}
                                        @if ($attendance->student)
                                        <img src="{{ $attendance->student->photo }}" alt="Student Photo" class="thumbnail" style="height:50px;width:50px;">
                                        @else
                                        <span class="">No Avatar Found</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        {{-- Check if the course has a related teacher --}}
                                        @if ($attendance->student)
                                        <span class="">{{ $attendance->student->name }}</span>
                                        @else
                                        <span class="">No Student Assigned</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        {{-- Check if the course has a related teacher --}}
                                        @if ($attendance->teacher)
                                        <span class="">{{ $attendance->teacher->name }}</span>
                                        @else
                                        <p>No Teacher Assigned</p>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">
                                            {{ isset($attendance->month) ? $attendance->month : '' }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-success">{{ isset($attendance->status) ? $attendance->status : '' }}</span>
                                    </td>

                                    <td class="align-middle">
                                        <a href="{{ route('attendance.edit', ['id' => isset($attendance->attendance_id) ? $attendance->attendance_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">edit</i> <!-- Edit icon -->
                                        </a>
                                        <a href="{{ route('attendance.view', ['id' => isset($attendance->attendance_id) ? $attendance->attendance_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">visibility</i> <!-- View icon -->
                                        </a>
                                        <a href="{{ route('attendance.delete', ['id' => isset($attendance->attendance_id) ? $attendance->attendance_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
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
        $('#addCourseBtn').click(function() {
            window.location.href = '{{ route("attendance.form") }}';
        });

        // Function to perform search
        function performSearch(query) {
            var csrfToken = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("attendance.search") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    query: query
                },
                success: function(response) {
                    var attendanceData = response.attendancedata;
                    var tbody = $('#attendance tbody');
                    tbody.empty();

                    $.each(attendanceData, function(index, attendance) {

                        var editUrl = '{{ route('attendance.edit', ['id' => ':id']) }}';
                        editUrl = editUrl.replace(':id', attendance.attendance_id);
                        var viewUrl = '{{ route('attendance.view', ['id' => ':id']) }}';
                        viewUrl = viewUrl.replace(':id', attendance.attendance_id);
                        var deleteUrl = '{{ route('attendance.delete', ['id' => ':id']) }}';
                        deleteUrl = deleteUrl.replace(':id', attendance.attendance_id);

                        var row = '<tr>' +
                            '<td class="align-middle text-center">' +
                            (attendance.student ? '<img src="' + attendance.student.photo + '" alt="Student Photo" class="thumbnail" style="height:50px;width:50px;">' : '<p class="text-xs font-weight-bold mb-0">No Avatar Found</p>') +
                            '</td>' +
                            '<td class="align-middle text-center">' +
                            (attendance.student ? '<span >' + attendance.student.name + '</span>' : '<span >No Student Assigned</span>') +
                            '</td>' +
                            '<td class="align-middle text-center">' +
                            (attendance.teacher ? '<span >' + attendance.teacher.name + '</span>' : '<span ">No Teacher Assigned</span>') +
                            '</td>' +
                            '<td class="align-middle text-center">' +
                            (attendance.month ? '<span >' + attendance.month + '</span>' : '<span ">No Teacher Assigned</span>') +
                            '</td>' +
                            '<td class="align-middle text-center text-sm">' +
                            '<span class="badge badge-sm bg-gradient-success">' + (attendance.status ? attendance.status : '') + '</span>' +
                            '</td>' +
                            '<td class="align-middle">' +
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

        var table = $('#attendance').DataTable({
            columns: [
                { data: 'name', searchable: true }, // Change 'name' to 'student.name'
                { data: 'avatar', searchable: false }, // Change 'avatar' to 'student.avatar'
                { data: 'teacher', searchable: true }, // Change 'contact_no' to 'teacher.contact_no'
                { data: 'status', searchable: true },
                { data: 'month', searchable: true },
                { data: 'action', searchable: true } // Change 'action' to the appropriate attribute }
            ],
            dom: '<"row"<"col-md-6"B>>' +
                'rt' +
                '<"row"<"col-md-6"i><"col-md-6 text-end"p>>',
        });
    });
</script>
<style>
    .btn-success {
        background-color: #4CAF50 !important;
        border-color: #4CAF50 !important;
        color: white !important;
        border-radius: 8px !important;
    }
</style>
@endsection
