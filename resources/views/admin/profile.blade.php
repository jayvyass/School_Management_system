 @extends('admin.admin')

@push('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Profile</h6>
        </nav>
@section('main')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{asset('/img/chancellor.jpeg')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Dr. Mark Schlissel
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        Chancellor / President
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <ul class="list-group"><br>
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; Dr. Mark Schlissel</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; annarbour@mail.com</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; USA</li>
                                <li class="list-group-item border-0 ps-0 pb-0">
                                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                    <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.facebook.com/UniversityOfMichigan">
                                        <i class="fab fa-facebook fa-lg"></i>
                                    </a>
                                    <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="https://twitter.com/UMich">
                                        <i class="fab fa-twitter fa-lg"></i>
                                    </a>
                                    <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.instagram.com/uofmichigan">
                                        <i class="fab fa-instagram fa-lg"></i>
                                    </a>
                                  </li><br><br><br>
                                  <h6 class="mb-4">Platform Settings</h6>
                                <div class="card-body p-3">
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Profile Information</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm">He holds esteemed honorary doctorates from prestigious institutions including Chiba University and the Vancouver School of Theology, acknowledging his profound contributions to academia and leadership.
                                In recognition of his exceptional commitment to diversity and inclusion in higher education, he was honored with the esteemed Reginald Wilson Diversity Leadership Award by the American Council on Education.
                                Additionally, his remarkable professional achievements have been acknowledged with the esteemed Professional Achievement Award from the University of Chicago, underscoring his significant impact and dedication to his field. </p>
                            <hr class="horizontal gray-light my-4">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Conversations</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                    <div class="avatar me-3">
                                        <img src="{{asset('img/kal-visuals-square.jpg')}}" alt="kal" class="border-radius-lg shadow">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">Sophie B.</h6>
                                        <p class="mb-0 text-xs">Hi! I need more information..</p>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                <div class="avatar me-3">
                                  <img src="{{asset('img/marie.jpg')}}" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">Anne Marie</h6>
                                  <p class="mb-0 text-xs">Awesome work, can you..</p>
                                </div>
                              </li>
                              <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                <div class="avatar me-3">
                                  <img src="{{asset('/img/ivana-square.jpg')}}" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">Ivanna</h6>
                                  <p class="mb-0 text-xs">About files I can..</p>
                                </div>
                              </li>
                              <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                <div class="avatar me-3">
                                  <img src="{{asset('/img/team-4.jpg')}}" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">Peterson</h6>
                                  <p class="mb-0 text-xs">Have a great afternoon..</p>
                                </div>
                              </li>
                              <li class="list-group-item border-0 d-flex align-items-center px-0">
                                <div class="avatar me-3">
                                  <img src="{{asset('/img/team-4.jpg')}}" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">Nick Daniel</h6>
                                  <p class="mb-0 text-xs">Hi! I need more information..</p>
                                </div>
                              </li>                 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="mb-5 ps-3">
                <h6 class="mb-1">Projects</h6>
                <p class="text-sm">University Projects</p>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                <div class="card card-blog card-plain">
                    <div class="card-header p-0 mt-n4 mx-3">
                      <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{asset('/img/campus1.jpeg')}}" style="width: 156.5px;height: 106.44px;" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                      </a>
                    </div>
                    <div class="card-body p-3"style="height: 220px;">
                      <p class="mb-0 text-sm">Project #1</p>     
                        <h5>
                          London Campus
                        </h5>                     
                      <p class="mb-4 text-sm">
                        With a diverse range of programs and resources, the OU London campus offers a unique learning experience
                      </p>                     
                    </div>
                  </div>
                </div>
                  <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                    <div class="card card-blog card-plain">
                     <div class="card-header p-0 mt-n4 mx-3">
                       <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{asset('/img/campus2.jpeg')}}" style="width: 156.5px;height: 106.44px;" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                      </a>
                     </div>
                      <div class="card-body p-3"style="height: 220px;">
                        <p class="mb-0 text-sm">Project #2</p>                    
                          <h5>
                           UAE Campus
                          </h5>                     
                        <p class="mb-4 text-sm">
                        Our campus in the UAE provides a dynamic educational experience, blending modern facilities with a culturally rich environment.
                        </p>                   
                      </div>
                    </div>
                  </div>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="card-header p-0 mt-n4 mx-3">
                      <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{asset('/img/campus3.jpeg')}}" style="width: 156.5px;height: 106.44px;" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                      </a>
                    </div>
                    <div class="card-body p-3"style="height: 220px;">
                      <p class="mb-0 text-sm">Project #3</p>                    
                        <h5>
                          USA Campus
                        </h5>                    
                      <p class="mb-4 text-sm">
                        Our campuses in the USA offer a world-class education, featuring renowned faculty, cutting-edge research facilities.
                      </p>                    
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="card-header p-0 mt-n4 mx-3">
                      <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{asset('/img/campus4.jpeg')}}" style="width: 156.5px;height:106.44px;" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                      </a>
                    </div>
                    <div class="card-body p-3"style="height: 220px;">
                      <p class="mb-0 text-sm">Project #4</p>                  
                        <h5>
                          Australia Campus
                        </h5>                  
                      <p class="mb-4 text-sm">
                        Our campuses in Australia provide a welcoming and inclusive environment for students to pursue their academic.
                      </p>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
