@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-12 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Reviews</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Reviews</h6>
        </nav>

@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Reviews table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="row align-items-center">
                                </div>
                            </div>
                            <div class="col-md-1 text-end">
                                <input type="text" id="searchInput" class="form-control" style="height: 40px;width:290px;" placeholder="Search...">
                            </div>
                        </div>
                        <table class="display" id="reviews">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Image</th>
                                    <th class="align-middle text-center">Name</th>
                                    <th class="align-middle text-center">profession</th>
                                    <th class="align-middle text-center">Description</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                <tr>
                                    <td>
                                        <div class="image-box">
                                            <img src="{{ asset('admin/'.$review->image) }}" alt="banner Image" class="thumbnail" style="height:50px;width:50px;">
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{ isset($review->name) ? $review->name : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="">{{ isset($review->profession) ? $review->profession : '' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ isset($review->description) ? $review->description : '' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('reviews.edit', ['id' => isset($review->reviews_id) ? $review->reviews_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">edit</i> <!-- Edit icon -->
                                        </a>
                                        <a href="{{ route('reviews.view', ['id' => isset($review->reviews_id) ? $review->reviews_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">visibility</i> <!-- Edit icon -->
                                        </a>
                                        <a href="{{ route('reviews.delete', ['id' => isset($review->reviews_id) ? $review->reviews_id : '' ]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="material-icons opacity-10">delete</i> <!-- Edit icon -->
                                        </a>
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
      

        // Function to perform search
        function performSearch(query) {
            var csrfToken = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("reviews.search") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    query: query
                },
                success: function(response) {
                    var reviewData = response.reviewdata;
                    var tbody = $('#reviews tbody');
                    tbody.empty();

                    $.each(reviewData, function(index, review) {
                        var editUrl = '{{ route('reviews.edit', ['id' => ':id']) }}';
                        editUrl = editUrl.replace(':id', review.reviews_id);
                        var viewUrl = '{{ route('reviews.view', ['id' => ':id']) }}';
                        viewUrl = viewUrl.replace(':id', review.reviews_id);
                        var deleteUrl = '{{ route('reviews.delete', ['id' => ':id']) }}';
                        deleteUrl = deleteUrl.replace(':id', review.reviews_id);

                        var row = '<tr>' +
                            '<td class="align-middle text-center"><img src="' + review.image + '" alt="Avatar" class="thumbnail" style="height:50px;width:50px;"></td>' +
                            '<td class="align-middle text-center">' + review.name + '</td>' +
                            '<td class="align-middle text-center">' + review.profession + '</td>' +
                            '<td class="align-middle text-center">' + review.description + '</td>' +
                            '<td class="align-middle text-center"><span class="badge badge-sm bg-gradient-success">' + review.status + '</span></td>' +
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

        var table = $('#reviews').DataTable({
            columns: [
                { data: 'image', searchable: true },
                { data: 'name', searchable: false },
                { data: 'profession', searchable: false },
                { data: 'description', searchable: true },
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
    background-color:  #4CAF50 !important;
    border-color:   #4CAF50 !important;
    color: white !important;
    border-radius: 5px !important;
}
</style>
@endsection
