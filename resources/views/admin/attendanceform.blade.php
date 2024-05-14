@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3"> 
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Attendance</a></li>
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
                    <form action="{{ isset($attendances) ? route('attendance.update', ['id' => $attendances->attendance_id]) : route('attendance.store') }}" id="attendancForm" method="POST" class="form">
                        @csrf
                        <input type="hidden" id="editMode" value="{{ isset($attendances) ? 'true' : 'false' }}">
                        <p class='field required'>
                            <label class='label required' for='stud_id'>Student</label>
                            <select class='select' id='stud_id' name='stud_id' required>
                                <option value='' disabled selected>Select Student</option>
                                @foreach($students as $student)
                                <option value="{{ $student->stud_id }}"{{ isset($attendances) && $attendances->stud_id == $student->stud_id ? ' selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                                @endforeach
                            </select>
                        </p>

                        <p class='field required'>
                            <label class='label required' for='teachers_id'>Teacher</label>
                            <select class='select' id='teachers_id' name='teachers_id' required>
                                <option value='' disabled selected>Select Teacher</option>
                                @foreach($teachers as $teacher)
                                <option value="{{ $teacher->teachers_id }}"{{ isset($attendances) && $attendances->teachers_id == $teacher->teachers_id ? ' selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                                @endforeach
                            </select>
                        </p>

                        <p class="field required">
                            <label class="label required" for="status">Status</label>
                            <div class="select">
                                <select name="status" id="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Present"{{ isset($attendances->status) && $attendances->status == 'present' ? ' selected' : '' }}>Present</option>
                                    <option value="Absent">Absent</option>
                                </select>
                            </div>
                        </p>
                        <p class="field required">
                            <label class="label required" for="month">Month</label>
                            <div class="select">
                                <select name="month" id="month" required>
                                    <option value="" disabled selected>Select Month</option>
                                    <?php
                                    $months = [
                                        'January', 'February', 'March', 'April', 'May', 'June',
                                        'July', 'August', 'September', 'October', 'November', 'December'
                                    ];

                                    $selectedMonth = isset($attendances->month) ? $attendances->month : null;

                                    foreach ($months as $month) {
                                        $selected = ($selectedMonth === $month) ? 'selected' : '';
                                        echo "<option value='$month' $selected>$month</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </p>
                        <p class='field'>
                            @if($viewMode)
                            <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('attendance') }}'">
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
                    <div id="errorMessages"></div>
                    <style>
                        .error-message {
                            color: red;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
