@extends('frontend/front')
@section('main')


        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Testimonial</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Testimonial</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
        <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Our Clients Say!</h1>
            <p>The glowing reviews highlight our school's commitment to fostering not just academic growth, but also personal development and success for every student.</p>
        </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                @php
                $count = 0; // Initialize counter variable
                @endphp
                @foreach($reviews as $review)
                    @if($count >= 7)
                        @break // Break the loop if 8 reviews are processed
                    @endif
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
                    @php
                    $count++; // Increment counter
                    @endphp
                @endforeach
        </div>
    </div>
</div>
@endsection