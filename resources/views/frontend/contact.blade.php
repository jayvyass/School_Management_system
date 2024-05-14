@extends('frontend/front')
@section('main')
        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Contact Us</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Get In Touch</h1>
                    <p>Our responsive communication channels ensure that parents, students, and stakeholders can easily connect with our administration and faculty.</p>
                </div>
                @foreach ($touchs as $touch)
                <div class="row g-4 mb-5">
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <h6>{{$touch->address}}</h6>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-envelope-open fa-2x text-primary"></i>
                        </div>
                        <h6>{{$touch->email}}</h6>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-phone-alt fa-2x text-primary"></i>
                        </div>
                        <h6>{{$touch->contact}}</h6>
                    </div>
                </div>
                @endforeach
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Send Queries</h1>
                                <form action="{{ route('contact.submit') }}" method="post" onsubmit="return validateForm()">
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
                                                <input type="email" class="form-control border-0" id="email" name="email" placeholder="Your Email">
                                                <label for="email">Your Email</label>
                                                <div id="emailError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="subject" name="subject" placeholder="Subject">
                                                <label for="subject">Subject</label>
                                                <div id="subjectError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0" id="message" name="message" placeholder="Leave a message here" style="height: 100px"></textarea>
                                                <label for="message">Message</label>
                                                <div id="messageError" class="error-message" style="display: none; color: red;"></div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                    <div id="error-messages" class="alert alert-danger" style="display: none; color: black;"></div>
                                </form>
                                <script>
                                    function validateForm() {
                                        var name = document.getElementById('name').value;
                                        var email = document.getElementById('email').value;
                                        var subject = document.getElementById('subject').value;
                                        var message = document.getElementById('message').value;
                                        var isValid = true;

                                        if (name.trim() === '') {
                                            showError('Name is required', 'nameError');
                                            isValid = false;
                                        } else {
                                            hideError('nameError');
                                        }

                                        if (email.trim() === '') {
                                            showError('Email is required', 'emailError');
                                            isValid = false;
                                        } else {
                                            hideError('emailError');
                                        }

                                        if (subject.trim() === '') {
                                            showError('Subject is required', 'subjectError');
                                            isValid = false;
                                        } else {
                                            hideError('subjectError');
                                        }

                                        if (message.trim() === '') {
                                            showError('Message is required', 'messageError');
                                            isValid = false;
                                        } else {
                                            hideError('messageError');
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
                                <iframe class="position-relative rounded w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.2936228093376!2d72.55784831035527!3d23.012988879093662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848ac8a7faf3%3A0x2acdd9c8fedc8456!2siFlair%20Web%20Technologies%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1711976204073!5m2!1sen!2sin"
                                frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                                tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
@endsection