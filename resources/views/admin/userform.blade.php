@extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3"> 
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Users</a></li>
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
                <form id="userForm" action="{{ route('users.update', ['id' => $user->id]) }}" method="POST" class="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editMode" value="{{ isset($user) ? 'true' : 'false' }}">
                        
                        <p class='field required'>
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($user->name) ? $user->name : '' }}">
                        </p>
                        <p class='field required'>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ isset($user->email) ? $user->email : '' }}">
                        </p>
                        <p class='field required'>
                            <label for="roles" class="form-label">Roles</label>
                            <select class="form-select" id="roles" name="roles">
                                <option value="user" {{ isset($user->roles) && $user->roles == 'user' ? 'selected' : '' }}>User</option>
                                <option value="teacher" {{ isset($user->roles) && $user->roles == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            </select>
                        </p>

                        <p class='field'>
                            @if($viewMode)
                            <input class='button' type='button' value="{{$submit}}" onclick="window.location.href='{{ route('users') }}'">
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
    @endsection
