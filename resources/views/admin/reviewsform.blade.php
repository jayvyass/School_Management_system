@extends('admin.admin')
@push('nav')
 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3"> 
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Reviews</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Form</li>
        </ol>
         <h6 class="font-weight-bolder mb-0">Form</h6>
      </nav>
@section('main')
<link id="pagestyle" href="{{asset('/css/studentform.css')}}" rel="stylesheet" />
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">{{ $mode }}</h6>
            </div>
          </div>
  <div class="card-body px-0 pb-2">
          <form id="reviewForm" action="{{ isset($reviews) ? route('reviews.update', ['id' => $reviews->reviews_id]) : route('reviews.store') }}" method="POST" class="form" enctype="multipart/form-data">
          @csrf
        
          <input type="hidden" id="editMode" value="{{ isset($reviews) ? 'true' : 'false' }}">
        <p class='field'>
        <label class='label' for='image_upload'>Image Upload</label>
        <input type="file" name="image" accept="image/*" onchange="previewImage(this)">
        <br>
        @if(isset($reviews) && $reviews->image)
            <img src="{{ asset('admin/'.$reviews->image) }}" alt="Uploaded Image" style="max-width: 100px;">
        @else
            <img id="image_preview" src="#" alt="Preview Image" style="display: none; max-width: 100px;">
        @endif
    </p>
   
   
    <p class="mb-3">
        <label for="facility" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ isset($reviews->name) ? $reviews->name : '' }}">
    </p>
    <p class="mb-3">
        <label for="facility" class="form-label">Profession</label>
        <input type="text" class="form-control" id="profession" name="profession" value="{{ isset($reviews->profession) ? $reviews->profession : '' }}">
    </p>
    <p class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ isset($reviews->description) ? $reviews->description : '' }}</textarea>
    </p>
    <p class='field'>
        @if($viewMode)
            <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('reviews') }}'">
        @else
            <input class='button' type='submit' value="{{$submit}}">
        @endif
    </p>
    @if ($errors->any())
        <div class="alert alert-danger" style="color: black;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="errorMessages"></div>

</form>
</div>
</div>
</div>
</div>
<script>

document.getElementById('reviewForm').addEventListener('submit', function(event) {
        var editMode = document.getElementById('editMode').value;
        var errorMessage = ''; // Initialize error message variable

        // Check if the image input is empty
        var imageUpload = document.querySelector('input[name="image"]');
        if (editMode === 'false' && imageUpload.files.length === 0) {
            errorMessage += '<p class="text-danger">Please select an image file.</p>';
        }

        // Display error messages if any
        if (errorMessage !== '') {
            event.preventDefault(); // Prevent form submission
            document.getElementById('errorMessages').innerHTML = errorMessage;
        }
    });


    document.getElementById('status').addEventListener('change', updateStatusLabel);

function updateStatusLabel() {
    var statusCheckbox = document.getElementById('status');
    var statusLabel = document.getElementById('statusLabel');
    var hiddenInput = document.getElementById('status_hidden');

    if (statusCheckbox.checked) {
        statusLabel.textContent = "Active";
        hiddenInput.value = "Active"; // Set hidden input value to "Active"
    } else {
        statusLabel.textContent = "Away";
        hiddenInput.value = "Away"; // Set hidden input value to "Away"
    }
}
updateStatusLabel();

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
