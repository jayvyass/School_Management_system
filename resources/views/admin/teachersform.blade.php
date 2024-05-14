@extends('admin.admin')
@push('nav')
 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3"> 
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Teachers</a></li>
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
<form id="teacherForm" action='{{ isset($teachers) ? route('teachers.update', ['id' => $teachers->teachers_id]) : route('teachers.store') }}' method="POST" class='form' enctype="multipart/form-data">
    <!-- Form content goes here -->
@csrf
<input type="hidden" id="editMode" value="{{ isset($teachers) ? 'true' : 'false' }}">

    <p class='field required'>
        <label class='label required' for='name'>Full Name</label>
        <input class='text-input' id='name' name='name' required type='text' value="{{ $teachers->name ?? '' }}" minlength="2" maxlength="50">
        <span class="error-message"></span> <!-- Error message span -->
    </p>
    <p class='field required'>
        <label class='label required' for='email'>Email</label>
        <input class='text-input' id='email' name='email' required type='email' value="{{$teachers->email ?? '' }}">
        <span class="error-message"></span> <!-- Error message span -->
    </p>
    <p class='field required'>
        <label class='label required' for='post'>Designation</label>
        <select class='select' id='post' name='post' required>
            <option value='' disabled selected>Select Post</option>
            <option value='Professor'{{ isset($teachers) && $teachers->designation == 'Professor' ? ' selected' : '' }}>Professor</option>
            <option value='Lecturer'{{ isset($teachers) && $teachers->designation == 'Lecturer' ? ' selected' : '' }}>Lecturer</option>
            <option value='Assistant Professor'{{ isset($teachers) && $teachers->designation == 'Assistant Professor' ? ' selected' : '' }}>Assistant Professor</option>
        </select>
        <span class="error-message"></span>
    </p>
    <p class='field required'>
        <label class='label required' for='contact'>Contact</label>
        <input class='text-input' id='contact' name='contact' required type='text' value="{{$teachers->contact_no ?? ''}}">
        <span class="error-message"></span> <!-- Error message span -->
    </p>
    <p class='field'>
        <label class='label' for='image_upload'>Image Upload</label>
        <input type="file" name="image" accept="image/*" onchange="previewImage(this)">
        <br>
        @if(isset($teachers) && $teachers->photo)
            <img src="{{ asset('admin/'.$teachers->photo) }}" alt="Uploaded Image" style="max-width: 100px;">
        @else
            <img id="image_preview" src="#" alt="Preview Image" style="display: none; max-width: 100px;">
        @endif
    </p>
    <p class='field required'>
        <label class='label required' for='joining_date'>Joining Date</label>
        <input class='text-input' id='joining_date' name='joining_date' required type='date' value="{{$teachers->joined_date ?? ''}}">
        <span class="error-message"></span> <!-- Error message span -->
    </p>
    <p class='field required'>
        <label class='label required' for='status'>Status</label>
        <div class="toggle-switch">
            <input type="checkbox" name="status" id="status" class="toggle-switch-checkbox" onchange="updateStatusLabel()" {{ isset($teachers->status) && strpos($teachers->status, 'Active') !== false ? 'checked'  : '' }}>
            <label for="status" class="toggle-switch-label"></label>
            <br><label id="statusLabel" for="status"></label>
            <!-- Hidden input to store the value -->
            <input type="hidden" name="status_hidden" id="status_hidden" value="{{$teachers->status ?? ''}}">
        </div>
        <span class="error-message"></span> <!-- Error message span -->
    </p>
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
        <input class='checkbox-input' id='subject_math' name='subjects[]' type='checkbox' value='Maths'{{ isset($teachers->subject) && strpos($teachers->subject, 'Math') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_math'>Mathematics</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_physics' name='subjects[]' type='checkbox' value='Physics'{{ isset($teachers->subject) && strpos($teachers->subject, 'Science') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_physics'>Physics</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_economics' name='subjects[]' type='checkbox' value='Economics'{{ isset($teachers->subject) && strpos($teachers->subject, 'Economics') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_economics'>Economics</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_biology' name='subjects[]' type='checkbox' value='Biology'{{ isset($teachers->subject) && strpos($teachers->subject, 'Biology') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_biology'>Biology</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_chemistry' name='subjects[]' type='checkbox' value='Chemistry'{{ isset($teachers->subject) && strpos($teachers->subject, 'Chemistry') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_chemistry'>Chemistry</label>
    </li>
    <li class='checkbox'>
        <input class='checkbox-input' id='subject_english' name='subjects[]' type='checkbox' value='English'{{ isset($teachers->subject) && strpos($teachers->subject, 'English') !== false ? 'checked' : '' }}>
        <label class='checkbox-label' for='subject_english'>English</label>
    </li>
</ul>
    </p>
    <p class='field'>
        @if($viewMode)
            <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('teachers') }}'">
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
document.getElementById('teacherForm').addEventListener('submit', function(event) {
    var editMode = document.getElementById('editMode').value;
    var errorMessage = ''; // Initialize error message variable
   
    var nameInput = document.getElementById('name');
        if (nameInput.value.trim() === '') {
            errorMessage += '<p class="text-danger">Please enter a name.</p>';
            nameInput.nextElementSibling.innerHTML = 'Please enter a name.';
        } else if (nameInput.value.length < 2 || nameInput.value.length > 50) {
            errorMessage += '<p class="text-danger">Full Name must be between 2 and 50 characters.</p>';
            nameInput.nextElementSibling.innerHTML = 'Full Name must be between 2 and 50 characters.';
        } else {
            nameInput.nextElementSibling.innerHTML = '';
        }

        // Validate email
        var emailInput = document.getElementById('email');
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value.trim())) {
            errorMessage += '<p class="text-danger">Please enter a valid email address.</p>';
            emailInput.nextElementSibling.innerHTML = 'Please enter a valid email address.';
        } else {
            emailInput.nextElementSibling.innerHTML = '';
        }

        // Validate designation
        var designationInput = document.getElementById('post');
        if (designationInput.value === '') {
            errorMessage += '<p class="text-danger">Please select a designation.</p>';
            designationInput.nextElementSibling.innerHTML = 'Please select a designation.';
        } else {
            designationInput.nextElementSibling.innerHTML = '';
        }

  
         // Validate contact number
        var contactInput = document.getElementById('contact');
        var contactPattern = /^\d{10}$/;
        if (!contactPattern.test(contactInput.value)) {
            errorMessage += '<p class="text-danger">Please enter a valid 10-digit contact number.</p>';
            contactInput.nextElementSibling.innerHTML = 'Please enter a valid 10-digit contact number.';
        } else {
            contactInput.nextElementSibling.innerHTML = '';
        }
        var joiningDateInput = document.getElementById('joining_date');
        var currentDate = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format
        if (joiningDateInput.value > currentDate) {
            errorMessage += '<p class="text-danger">Joining date cannot be in the future.</p>';
            joiningDateInput.nextElementSibling.innerHTML = 'Joining date cannot be in the future.';
        } else {
            joiningDateInput.nextElementSibling.innerHTML = '';
        }
    // Check if the image input is empty
        var imageUpload = document.querySelector('input[name="image"]');
        if (editMode === 'false' && imageUpload.files.length === 0) {
            errorMessage += '<p class="text-danger">Please select an image file.</p>';
        }
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