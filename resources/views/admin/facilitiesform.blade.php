@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Facilities</a></li>
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
                    <form action="{{ isset($facilities) ? route('facilities.update', ['id' => $facilities->facilities_id]) : route('facilities.store') }}" id="facilityForm" method="POST" class="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editMode" value="{{ isset($facilities) ? 'true' : 'false' }}">
                       
                        <p class="mb-3">
                            <label for="facility" class="form-label">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" value="{{ isset($facilities->icon) ? $facilities->icon : '' }}">
                            <span class="error-message"></span>
                        </p>

                        <p class="mb-3">
                            <label for="facility" class="form-label">Facility</label>
                            <input type="text" class="form-control" id="facility" name="facility" value="{{ isset($facilities->facility) ? $facilities->facility : '' }}">
                            <span class="error-message"></span>
                        </p>

                        <p class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ isset($facilities->description) ? $facilities->description : '' }}</textarea>
                            <span class="error-message"></span>
                        </p>

                        <p class='field required'>
                            <label class='label required' for='status'>Status</label>
                            <div class="toggle-switch">
                                <input type="checkbox" name="status" id="status" class="toggle-switch-checkbox" onchange="updateStatusLabel()"{{ isset($facilities->status) && strpos($facilities->status, 'Active') !== false ? 'checked'  : '' }}>
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
                                <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('facilities') }}'">
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
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('facilityForm').addEventListener('submit', function(event) {
            var editMode = document.getElementById('editMode').value;
            var errorMessage = ''; // Initialize error message variable

            // Validate icon
            var iconInput = document.getElementById('icon');
            if (iconInput.value.trim() === '') {
                errorMessage += '<p class="text-danger">Please enter an icon.</p>';
                iconInput.nextElementSibling.innerHTML = 'Please enter an icon.';
            } else {
                iconInput.nextElementSibling.innerHTML = '';
            }

            // Validate facility
            var facilityInput = document.getElementById('facility');
            if (facilityInput.value.trim() === '') {
                errorMessage += '<p class="text-danger">Please enter a facility.</p>';
                facilityInput.nextElementSibling.innerHTML = 'Please enter a facility.';
            } else {
                facilityInput.nextElementSibling.innerHTML = '';
            }

            // Validate description
            var descriptionInput = document.getElementById('description');
            if (descriptionInput.value.trim() === '') {
                errorMessage += '<p class="text-danger">Please enter a description.</p>';
                descriptionInput.nextElementSibling.innerHTML = 'Please enter a description.';
            } else {
                descriptionInput.nextElementSibling.innerHTML = '';
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
