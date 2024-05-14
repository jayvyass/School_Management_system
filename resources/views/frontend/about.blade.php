@extends('frontend/front')
@section('main')
  
<div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">About Us</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->



        <!-- Team Start -->
        <div class="container-xxl py-5">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h1 class="mb-3">Popular Teachers</h1>
                        <p>With a commitment to professional development, our teachers have access to ongoing training and resources, ensuring they stay abreast of best practices and deliver high-quality instruction tailored to student needs.</p>
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
        @endsection