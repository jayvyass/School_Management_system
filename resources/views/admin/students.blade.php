@extends('admin.admin')
@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Students</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Students</h6>
        </nav>
        
@section('main')
<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primStudentsr-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Students table</h6>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0 ">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <button class="btn-success" id="addCourseBtn" style="height: 35px;margin-left:17px;">ADD</button>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <select id="genderFilter" class="form-select" style="height: 40px; width: 147px;">
                                            <option selected disabled value="">Filter Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Reset">Reset Filter</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 text-end">
                        <input type="text" id="searchInput" class="form-control" style="height: 40px;width:290px;" placeholder="Search...">
                    </div>
                </div>
                <table class="display" style="width:100%" id="students">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Student</th>
                            <th class="align-middle text-center">Avatar</th>
                            <th class="align-middle text-center">Email</th>
                            <th class="align-middle text-center">Standard</th>
                            <th class="align-middle text-center">Gender</th>
                            <th class="align-middle text-center">Contact</th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <!-- <img src="{{ isset($student->photo) ? asset($student->photo) : '' }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1"> -->
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ isset($student->name) ? $student->name : '' }}</h6>
                                        <!-- <p class="text-xs text-secondary mb-0">{{ isset($student->email) ? $student->email : '' }}</p> -->
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="image-box">
                                    <img src="{{ asset('admin/'.$student->photo) }}" alt="Student Image" class="thumbnail" style="height:50px;width:50px;">
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                {{ isset($student->email) ? $student->email : '' }}
                            </td>
                            <td>
                                <span class="">{{ isset($student->grade) ? $student->grade : '' }}</span>
                                <!-- <p class="text-xs text-secondary mb-0">{{ isset($student->gender) ? $student->gender : '' }}</p> -->
                            </td>
                            <td>{{ isset($student->gender) ? $student->gender : '' }}</td>

                            <td class="align-middle text-center">
                                <span class=" ">{{ isset($student->contact_no) ? $student->contact_no : '' }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge badge-sm bg-gradient-success">{{ isset($student->status) ? $student->status : '' }}</span>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('students.edit', ['id' => isset($student->stud_id) ? $student->stud_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    <i class="material-icons opacity-10">edit</i> <!-- Edit icon -->
                                </a>
                                <a href="{{ route('students.view', ['id' => isset($student->stud_id) ? $student->stud_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                    <i class="material-icons opacity-10">visibility</i> <!-- View icon -->
                                </a>
                                <a id="deletelink" href="{{ route('students.delete', ['id' => isset($student->stud_id) ? $student->stud_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                    <i class="material-icons opacity-10">delete</i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="staticBackdropLabel">Logging Out</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Are you sure you want to Delete The Data ?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="confirmdelete" type="button" class="btn btn-primary">delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#addCourseBtn').click(function() {
            window.location.href = '{{ route("students.form") }}';
        });

        // Function to perform search
        function performSearch(query, gender) {
            var csrfToken = '{{ csrf_token() }}';
            $.ajax({
                url: '{{ route("students.search") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    query: query,
                    gender: gender
                },
                success: function(response) {
                    var studentData = response.studentdata;
                    var tbody = $('#students tbody');
                    tbody.empty();

                    $.each(studentData, function(index, student) {
                        var editUrl = '{{ route('students.edit', ['id' => ':id']) }}';
                        editUrl = editUrl.replace(':id', student.stud_id);
                        var viewUrl = '{{ route('students.view', ['id' => ':id']) }}';
                        viewUrl = viewUrl.replace(':id', student.stud_id);
                        var deleteUrl = '{{ route('students.delete', ['id' => ':id']) }}';
                        deleteUrl = deleteUrl.replace(':id', student.stud_id);

                        var row = '<tr>' +
                            '<td class="align-middle text-center">' + student.name + '</td>' +
                            '<td class="align-middle text-center"><img src="' + student.photo + '" alt="Avatar" class="thumbnail" style="height:50px;width:50px;"></td>' +
                            '<td class="align-middle text-center">' + student.email + '</td>' +
                            '<td class="align-middle text-center">' + student.grade + '</td>' +
                            '<td class="align-middle text-center">' + student.gender + '</td>' +
                            '<td class="align-middle text-center">' + student.contact_no + '</td>' +
                            '<td class="align-middle text-center"><span class="badge badge-sm bg-gradient-success">' + student.status + '</span></td>' +
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
                },
            });
        }

        // Listen for changes in the search input field
        $(document).ready(function() {
            var table = $('#students').DataTable({
                columns: [
                    { data: 'name', searchable: true },
                    { data: 'avatar', searchable: false },
                    { data: 'email', searchable: true },
                    { data: 'standard', searchable: false },
                    { data: 'gender', searchable: true },
                    { data: 'contact', searchable: true },
                    { data: 'status', searchable: false },
                    { data: 'action', searchable: false }
                ],

                dom: '<"row"<"col-md-6"B>>' +
                    'rt' +
                    '<"row"<"col-md-6"i><"col-md-6 text-end"p>>',

                "oLanguage": {
                    "sSearch": ""
                }
            });
            $('#searchInput').on('keyup', function() {
                var query = $(this).val();
                var gender = $('#genderFilter').val();
                performSearch(query, gender);
            });

            $('#genderFilter').on('change', function() {
                var gender = $(this).val();
                var query = $('#searchInput').val();
                performSearch(query, gender);
            });
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
@endsection
