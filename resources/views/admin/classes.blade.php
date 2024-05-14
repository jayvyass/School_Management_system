@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Class</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Class</h6>
        </nav>
   

@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Class table</h6>
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
                        <table class="display" id="classes">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Subject</th>
                                    <th class="align-middle text-center">Photo</th>
                                    <th class="align-middle text-center">Teacher</th>
                                    <th class="align-middle text-center">Teacher_photo</th>
                                    <th class="align-middle text-center">Time</th>
                                    <th class="align-middle text-center">Capacity</th>
                                    <th class="align-middle text-center">Age-group</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $class)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{ isset($class->subject) ? $class->subject : '' }}
                                    </td>
                                    <td>
                                        <div class="image-box">
                                            <img src="{{ asset('admin/'.$class->subject_photo) }}" alt="Banner Image" class="thumbnail" style="height:50px;width:50px;">
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($class->teacher)
                                        <span class="">{{ $class->teacher->name }}</span>
                                        @else
                                        <span class="">No Teacher Assigned</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($class->teacher)
                                        <img src="{{$class->teacher->photo}}" alt="Student Photo" class="thumbnail" style="height:50px;width:50px;">
                                        @else
                                        <span class="">No Avatar Found</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ isset($class->time_duration) ? $class->time_duration : '' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ isset($class->capacity) ? $class->capacity : '' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ isset($class->age_group) ? $class->age_group : '' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-success">{{ isset($class->status) ? $class->status : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('classes.edit', ['id' => isset($class->classes_id) ? $class->classes_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">edit</i> <!-- Edit icon -->
                                        </a>
                                        <a href="{{ route('classes.view', ['id' => isset($class->classes_id) ? $class->classes_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                            <i class="material-icons opacity-10">visibility</i> <!-- View icon -->
                                        </a>
                                        <a href="{{ route('classes.delete', ['id' => isset($class->classes_id) ? $class->classes_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">
                                            <i class="material-icons opacity-10">delete</i> <!-- Delete icon -->
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
        $('#addCourseBtn').click(function() {
            window.location.href = '{{ route("classes.form") }}';
        });

        // Function to perform search
        function performSearch(query) {
            var csrfToken = '{{ csrf_token() }}';
            $.ajax({
                url: '{{ route("classes.search") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    query: query
                },
                success: function(response) {
                    var classData = response.classData;
                    var tbody = $('#classes tbody');
                    tbody.empty();
                    $.each(classData, function(index, classes) {
                        var editUrl = '{{ route('classes.edit', ['id' => ':id']) }}';
                        editUrl = editUrl.replace(':id', classes.classes_id);
                        var viewUrl = '{{ route('classes.view', ['id' => ':id']) }}';
                        viewUrl = viewUrl.replace(':id', classes.classes_id);
                        var deleteUrl = '{{ route('classes.delete', ['id' => ':id']) }}';
                        deleteUrl = deleteUrl.replace(':id', classes.classes_id);
                        var row = '<tr>' +
                            '<td class="align-middle text-center"><img src="' + classes.subject_photo + '" alt="Avatar" class="thumbnail" style="height:50px;width:50px;"></td>' +
                            '<td class="align-middle text-center">' + classes.subject + '</td>' +
                            '<td class="align-middle text-center">' + classes.teacher + '</td>' +
                            '<td class="align-middle text-center">' + classes.teacher_photo + '</td>' +
                            '<td class="align-middle text-center">' + classes.time + '</td>' +
                            '<td class="align-middle text-center">' + classes.capacity + '</td>' +
                            '<td class="align-middle text-center">' + classes.age_group + '</td>' +
                            '<td class="align-middle text-center"><span class="badge badge-sm bg-gradient-success">' + classes.status + '</span></td>' +
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

        // Listen for changes in the search input field
        $('#searchInput').on('keyup', function() {
            var query = $(this).val();
            performSearch(query);
        });

        var table = $('#classes').DataTable({
            columns: [
                { data: 'photo', searchable: true },
                { data: 'subject', searchable: true },
                { data: 'teacher', searchable: true },
                { data: 'teacher_photo', searchable: false },
                { data: 'time', searchable: true },
                { data: 'capacity', searchable: true },
                { data: 'age_group', searchable: true },
                { data: 'status', searchable: true },
                { data: 'action', searchable: true },
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
