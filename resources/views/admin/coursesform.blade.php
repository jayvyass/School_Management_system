@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3"> 
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Courses</a></li>
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
                    <form action='{{ isset($courses) ? route('courses.update', ['id' => $courses->course_id]) : route('courses.store') }}' id="courseForm" method="POST" class='form' enctype="multipart/form-data">
                        <!-- Form content goes here -->
                        @csrf
                        <input type="hidden" id="editMode" value="{{ isset($courses) ? 'true' : 'false' }}">

                        <p class='field required'><br>
                            <label class='label required' for='course_name'>Subject</label>
                            <input class='text-input' id='course_name' name='course_name' required type='text'value="{{ $courses->course_name ?? '' }}">
                            <span class="error-message"></span>
                        </p> 
                        <p class='field required'>
                            <label class='label required' for='teachers_id'>Teacher</label>
                            <select class='select' id='teachers_id' name='teachers_id' required>
                                <option value='' disabled selected>Select Teacher</option>
                                @foreach($teachers as $teacher)
                                <option value="{{ $teacher->teachers_id }}"{{ isset($courses->teachers_id) && $courses->teachers_id == $teacher->teachers_id ? ' selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                                @endforeach
                            </select>
                        </p> 
                        <p class='field required'>
                            <label class='label required' for='semester'>Semester</label>
                            <select class='select' id='semester' name='semester' required>
                                <option value='' selected disabled>Select Semester</option>
                                <option value='fall'{{ isset($courses->semester) && $courses->semester == 'fall' ? 'selected' : '' }}>Fall</option>
                                <option value='spring'{{ isset($courses->semester) && $courses->semester == 'spring' ? 'selected' : '' }}>Spring</option>
                                <option value='summer'{{ isset($courses->semester) && $courses->semester == 'summer' ? 'selected' : '' }}>Summer</option>
                            </select>
                        </p>
                        <p class='field required'>
                            <label class='label required' for='credits'>Credits</label>
                            <input class='text-input' id='credits' name='credits' required type='number' value="{{ $courses->credits ?? '' }}">
                            <span class="error-message"></span>
                        </p>
                        <p class='field required'>
                            <label class='label required' for='status'>Status</label>
                            <div class="toggle-switch">
                                <input type="checkbox" name="status" id="status" class="toggle-switch-checkbox" onchange="updateStatusLabel()"{{ isset($courses->status) && strpos($courses->status, 'Active') !== false ? 'checked'  : '' }}>
                                <label for="status" class="toggle-switch-label"></label>
                                <br><label id="statusLabel" for="status"></label>
                                <!-- Hidden input to store the value -->
                                <input type="hidden" name="status_hidden" id="status_hidden" value="">
                            </div>
                        </p><br>

                        <style>
                            .error-message {
                                color: red;
                            }
                            .toggle-switch {
                                position: relative;
                                display: inline-block;
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
                                background:#e91e63;
                            }

                            .toggle-switch-label:after {
                                content: '';
                                position: absolute;
                                width: 26px;
                                height: 26px;
                                border-radius: 50%;
                                background: white;
                                top: 50%;
                                transform: translate(-50%, -50%);
                                left: 4px;
                                transition: left 0.3s;
                            }

                            .toggle-switch-checkbox:checked + .toggle-switch-label:after {
                                left: calc(100% - 4px);
                                transform: translate(-50%, -50%);
                            }
                        </style>
                        <p class='field'>
                            @if($viewMode)
                            <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('courses') }}'">
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
</div>
</div>
<script>
document.getElementById('courseForm').addEventListener('submit', function(event) {
    var editMode = document.getElementById('editMode').value;
    var errorMessage = ''; // Initialize error message variable

    // Validate course name
    var courseNameInput = document.getElementById('course_name');
    var courseName = courseNameInput.value.trim();
    var alphabeticRegex = /^[a-zA-Z\s]+$/;

    if (courseName === '') {
        errorMessage += '<p class="text-danger">Please enter a course name.</p>';
        courseNameInput.nextElementSibling.innerHTML = 'Please enter a course name.';
    } else if (!alphabeticRegex.test(courseName)) {
        errorMessage += '<p class="text-danger">Course name should only contain alphabetic characters.</p>';
        courseNameInput.nextElementSibling.innerHTML = 'Course name should only contain alphabetic characters.';
    } else {
        courseNameInput.nextElementSibling.innerHTML = '';
    }

    // Validate semester
    var semesterInput = document.getElementById('semester');
    if (semesterInput.value.trim() === '') {
        errorMessage += '<p class="text-danger">Please select a semester.</p>';
        semesterInput.nextElementSibling.innerHTML = 'Please select a semester.';
    } else {
        semesterInput.nextElementSibling.innerHTML = '';
    }

    // Validate credits
    var creditsInput = document.getElementById('credits');
    if (isNaN(creditsInput.value.trim()) || creditsInput.value.trim() === '') {
        errorMessage += '<p class="text-danger">Please enter a valid number for credits.</p>';
        creditsInput.nextElementSibling.innerHTML = 'Please enter a valid number for credits.';
    } else {
        creditsInput.nextElementSibling.innerHTML = '';
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
</script>
@endsection
