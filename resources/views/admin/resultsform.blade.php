
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
                    <form action="{{ isset($results) ? route('results.update', ['id' => $results->results_id]) : route('results.store') }}" method="POST" class="form" enctype="multipart/form-data" id="resultForm">
                        @csrf
                        <p class="field required">
                            <label class="label required" for="stud_id">Student</label>
                            <select class="select" id="stud_id" name="stud_id" required>
                                <option value="" disabled selected>Select Student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->stud_id }}"{{ isset($results) && $results->students->stud_id == $student->stud_id ? ' selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select> 
                        </p>
                        <p class="field required">
                            <label class="label required" for="teachers_id">Teacher</label>
                            <select class="select" id="teachers_id" name="teachers_id" required>
                                <option value="" disabled selected>Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->teachers_id }}"{{ isset($results) && $results->teachers->teachers_id == $teacher->teachers_id ? ' selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </p>
                        <p class="field">
                            <label class="label" for="subjects">Subject Marks</label>
                            <div id="marks-container" style="display: none;">
                                <p class="field">
                                    <label class="label" for="marks"></label>
                                    <div class="marks">
                                        <!-- Marks fields for the selected student will be inserted here -->
                                    </div>
                                </p>
                            </div>
                        </p>
                        <br>
                        <p class="field required">
                            <label class="label required" for="exam_date">Exam Date</label>
                            <input class="text-input" id="exam_date" name="exam_date" required type="date" value="{{ $results->exam_date ?? '' }}">
                        </p>
                        <p class="field required">
                            <label class="label required" for="status">Status</label>
                            <div class="toggle-switch">
                                <input type="checkbox" name="status" id="status" class="toggle-switch-checkbox" onchange="updateStatusLabel()"{{ isset($results->status) && strpos($results->status, 'Active') !== false ? ' checked'  : '' }}>
                                <label for="status" class="toggle-switch-label"></label>
                                <br>
                                <label id="statusLabel" for="status"></label>
                                <!-- Hidden input to store the value -->
                                <input type="hidden" name="status_hidden" id="status_hidden" value="">
                            </div>
                        </p>
                        <br>
                        <p class="field">
                            @if($viewMode)
                                <input class="button" type="button" value="{{ $submit }}" onclick="window.location.href='{{ route('results') }}'">
                            @else
                                <input class="button" type="submit" value="{{ $submit }}">
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

<style>
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

.subject-mark-row {
    display: inline-block;
    margin-right: 10px; /* Adjust spacing between marks fields */
}
</style>

<script> 
document.getElementById('stud_id').addEventListener('change', function() {
    var selectedStudentId = this.value;
    var selectedStudent = {!! json_encode($students->keyBy('stud_id')->toArray()) !!}[selectedStudentId];
    var marksData = {!! json_encode($results->marks ?? '') !!}; // Retrieve marks data from server
    var marksContainer = document.getElementById('marks-container');
    marksContainer.innerHTML = ''; // Clear previous marks fields

    if (selectedStudent && selectedStudent.subjects) {
        var subjects = selectedStudent.subjects.split(',');
        var marks = marksData.split(',');
        subjects.forEach(function(subject, index) {
            var div = document.createElement('div');
            div.classList.add('subject-mark-row');
            var subjectMarks = marks[index] ? marks[index].trim() : ''; // Check if marks data exists for the subject
            div.innerHTML = `
                <label for="${subject.trim()}">${subject.trim()}</label>
                <input class="text-input" id="${subject.trim()}" name="marks[${subject.trim()}]" type="text" value="${subjectMarks}">
            `;
            marksContainer.appendChild(div);
        });

        marksContainer.style.display = 'block'; // Show marks container
    } else {
        marksContainer.style.display = 'none'; // Hide marks container if no subjects found
    }
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('resultForm').addEventListener('submit', function(event) {
        var editMode = document.getElementById('editMode').value;
        var errorMessage = ''; // Initialize error message variable

        // Validate student
        var studentInput = document.getElementById('stud_id');
        if (studentInput.value === '') {
            errorMessage += '<p class="text-danger">Please select a student.</p>';
            studentInput.nextElementSibling.innerHTML = 'Please select a student.';
        } else {
            studentInput.nextElementSibling.innerHTML = '';
        }

        // Validate teacher
        var teacherInput = document.getElementById('teachers_id');
        if (teacherInput.value === '') {
            errorMessage += '<p class="text-danger">Please select a teacher.</p>';
            teacherInput.nextElementSibling.innerHTML = 'Please select a teacher.';
        } else {
            teacherInput.nextElementSibling.innerHTML = '';
        }

        // Validate marks
        var marksInput = document.getElementById('marks');
        if (marksInput.value.trim() === '') {
            errorMessage += '<p class="text-danger">Please enter marks.</p>';
            marksInput.nextElementSibling.innerHTML = 'Please enter marks.';
        } else if (isNaN(parseFloat(marksInput.value))) {
            errorMessage += '<p class="text-danger">Marks must be a number.</p>';
            marksInput.nextElementSibling.innerHTML = 'Marks must be a number.';
        } else {
            marksInput.nextElementSibling.innerHTML = '';
        }

        // Validate standard
        var standardInput = document.getElementById('standard');
        if (standardInput.value.trim() === '') {
            errorMessage += '<p class="text-danger">Please enter standard.</p>';
            standardInput.nextElementSibling.innerHTML = 'Please enter standard.';
        } else if (isNaN(parseInt(standardInput.value))) {
            errorMessage += '<p class="text-danger">Standard must be a number.</p>';
            standardInput.nextElementSibling.innerHTML = 'Standard must be a number.';
        } else {
            standardInput.nextElementSibling.innerHTML = '';
        }

        // Validate exam date
        var examDateInput = document.getElementById('exam_date');
        if (examDateInput.value.trim() === '') {
            errorMessage += '<p class="text-danger">Please select an exam date.</p>';
            examDateInput.nextElementSibling.innerHTML = 'Please select an exam date.';
        } else {
            examDateInput.nextElementSibling.innerHTML = '';
        }

        // Display error messages if any
        if (errorMessage !== '') {
            event.preventDefault(); // Prevent form submission
            document.getElementById('errorMessages').innerHTML = errorMessage;
        }
    });
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