@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Classes</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Form</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Form</h6>
        </nav>
    </div>
</nav>
@endpush

@section('main')
<link id="pagestyle" href="{{ asset('/css/studentform.css') }}" rel="stylesheet" />
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
                    <form action="{{ isset($classes) ? route('classes.update', ['id' => $classes->classes_id]) : route('classes.store') }}" method="POST" id="classForm" class="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editMode" value="{{ isset($classes) ? 'true' : 'false' }}">
                    
                        <p class="field">
                            <label class="label" for="subject_photo">Subject Photo</label>
                            <input type="file" name="subject_photo" accept="image/*" onchange="previewSubjectPhoto(this)">
                            <br>
                            @if(isset($classes) && $classes->subject_photo)
                                <img src="{{ asset('admin/'.$classes->subject_photo) }}" alt="Uploaded Image" style="max-width: 100px;">
                            @else
                                <img id="subject_photo_preview" src="#" alt="Preview Image" style="display: none; max-width: 100px;">
                            @endif
                        </p>  
                        <p class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{ isset($classes->subject) ? $classes->subject : '' }}">
                            <span class="error-message"></span>
                        </p>
                        <p class="field required">
                            <label class="label required" for="teachers_id">Teacher</label>
                            <select class="select" id="teachers_id" name="teachers_id" required>
                                <option value="" disabled selected>Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->teachers_id }}" {{ isset($classes->teachers_id) && $classes->teachers_id == $teacher->teachers_id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </p>    
                        <p class="mb-3">
                            <label for="age_group" class="form-label">Age Group</label>
                            <select class="form-control" id="age_group" name="age_group">
                                <option value="" disabled>Select Age Group</option>
                                <option value="child"{{ isset($classes->age_group) && $classes->age_group === 'child' ? 'selected' : '' }}>Child</option>
                                <option value="teenager"{{ isset($classes->age_group) && $classes->age_group === 'teenager' ? 'selected' : '' }}>Teenager</option>
                                <option value="adult"{{ isset($classes->age_group) && $classes->age_group === 'adult' ? 'selected' : '' }}>Adult</option>
                            </select>
                            <span class="error-message"></span>
                        </p>

                        <p class="mb-3">
                            <label for="time_duration" class="form-label">Time Duration</label>
                            <select class="form-control" id="time_duration" name="time_duration">
                                <option value="" disabled>Select Time Duration</option>
                                <option value="1_hour"{{ isset($classes->time_duration) && $classes->time_duration === '1_hour' ? 'selected' : '' }}>1 Hour</option>
                                <option value="2_hours"{{ isset($classes->time_duration) && $classes->time_duration === '2_hours' ? 'selected' : '' }}>2 Hours</option>
                                <option value="3_hours"{{ isset($classes->time_duration) && $classes->time_duration === '3_hours' ? 'selected' : '' }}>3 Hours</option>
                            </select>
                            <span class="error-message"></span>
                        </p>

                        <p class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="text" class="form-control" id="capacity" name="capacity" value="{{ isset($classes->capacity) ? $classes->capacity : '' }}">
                            <span class="error-message"></span>   
                        </p>
                        <p class="field required">
                            <label class="label required" for="status">Status</label>
                            <div class="toggle-switch">
                                <input type="checkbox" name="status" id="status" class="toggle-switch-checkbox" onchange="updateStatusLabel()" {{ isset($classes->status) && strpos($classes->status, 'Active') !== false ? 'checked'  : '' }}>
                                <label for="status" class="toggle-switch-label"></label>
                                <br><label id="statusLabel" for="status"></label>
                                <!-- Hidden input to store the value -->
                                <input type="hidden" name="status_hidden" id="status_hidden" value="">
                            </div>
                        </p><br>

                        <p class="field">
                            @if($viewMode)
                                <input class="button" type="button" value="{{$submit}}" onclick="window.location.href='{{ route('class') }}'">
                            @else
                                <input class="button" type="submit" value="{{$submit}}">
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
    document.getElementById('classForm').addEventListener('submit', function(event) {
        var editMode = document.getElementById('editMode').value;
        var errorMessage = ''; // Initialize error message variable

        // Check if the image input is empty
        var subjectPhotoUpload = document.querySelector('input[name="subject_photo"]');
        if (editMode === 'false' && subjectPhotoUpload.files.length === 0) {
            errorMessage += '<p class="text-danger">Please select a subject photo.</p>';
        }

        // Validate subject name
        var subjectInput = document.getElementById('subject');
        var subjectValue = subjectInput.value.trim();
        if (subjectValue === '') {
            errorMessage += '<p class="text-danger">Please enter a subject.</p>';
        } else if (!/^[A-Za-z\s]+$/.test(subjectValue)) {
            errorMessage += '<p class="text-danger">Subject name should not contain numbers.</p>';
        }

        // Validate capacity
        var capacityInput = document.getElementById('capacity');
        if (capacityInput.value.trim() === '') {
            errorMessage += '<p class="text-danger">Please enter a capacity.</p>';
        } else if (isNaN(capacityInput.value)) {
            errorMessage += '<p class="text-danger">Capacity should be a number.</p>';
        }

        // Display error messages if any
        if (errorMessage !== '') {
            event.preventDefault(); // Prevent form submission
            document.getElementById('errorMessages').innerHTML = errorMessage;
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateStatusLabel();
    });

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
    document.getElementById('status').addEventListener('change', updateStatusLabel);

    function previewSubjectPhoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('subject_photo_preview').src = e.target.result;
                document.getElementById('subject_photo_preview').style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Call updateStatusLabel() when the DOM is fully loaded
</script>
@endsection
