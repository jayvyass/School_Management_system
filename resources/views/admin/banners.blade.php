@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Banners</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Banners</h6>
        </nav>

@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Banners table</h6>
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
                        <table class="display" id="banners">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Image</th>
                                    <th class="align-middle text-center">Imagetext</th>
                                    <th class="align-middle text-center">Description</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                <tr>
                                    <td>
                                        <div class="image-box">
                                            <img src="{{ asset('admin/'.$banner->image) }}" alt="banner Image" class="thumbnail" style="height:50px;width:50px;">
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{ isset($banner->text) ? $banner->text : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ isset($banner->description) ? $banner->description : '' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-success">{{ isset($banner->status) ? $banner->status : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('banners.edit', ['id' => isset($banner->banners_id) ? $banner->banners_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">edit</i>
                                        </a>
                                        <a href="{{ route('banners.view', ['id' => isset($banner->banners_id) ? $banner->banners_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">visibility</i>
                                        </a>
                                        <a href="{{ route('banners.delete', ['id' => isset($banner->banners_id) ? $banner->banners_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
            window.location.href = '{{ route("banners.form") }}';
        });

        // Function to perform search
        function performSearch(query) {
            var csrfToken = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("banners.search") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    query: query
                },
                success: function(response) {
                    var bannerData = response.bannerdata;
                    var tbody = $('#banners tbody');
                    tbody.empty();

                    $.each(bannerData, function(index, banner) {

                        var editUrl = '{{ route('facilities.edit', ['id' => ':id']) }}';
                        editUrl = editUrl.replace(':id', banner.banners_id);
                        var viewUrl = '{{ route('facilities.view', ['id' => ':id']) }}';
                        viewUrl = viewUrl.replace(':id', banner.banners_id);
                        var deleteUrl = '{{ route('facilities.delete', ['id' => ':id']) }}';
                        deleteUrl = deleteUrl.replace(':id', banner.banners_id);


                        var row = '<tr>' +
                            '<td class="align-middle text-center"><img src="' + banner.image + '" alt="Avatar" class="thumbnail" style="height:50px;width:50px;"></td>' +
                            '<td class="align-middle text-center">' + banner.text + '</td>' +
                            '<td class="align-middle text-center">' + banner.description + '</td>' +
                            '<td class="align-middle text-center"><span class="badge badge-sm bg-gradient-success">' + banner.status + '</span></td>' +
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

        var table = $('#banners').DataTable({
            columns: [
                { data: 'image', searchable: true },
                { data: 'text', searchable: false },
                { data: 'description', searchable: true },
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
