@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Get In Touch</a></li>
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
                    <form action="{{ isset($touch) ? route('getintouch.update', ['id' => $touch->id]) : route('getintouch.store') }}" method="POST" class="form" enctype="multipart/form-data">
                        @csrf

                        <p class='field required'>
                            <label class='label required' for='address'>Address</label>
                            <input class='text-input' id='address' name='address' required type='text' value="{{ $touch->address ?? '' }}">
                        </p>
                        <p class='field required'>
                            <label class='label required' for='email'>Email</label>
                            <input class='text-input' id='email' name='email' required type='email' value="{{ $touch->email ?? '' }}">
                        </p>
                        <p class='field required'>
                            <label class='label required' for='contact'>Contact</label>
                            <input class='text-input' id='contact' name='contact' required type='text' value="{{ $touch->contact ?? '' }}">
                        </p>
                        <p class='field required'>
                            <label class='label required' for='status'>Status</label>
                            <div class="toggle-switch">
                                <input type="checkbox" name="status" id="status" class="toggle-switch-checkbox" onchange="updateStatusLabel()"{{ isset($touch->status) && strpos($touch->status, 'Active') !== false ? 'checked'  : '' }}>
                                <label for="status" class="toggle-switch-label"></label>
                                <br><label id="statusLabel" for="status"></label>
                                <!-- Hidden input to store the value -->
                                <input type="hidden" name="status_hidden" id="status_hidden" value="">
                            </div>
                        </p><br>

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
                        </style>

                        <p class='field'>
                            @if($viewMode)
                            <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('touch') }}'">
                            @else
                            <input class='button' type='submit' value="{{$submit}}">
                            @endif
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
