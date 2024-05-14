@extends('frontend/front')
@section('main')
<!-- Page Header End -->
<div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Classes</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Classes</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Classes Start -->
        <div class="container-xxl py-5">
         <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">School Classes</h1>
            <p>Our classes are conducted in modern, well-furnished rooms equipped with the latest educational technology, facilitating interactive and engaging learning experiences.</p>
        </div>
        <div class="row g-4">
            @php
            $count = 0;
            @endphp
            @foreach($classes as $class)
            @if($count < 9)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('admin/'.$class->subject_photo) }}" alt="">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="">{{ $class->subject }}</a>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('admin/'.$class->teacher->photo) }}" alt="" style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">{{ $class->teacher->name }}</h6>
                                    <small>{{ $class->teacher->designation }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-4">
                                <div class="border-top border-3 border-primary pt-2">
                                    <h6 class="text-primary mb-1">Age:</h6>
                                    <small>{{ $class->age_group }}</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-success pt-2">
                                    <h6 class="text-success mb-1">Time:</h6>
                                    <small>{{ $class->time_duration }}</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-warning pt-2">
                                    <h6 class="text-warning mb-1">Capacity:</h6>
                                    <small>{{ $class->capacity }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
            $count++;
            @endphp
            @endif
            @endforeach
        </div>
    </div>
</div>


        <!-- Classes End -->


        

        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Our Clients Say!</h1>
            <p>With a focus on individualized attention and academic excellence, our institution garners acclaim for its impactful teaching methods and supportive community..</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach($reviews as $review)
            <div class="testimonial-item bg-light rounded p-5">
                <p class="fs-5">{{ $review->description }}</p>
                <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('admin/'.$review->image) }}" style="width: 90px; height: 90px;">
                    <div class="ps-3">
                        <h3 class="mb-1">{{ $review->name }}</h3>
                        <span>{{ $review->profession }}</span>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
        <!-- Testimonial End -->
@endsection