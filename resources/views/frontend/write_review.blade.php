@extends('frontend/front')
@section('main')
<!-- Page Header End -->
<div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Write Review</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Write Review</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Write review Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Write Review</h1>
                                <form action="{{ route('review.submit') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="name" name="name" placeholder="Your Name">
                                                <label for="name">Your Name</label>
                                                <div id="nameError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="file" class="form-control border-0" id="image" name="image" accept="image/*">
                                                <label for="image">Upload Image</label>
                                                <div id="imageError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="profession" name="profession" placeholder="Your Profession">
                                                <label for="profession">Profession</label>
                                                <div id="professionError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0" id="description" name="description" placeholder="Leave a description here" style="height: 100px"></textarea>
                                                <label for="description">Description</label>
                                                <div id="descriptionError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                                        </div>
                                    </div>
                                    <div id="error-messages" class="alert alert-danger" style="display: none; color: black;"></div>
                                </form>

                                <script>
                                    function validateForm() {
                                        var name = document.getElementById('name').value;
                                        var image = document.getElementById('image').value;
                                        var profession = document.getElementById('profession').value;
                                        var description = document.getElementById('description').value;
                                        var isValid = true;

                                        if (name.trim() === '') {
                                            showError('Your Name is required', 'nameError');
                                            isValid = false;
                                        } else {
                                            hideError('nameError');
                                        }

                                        if (image.trim() === '') {
                                            showError('Please upload an Image', 'imageError');
                                            isValid = false;
                                        } else {
                                            hideError('imageError');
                                        }

                                        if (profession.trim() === '') {
                                            showError('Your Profession is required', 'professionError');
                                            isValid = false;
                                        } else {
                                            hideError('professionError');
                                        }

                                        if (description.trim() === '') {
                                            showError('Description is required', 'descriptionError');
                                            isValid = false;
                                        } else {
                                            hideError('descriptionError');
                                        }

                                        if (!isValid) {
                                            document.getElementById('error-messages').style.display = 'none';
                                        }

                                        return isValid;
                                    }

                                    function showError(message, errorId) {
                                        var errorElement = document.getElementById(errorId);
                                        errorElement.innerText = message;
                                        errorElement.style.display = 'block';
                                    }

                                    function hideError(errorId) {
                                        var errorElement = document.getElementById(errorId);
                                        errorElement.style.display = 'none';
                                    }
                                </script>

                                @if (session('status') == 'success')
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100 rounded" src="{{asset('img/appointment.jpg')}}" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- write review End -->
@endsection