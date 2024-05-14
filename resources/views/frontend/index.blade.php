@extends('frontend/front')
@section('main')

        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div class="owl-carousel header-carousel position-relative">
                @foreach($banners as $banner)
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{'admin/'.$banner->image}}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white animated slideInDown mb-4">{{ $banner->text }}</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">{{ $banner->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Facilities Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">School Facilities</h1>
                    <p>Our school provides extensive facilities, including well-equipped classrooms, computer labs, and a cafeteria, ensuring a conducive learning environment for students.</p>
                </div>
                <div class="row g-4">
                @foreach($facilities as $facility)
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="facility-item">
                            <div class="facility-icon bg-primary">
                                <span class="bg-primary"></span>
                                <i class="fa fa-{{ $facility->icon }} fa-3x text-primary"></i>
                                <span class="bg-primary"></span>
                            </div>
                            <div class="facility-text bg-primary">
                                <h3 class="text-primary mb-3">{{ $facility->facility }}</h3>
                                <p class="mb-0">{{ $facility->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Facilities End -->


        
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
            @if($count < 6)
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

<!-- classes end -->


       <!-- Team Start -->
       <div class="container-xxl py-5">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h1 class="mb-3">Popular Teachers</h1>
                        <p>Highly qualified and experienced teachers lead our classrooms, fostering a dynamic and supportive learning environment where students can thrive academically and personally.</p>
                    </div>
                    <div class="row g-4">
                        @php $count = 0; @endphp
                        @foreach ($teachers as $teacher)
                            @if ($count >= 3) @break @endif
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="team-item position-relative">
                                    <img class="img-fluid rounded-circle w-75" src="{{ asset('admin/'.$teacher->photo) }}" alt="">
                                    <div class="team-text">
                                        <h3>{{ $teacher->name }}</h3>
                                        <p>{{ $teacher->designation }}</p>
                                    </div>
                                </div>
                            </div>
                            @php $count++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        <!-- Team End --> 
        
        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
        <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Our Clients Say!</h1>
            <p>Our school receives consistently positive reviews from students and parents alike, praising its nurturing environment and dedicated faculty.</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach($reviews as $review)
            <div class="testimonial-item bg-light rounded p-5" style="height: 400px; overflow: hidden;"> <!-- Set a fixed height and enable overflow -->
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