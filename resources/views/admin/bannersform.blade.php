@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3"> 
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Banners</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Form</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Form</h6>
        </nav>
    </div>
</nav>
@endpush

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
                    <form action="{{ isset($banners) ? route('banners.update', ['id' => $banners->banners_id]) : route('banners.store') }}" method="POST" id="bannerForm" class="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editMode" value="{{ isset($banners) ? 'true' : 'false' }}">
                        <p class='field'>
                            <label class='label' for='image_upload'>Image Upload</label>
                            <input type="file" name="image" accept="image/*" onchange="previewImage(this)">
                            <br>
                            @if(isset($banners) && $banners->image)
                            <img src="{{ asset('admin/'.$banners->image) }}" alt="Uploaded Image" style="max-width: 100px;">
                            @else
                            <img id="image_preview" src="#" alt="Preview Image" style="display: none; max-width: 100px;">
                            @endif
                        </p>
                        <p class="mb-3">
                            <label for="facility" class="form-label">Imagetext</label>
                            <input type="text" class="form-control" id="imagetext" name="imagetext" value="{{ isset($banners->text) ? $banners->text : '' }}">
                            <span class="error-message"></span>
                        </p>
                        <p class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ isset($banners->description) ? $banners->description : '' }}</textarea>
                            <span class="error-message"></span>
                        </p>
                        <p class='field required'>
                            <label class='label required' for='status'>Status</label>
                            <div class="toggle-switch">
                                <input type="checkbox" name="status" id="status" class="toggle-switch-checkbox" onchange="updateStatusLabel()"{{ isset($banners->status) && strpos($banners->status, 'Active') !== false ? 'checked'  : '' }}>
                                <label for="status" class="toggle-switch-label"></label>
                                <br><label id="statusLabel" for="status"></label>
                                <!-- Hidden input to store the value -->
                                <input type="hidden" name="status_hidden" id="status_hidden" value="">
                            </div>
                        </p><br>
                        <p class='field'>
                            @if($viewMode)
                            <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('banners') }}'">
                            @else
                            <input class='button' type='submit' value="{{$submit}}">
                            @endif
                        </p>
                        <div id="errorMessages"></div>
                        @if ($errors->any())
                        <div class="alert alert-danger" style="color: black;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .toggle-switch {
        display: inline-block;
        position: relative;
        width: 60px;
        height: 34px;
    }

    .toggle-switch-checkbox {
        display: none;
    }

    .toggle-switch-label {
        display: block;
        width: 100%;
        height: 100%;
        cursor: pointer;
        background: #ccc;
        position: absolute;
        border-radius: 34px;
        transition: background-color 0.3s;
    }

    .toggle-switch-checkbox:checked + .toggle-switch-label {
        background: #e91e63;
    }

    .toggle-switch-label:after {
        content: '';
        position: absolute;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: white;
        top: 4px;
        left: 4px;
        transition: left 0.3s;
    }

    .toggle-switch-checkbox:checked + .toggle-switch-label:after {
        left: calc(100% - 26px);
    }
</style>
<script>
    document.getElementById('bannerForm').addEventListener('submit', function(event) {
        var editMode = document.getElementById('editMode').value;
        var errorMessage = ''; // Initialize error message variable

        var imagetextInput = document.getElementById('imagetext');
        var imagetextValue = imagetextInput.value.trim();
        if (imagetextValue === '') {
            errorMessage += '<p class="text-danger">Please enter an imagetext.</p>';
        } else if (!/^[A-Za-z\s]+$/.test(imagetextValue)) {
            errorMessage += '<p class="text-danger">Imagetext should not contain numbers.</p>';
        }

        // Validate description
        var descriptionInput = document.getElementById('description');
        var descriptionValue = descriptionInput.value.trim();
        if (descriptionValue === '') {
            errorMessage += '<p class="text-danger">Please enter a description.</p>';
        }
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