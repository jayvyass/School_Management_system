@extends('admin.admin')
@push('nav')
 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3"> 
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Students</a></li>
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
  <form action='{{ isset($students) ? route('students.update', ['id' => $students->stud_id]) : route('students.store') }}' method="POST" class='form' id="studentForm" enctype="multipart/form-data">
    <!-- Form content goes here -->
    @csrf
    <input type="hidden" id="editMode" value="{{ isset($students) ? 'true' : 'false' }}">
  <p class='field required'>
        <label class='label required' for='name'>Full Name</label>
        <input class='text-input' id='name' name='name' required type='text' value="{{ $students->name ?? '' }}" minlength="2" maxlength="50">
        <span class="error-message"></span>
    </p>
    <p class='field required'>
        <label class='label required' for='email'>Email</label>
        <input class='text-input' id='email' name='email' required type='email' value="{{$students->email ?? '' }}">
        <span class="error-message"></span>
    </p>
    <p class='field required'>
        <label class='label required' for='gender'>Gender</label>
        <select class='select' id='gender' name='gender' required>
            <option value='' selected disabled>Select Gender</option>
            <option value='male'{{ $students->gender ?? '' == 'male' ? 'selected' : '' }}>Male</option>
            <option value='female'{{ $students->gender ?? '' == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        <span class="error-message"></span>
    </p>
    <p class='field required'>
        <label class='label required' for='grade'>Standard</label>
        <input class='text-input' id='grade' name='grade' required type='text' value="{{$students->grade ?? '' }}">
        <span class="error-message"></span>
    </p>
    <p class='field required'>
        <label class='label required' for='guardian_name'>Guardian Name</label>
        <input class='text-input' id='guardian_name' name='guardian_name' required type='text' value="{{$students->guardian_name ?? ''}}">
        <span class="error-message"></span>
    </p>
    <p class='field required'>
        <label class='label required' for='contact'>Contact</label>
        <input class='text-input' id='contact' name='contact' required type='text' value="{{$students->contact_no ?? ''}}">
        <span class="error-message"></span>
    </p>
    <p class='field'>
        <label class='label' for='image_upload'>Image Upload</label>
        <input type="file" name="image" accept="image/*" onchange="previewImage(this)">
        <br>
        @if(isset($students) && $students->photo)
            <img src="{{ asset('admin/'.$students->photo) }}" alt="Uploaded Image" style="max-width: 100px;">
        @else
            <img id="image_preview" src="#" alt="Preview Image" style="display: none; max-width: 100px;">
        @endif
    </p>
    <p class='field required'>
        <label class='label required' for='document_upload'>Document Upload</label>
        <input class='file-input' id='document_upload' name='document_upload' type='file'>
        @if(isset($students) && $students->document)
            <span id="document_file_name">{{ $students->document }}</span>
        @endif
        <span class="error-message"></span>
    </p>
    <p class='field required'>
        <label class='label required' for='dob'>Date of Birth (DOB)</label>
        <input class='text-input' id='dob' name='dob' required type='date' value="{{$students->dob ?? ''}}">
        <span class="error-message"></span>
    </p>
    <p class='field required'>
        <label class='label required' for='status'>Status</label>
        <div class="toggle-switch">
            <input type="checkbox" name="status" id="status" class="toggle-switch-checkbox" onchange="updateStatusLabel()"{{ isset($students->status) && strpos($students->status, 'Active') !== false ? 'checked'  : '' }}>
            <label for="status" class="toggle-switch-label"></label>
            <br><label id="statusLabel" for="status"></label>
            <!-- Hidden input to store the value -->
            <input type="hidden" name="status_hidden" id="status_hidden" value="">
        </div>
        <span class="error-message"></span>
    </p>
    <br>
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
    <p class='field required'><br>
        <label class='label required'>Subjects</label>
        <ul class='checkboxes'>
    <li class='checkbox'>
        <input class='checkbox-input' id ='subject_math' name='subjects[]' type='checkbox' value='math'{{ isset($students->subjects) && strpos($students->subjects, 'math') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for ='subject_math'>Mathematics</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_Physics' name='subjects[]' type='checkbox' value='physics'{{ isset($students->subjects) && strpos($students->subjects, 'physics') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_Physics'>Physics</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_economics' name='subjects[]' type='checkbox' value='economics'{{ isset($students->subjects) && strpos($students->subjects, 'economics') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_economics'>Economics</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_biology' name='subjects[]' type='checkbox' value='biology'{{ isset($students->subjects) && strpos($students->subjects, 'biology') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_biology'>Biology</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_chemistry' name='subjects[]' type='checkbox' value='chemistry'{{ isset($students->subjects) && strpos($students->subjects, 'chemistry') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_chemistry'>Chemistry</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_english' name='subjects[]' type='checkbox' value='English'{{ isset($students->subjects) && strpos($students->subjects, 'English') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_english'>English</label>
    </li>
</ul>
    </p>
    <p class='field'>
        @if($viewMode)
            <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('students') }}'">
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

    document.getElementById('studentForm').addEventListener('submit', function(event) {
        var editMode = document.getElementById('editMode').value;
        var errorMessage = ''; // Initialize error message variable


        var nameInput = document.getElementById('name');
        if (nameInput.value.length < 2 || nameInput.value.length > 50) {
            errorMessage += '<p class="text-danger">Full Name must be between 2 and 50 characters.</p>';
            nameInput.nextElementSibling.innerHTML = 'Full Name must be between 2 and 50 characters.';
        } else {
            nameInput.nextElementSibling.innerHTML = '';
        }

        // Validate email
        var emailInput = document.getElementById('email');
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value)) {
            errorMessage += '<p class="text-danger">Please enter a valid email address.</p>';
            emailInput.nextElementSibling.innerHTML = 'Please enter a valid email address.';
        } else {
            emailInput.nextElementSibling.innerHTML = '';
        }

        // Validate gender
        var genderInput = document.getElementById('gender');
        if (genderInput.value === '') {
            errorMessage += '<p class="text-danger">Please select a gender.</p>';
            genderInput.nextElementSibling.innerHTML = 'Please select a gender.';
        } else {
            genderInput.nextElementSibling.innerHTML = '';
        }

        // Validate grade
        var gradeInput = document.getElementById('grade');
        if (gradeInput.value.trim() === '') {
            errorMessage += '<p class="text-danger">Please enter a grade.</p>';
            gradeInput.nextElementSibling.innerHTML = 'Please enter a grade.';
        } else if (isNaN(gradeInput.value.trim())) {
            errorMessage += '<p class="text-danger">Grade should be a number.</p>';
            gradeInput.nextElementSibling.innerHTML = 'Grade should be a number.';
        } else {
            gradeInput.nextElementSibling.innerHTML = '';
        }


        // Validate guardian name
        var guardianNameInput = document.getElementById('guardian_name');
        if (guardianNameInput.value.trim() === '') {
            errorMessage += '<p class="text-danger">Please enter the guardian name.</p>';
            guardianNameInput.nextElementSibling.innerHTML = 'Please enter the guardian name.';
        } else {
            guardianNameInput.nextElementSibling.innerHTML = '';
        }

        // Validate contact number
        var contactInput = document.getElementById('contact');
        var contactPattern = /^(\+?\d{1,3}[- ]?)?(\(\d{1,4}\)|\d{1,4})?[- ]?\d{1,4}[- ]?\d{1,4}$/; // Accepts various phone number formats
        if (!contactPattern.test(contactInput.value)) {
            errorMessage += '<p class="text-danger">Please enter a valid contact number.</p>';
            contactInput.nextElementSibling.innerHTML = 'Please enter a valid contact number.';
        } else {
            contactInput.nextElementSibling.innerHTML = '';
        }
        // Validate joining date
        var dobInput = document.getElementById('dob');
        var currentDate = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format
        if (dobInput.value > currentDate) {
            errorMessage += '<p class="text-danger">Date of birth cannot be in the future.</p>';
            dobInput.nextElementSibling.innerHTML = 'Date of birth cannot be in the future.';
        } else {
            dobInput.nextElementSibling.innerHTML = '';
        }
    
        var imageUpload = document.querySelector('input[name="image"]');
        if (editMode === 'false' && imageUpload.files.length === 0) {
            errorMessage += '<p class="text-danger">Please select an image file.</p>';
        }
        // Check if the document input is empty
        var documentUpload = document.getElementById('document_upload');
        if (editMode === 'false' && documentUpload.files.length === 0) {
            errorMessage += '<p class="text-danger">Please select a document file.</p>';
        }
        // Display error messages if any
        if (errorMessage !== '') {
            event.preventDefault(); // Prevent form submission
            document.getElementById('errorMessages').innerHTML = errorMessage;
        }
    });
    function updateFileName(input) {
            var fileName = input.files[0].name;
            document.getElementById('document_file_name').textContent = fileName;
    }
        

   // Add an event listener to call updateStatusLabel() when the checkbox state changes
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

    class MagicFocus {
        constructor(parent) {
            if (!parent) return;
            this.parent = parent;
            this.focus = document.createElement('div');
            this.focus.classList.add('magic-focus');
            this.parent.classList.add('has-magic-focus');
            this.parent.appendChild(this.focus);
            const inputs = this.parent.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    this.show();
                });
                input.addEventListener('blur', () => {
                    this.hide();
                });
            });
        }

        show() {
            const activeElement = document.activeElement;
            if (!['INPUT', 'SELECT', 'TEXTAREA'].includes(activeElement.nodeName)) return;
            clearTimeout(this.reset);
            let el = activeElement;
            if (['checkbox', 'radio'].includes(el.type)) {
                el = document.querySelector(`[for="${el.id}"]`);
            }
            this.focus.style.top = `${el.offsetTop || 0}px`;
            this.focus.style.left = `${el.offsetLeft || 0}px`;
            this.focus.style.width = `${el.offsetWidth || 0}px`;
            this.focus.style.height = `${el.offsetHeight || 0}px`;
        }

        hide() {
            const activeElement = document.activeElement;
            if (!['INPUT', 'SELECT', 'TEXTAREA', 'LABEL'].includes(activeElement.nodeName)) return;
            this.focus.style.width = 0;
            this.reset = setTimeout(() => {
                this.focus.removeAttribute('style');
            }, 200);
        }
    }

    // Initialize
    window.magicFocus = new MagicFocus(document.querySelector('.form'));

    // Assuming this is a jQuery function
    $(() => {
        $('.select').customSelect();
    });
</script>
@endsection