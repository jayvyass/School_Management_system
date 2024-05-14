@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Courses</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Courses</h6>
        </nav>
 

@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Courses Table</h6>
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
                        <table class="table align-items-center mb-0" id="courses">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Subject</th>
                                    <th class="align-middle text-center">Faculty</th>
                                    <th class="align-middle text-center">Semester</th>
                                    <th class="align-middle text-center">Credits</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="">{{ isset($course->course_name) ? $course->course_name : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        {{-- Check if the course has a related teacher --}}
                                        @if ($course->teacher)
                                        <span class="">{{ $course->teacher->name }}</span>
                                        @else
                                        <span class="">No Teacher Assigned</span>
                                        @endif                   
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{ isset($course->semester) ? $course->semester : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{isset($course->credits) ? $course->credits : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-success">{{ isset($course->status) ? $course->status : '' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('courses.edit', ['id' => isset($course->course_id) ? $course->course_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">edit</i> <!-- Edit icon -->
                                        </a> 

                                        <a href="{{ route('courses.view', ['id' => isset($course->course_id) ? $course->course_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                            <i class="material-icons opacity-10">visibility</i> <!-- View icon -->
                                        </a> 
                                        <a href="{{ route('courses.delete', ['id' => isset($course->course_id) ? $course->course_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                            <i class="material-icons opacity-10">delete</i> <!-- View icon -->
                                        </a>
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
    // Handle click event on the "ADD" button
    $('#addCourseBtn').click(function() {
        window.location.href = '{{ route("courses.form") }}';
    });

    // Function to perform search
    function performSearch(query) {
        var csrfToken = '{{ csrf_token() }}';

        $.ajax({
            url: '{{ route("courses.search") }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                _token: csrfToken,
                query: query
            },
            success: function(response) {
                var courseData = response.coursedata;
                var tbody = $('#courses tbody');
                tbody.empty();

                $.each(courseData, function(index, course) {
                    var editUrl = '{{ route('courses.edit', ['id' => ':id']) }}';
                    editUrl = editUrl.replace(':id', course.course_id);
                    var viewUrl = '{{ route('courses.view', ['id' => ':id']) }}';
                    viewUrl = viewUrl.replace(':id', course.course_id);
                    var deleteUrl = '{{ route('courses.delete', ['id' => ':id']) }}';
                    deleteUrl = deleteUrl.replace(':id', course.course_id);

                    var row = '<tr>' +
                        '<td class="align-middle text-center">' + course.course_name + '</td>' +
                        '<td class="align-middle text-center">' + (course.teacher ? course.teacher.name : 'No Teacher Assigned') + '</td>' +
                        '<td class="align-middle text-center">' + course.semester + '</td>' +
                        '<td class="align-middle text-center">' + course.credits + '</td>' +
                        '<td class="align-middle text-center"><span class="badge badge-sm bg-gradient-success">' + course.status + '</span></td>' +                       
                        '<td>' +
                        '<a href="' + editUrl + '" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View course">' +
                        '<i class="material-icons opacity-10">edit</i>' +
                        '</a>' +
                        '<a href="' + viewUrl + '" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View course">' +
                        '<i class="material-icons opacity-10">visibility</i>' +
                        '</a>' +
                        '<a href="' + deleteUrl + '" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete course">' +
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

    // Initialize DataTable for courses table
    var table = $('#courses').DataTable({
        columns: [
            { data: 'subject', searchable: true },
            { data: 'faculty', searchable: true },
            { data: 'semester', searchable: true },
            { data: 'credits', searchable: true },
            { data: 'status', searchable: false },
            { data: 'action', searchable: false }
        ],
        dom: '<"row"<"col-md-6"B>>' + 
             'rt' + 
             '<"row"<"col-md-6"i><"col-md-6 text-end"p>>',
    });
});
</script>
<style>
.btn-success {
    background-color:   #4CAF50 !important;
    border-color:  #4CAF50 !important;
    color: white !important;
    border-radius: 8px !important;
}
</style>
@endsection
