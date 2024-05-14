@extends('admin.admin')
@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Teachers</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Teachers</h6>
        </nav>
@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Teachers table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <button class="btn-success" id="addCourseBtn" style="height: 40px;margin-left:17px;">ADD</button>
                                    </div>
                                    <div class="col-md-6">
                                      <select id="subjectFilter" class="form-select" style="height: 40px; width: 157px;">
                                          <option selected value='' disabled>Select Subject</option>
                                          <option value="Reset">Reset Filter</option>
                                          @php
                                              $uniqueSubjects = [];
                                          @endphp
                                          @foreach($courses as $course)
                                              @if (!in_array($course->course_name, $uniqueSubjects))
                                                  @php
                                                      $uniqueSubjects[] = $course->course_name;
                                                  @endphp
                                                  <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
                                              @endif
                                          @endforeach
                                      </select>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-end">
                                <input type="text" id="searchInput" class="form-control" style="height: 40px;width:290px;" placeholder="Search...">
                            </div>
                        </div>
                        <table class="display" id="teachers">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Image</th>
                                    <th class="align-middle text-center">Name</th>
                                    <th class="align-middle text-center">Email</th>
                                    <th class="align-middle text-center">Subjects</th>
                                    <th class="align-middle text-center">Designation</th>
                                    <th class="align-middle text-center">Contact</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                <tr>
                                    <td class="align-middle text-center">
                                        <div class="image-box">
                                            <img src="{{ asset('admin/'.$teacher->photo) }}" alt="Student Image" class="thumbnail" style="height:50px;width:50px;">
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <!-- <img src="{{ isset($teacher->photo) ? asset($teacher->photo) : '' }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1"> -->
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ isset($teacher->name) ? $teacher->name : '' }}</h6>
                                                <!-- <p class="text-xs text-secondary mb-0">{{ isset($teacher->email) ? $teacher->email : '' }}</p> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ isset($teacher->email) ? $teacher->email : '' }}
                                    </td>
                                    <td>
                                        <span class="">{{ isset($teacher->subject) ? $teacher->subject : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{ isset($teacher->designation) ? $teacher->designation : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{ isset($teacher->contact_no) ? $teacher->contact_no : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-success">{{ isset($teacher->status) ? $teacher->status : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('teachers.edit', ['id' => isset($teacher->teachers_id) ? $teacher->teachers_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">edit</i> <!-- Edit icon -->
                                        </a>
                                        <a href="{{ route('teachers.view', ['id' => isset($teacher->teachers_id) ? $teacher->teachers_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                            <i class="material-icons opacity-10">visibility</i> <!-- View icon -->
                                        </a>
                                        <a href="{{ route('teachers.delete', ['id' => isset($teacher->teachers_id) ? $teacher->teachers_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
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
            window.location.href = '{{ route("teachers.form") }}';
        });
        // Function to perform search
        function performSearch(query, subject) {
            var csrfToken = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("teachers.search") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    query: query,
                    subject: subject
                },
                success: function(response) {
                    var teacherData = response.teacherdata;
                    var tbody = $('#teachers tbody');
                    tbody.empty();

                    $.each(teacherData, function(index, teacher) {

                        var editUrl = '{{ route('teachers.edit', ['id' => ':id']) }}';
                        editUrl = editUrl.replace(':id', teacher.teachers_id);
                        var viewUrl = '{{ route('teachers.view', ['id' => ':id']) }}';
                        viewUrl = viewUrl.replace(':id', teacher.teachers_id);
                        var deleteUrl = '{{ route('teachers.delete', ['id' => ':id']) }}';
                        deleteUrl = deleteUrl.replace(':id', teacher.teachers_id);


                        var row = '<tr>' +
                            '<td class="align-middle text-center"><img src="' + teacher.photo + '" alt="Avatar" class="thumbnail" style="height:50px;width:50px;"></td>' +
                            '<td class="align-middle text-center">' + teacher.name + '</td>' +
                            '<td class="align-middle text-center">' + teacher.email + '</td>' +
                            '<td class="align-middle text-center">' + teacher.subject + '</td>' +
                            '<td class="align-middle text-center">' + teacher.designation + '</td>' +
                            '<td class="align-middle text-center">' + teacher.contact_no + '</td>' +
                            '<td class="align-middle text-center"><span class="badge badge-sm bg-gradient-success">' + teacher.status + '</span></td>' +
                            '<td class="align-middle text-center">' +
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

        var table = $('#teachers').DataTable({
            columns: [
                { data: 'avatar', searchable: true },
                { data: 'name', searchable: true },
                { data: 'email', searchable: true },
                { data: 'subjects', searchable: true },
                { data: 'designation', searchable: true },
                { data: 'contact_no', searchable: true },
                { data: 'status', searchable: false },
                { data: 'action', searchable: false }
            ],
            dom: '<"row"<"col-md-6"B>>' +
                'rt' +
                '<"row"<"col-md-6"i><"col-md-6 text-end"p>>',

        });
        $('#searchInput').on('keyup', function() {
            var query = $(this).val();
            var subject = $('#subjectFilter').val(); // Get the selected subject filter
            performSearch(query, subject); // Perform search with both query and subject filter
        });

        // Function to handle subject filter change
        $('#subjectFilter').on('change', function() {
            var query = $('#searchInput').val(); // Get the current search query
            var subject = $(this).val(); // Get the selected subject filter
            performSearch(query, subject); // Perform search with both query and subject filter
        });
    });

</script>
<style>
    .btn-success {

        background-color: #4CAF50!important;
        border-color: #4CAF50!important;
        color: white !important;
        border-radius: 5px !important;


    }
</style>
@endsection
