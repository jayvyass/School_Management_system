@extends('frontend/front')
@section('main')
<!-- Page Header End -->
<div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Your Result</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Your Result</li>
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
                                <h1 class="mb-4">Get Your Result</h1>
                                <form action="{{ route('get-result') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="name" name="name" placeholder="Your Name">
                                                <label for="name">Your Name</label>
                                                <div id="nameError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>                                      
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="email" class="form-control border-0" id="email" name="email" placeholder="Your Email">
                                                <label for="email">Email</label>
                                                <div id="emailError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="date" class="form-control border-0" id="dob" name="dob" placeholder="Your Date of Birth">
                                                <label for="dob">Date of Birth</label>
                                                <div id="dobError" class="error-message" style="display: none; color: red;"></div>
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
                                        var email = document.getElementById('email').value;
                                        var dob = document.getElementById('dob').value;
                                        var isValid = true;

                                        if (name.trim() === '') {
                                            showError('Your Name is required', 'nameError');
                                            isValid = false;
                                        } else {
                                            hideError('nameError');
                                        }

                                        if (email.trim() === '') {
                                            showError('Your Email is required', 'emailError');
                                            isValid = false;
                                        } else if (!isValidEmail(email)) {
                                            showError('Invalid Email address', 'emailError');
                                            isValid = false;
                                        } else {
                                            hideError('emailError');
                                        }

                                        if (dob.trim() === '') {
                                            showError('Date of Birth is required', 'dobError');
                                            isValid = false;
                                        } else {
                                            hideError('dobError');
                                        }

                                        if (!isValid) {
                                            document.getElementById('error-messages').innerText = "Please fix the errors below.";
                                            document.getElementById('error-messages').style.display = 'block';
                                        }

                                        return isValid;
                                    }

                                    function isValidEmail(email) {
                                        // Regular expression for email validation
                                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                        return emailRegex.test(email);
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
                                @if(session('status') == 'error')
                                    <div class="alert alert-danger">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100 rounded" src="{{asset('img/about-1.jpg')}}" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- write review End -->
@endsection