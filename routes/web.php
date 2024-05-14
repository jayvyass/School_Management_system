<?php

use App\Models\Facility;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TouchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleauthController;


Route::get('admin/auth/google', [GoogleauthController::class,'redirect'])->name('google.redirect');
Route::get('admin/auth/google/callback', [GoogleauthController::class,'callback']);


Route::fallback(function () {
    return view('frontend/error_404');
});

//frontend
Route::get('/', [FrontendController::class, 'index'])->name('indeex');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/classes', [FrontendController::class, 'classes'])->name('classes');
Route::get('/facility', [FrontendController::class, 'facility'])->name('facility');
Route::get('/review', [FrontendController::class, 'review'])->name('review');
Route::get('/teacher', [FrontendController::class, 'teachers'])->name('teacher');
Route::get('/write-review', [FrontendController::class, 'writereview'])->name('writereview');
Route::get('/testimonial', [FrontendController::class, 'testimonial'])->name('testimonial');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/result', [FrontendController::class, 'result'])->name('getresult');
Route::get('/error-404', [FrontendController::class, 'error404'])->name('error_404');
//frontend reviews , contact us , result form
Route::post('admin/contact/search', [ContactFormController::class, 'search'])->name('contact_us.search');
Route::post('/store', [ContactFormController::class, 'submitForm'])->name('contact.submit');
Route::post('/reviewstore', [reviewController::class, 'submitreview'])->name('review.submit');
Route::post('/get-result', [ResultController::class, 'getResult'])->name('get-result');
Route::get('/download-pdf/{student}', [ResultController::class, 'downloadPDF'])->name('download-pdf');



//admin signin-signup form
Route::get('admin/signin', [SigninController::class, 'view',])->name('signin');
Route::get('admin/signup', [SignupController::class, 'view'])->name('signup');
Route::post('admin/signup', [SignupController::class, 'register']);
Route::post('admin/signin', [signinController::class, 'login']);
Route::get('admin/logout', [SigninController::class, 'logout'])->name('logoutt');
Route::post('admin/logout', [signinController::class, 'logout']);
//Admin
Route::group(['prefix' => 'admin','middleware' => 'admin'], function () {
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/students', [AdminController::class, 'students'])->name('students');
Route::get('/users', [AdminController::class, 'users'])->name('users');
Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers');
Route::get('/banners', [AdminController::class, 'banners'])->name('banners');
Route::get('/facilities', [AdminController::class, 'facilities'])->name('facilities');
Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
Route::get('/classes', [AdminController::class, 'classes'])->name('class');
Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
Route::get('/getintouch', [AdminController::class, 'touch'])->name('touch');
Route::get('/contact', [AdminController::class, 'contact'])->name('contact_us');
});


//for roles teacher 
Route::group(['prefix' => 'admin','middleware' => 'teacher'], function () {
    Route::get('/attendance', [AdminController::class, 'attendance'])->name('attendance');
    Route::get('/results', [AdminController::class, 'results'])->name('results');
});

//students
Route::group(['prefix'=>'admin/students','middleware' => 'teacher'],function(){
Route::post('/store', [StudentController::class, 'store'])->name('students.store');
Route::get('/form', [StudentController::class, 'form'])->name('students.form');
Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
Route::get('/delete/{id}', [StudentController::class, 'delete'])->name('students.delete');
Route::get('/{id}', [StudentController::class, 'ConfirmDelete'])->name('students.confirm-delete');
Route::get('/view/{id}', [StudentController::class, 'viewstudent'])->name('students.view');
Route::post('/update/{id}', [StudentController::class, 'update'])->name('students.update');
Route::post('/search', [StudentController::class,'search'])->name('students.search');

});

//Teachers
Route::group(['prefix'=>'admin/teachers','middleware' => 'admin'],function(){
    Route::post('/store', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/form',[ TeacherController::class, 'form'])->name('teachers.form');
    Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::get('/delete/{id}', [TeacherController::class, 'delete'])->name('teachers.delete');
    Route::get('/{id}', [StudentController::class, 'ConfirmDelete'])->name('teachers.confirm-delete');
    Route::get('/view/{id}', [TeacherController::class, 'viewteacher'])->name('teachers.view');
    Route::post('/update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::post('/search', [TeacherController::class,'search'])->name('teachers.search');
});

//Courses
Route::group(['prefix'=>'admin/courses','middleware' => 'admin'],function(){
    Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/form',[ CourseController::class, 'form'])->name('courses.form');
    Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('courses.edit');
    Route::get('/delete/{id}', [CourseController::class, 'delete'])->name('courses.delete');
    Route::get('/{id}', [CourseController::class, 'ConfirmDelete'])->name('courses.confirm-delete');
    Route::get('/view/{id}', [CourseController::class, 'viewcourse'])->name('courses.view');
    Route::post('/update/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::post('/search', [CourseController::class, 'search'])->name('courses.search');
});

//Attendance
Route::group(['prefix'=>'admin/attendance','middleware' => 'teacher'],function(){
    Route::post('/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/form',[ AttendanceController::class, 'form'])->name('attendance.form');
    Route::get('/edit/{id}', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::get('/delete/{id}', [AttendanceController::class, 'delete'])->name('attendance.delete');
    Route::get('/{id}', [AttendanceController::class, 'ConfirmDelete'])->name('attendance.confirm-delete');
    Route::get('/view/{id}', [AttendanceController::class, 'viewattendance'])->name('attendance.view');
    Route::post('/update/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::post('/search', [AttendanceController::class, 'search'])->name('attendance.search');
});

// results
Route::group(['prefix'=>'admin/results','middleware' => 'teacher'],function(){
    Route::post('/store', [ResultController::class, 'store'])->name('results.store');
    Route::get('/form',[ ResultController::class, 'form'])->name('results.form');
    Route::get('/edit/{id}', [ResultController::class, 'edit'])->name('results.edit');
    Route::get('/delete/{id}', [ResultController::class, 'delete'])->name('results.delete');
    Route::get('/{id}', [ResultController::class, 'ConfirmDelete'])->name('results.confirm-delete');
    Route::get('/view/{id}', [ResultController::class, 'viewresult'])->name('results.view');
    Route::post('/update/{id}', [ResultController::class, 'update'])->name('results.update');
    Route::post('/search', [ResultController::class, 'search'])->name('results.search');
});


// facilities
Route::group(['prefix'=>'admin/facilities','middleware' => 'admin'],function(){
    Route::post('/store', [FacilityController::class, 'store'])->name('facilities.store');
    Route::get('/form',[ FacilityController::class, 'form'])->name('facilities.form');
    Route::get('/edit/{id}', [FacilityController::class, 'edit'])->name('facilities.edit');
    Route::get('/delete/{id}', [FacilityController::class, 'delete'])->name('facilities.delete');
    Route::get('/{id}', [FacilityController::class, 'ConfirmDelete'])->name('facilities.confirm-delete');
    Route::get('/view/{id}', [FacilityController::class, 'viewfacility'])->name('facilities.view');
    Route::post('/update/{id}', [FacilityController::class, 'update'])->name('facilities.update');
    Route::post('/search', [FacilityController::class, 'search'])->name('facilities.search');
});

// banners
Route::group(['prefix'=>'admin/banners','middleware' => 'admin'],function(){
    Route::post('/store', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/form',[ BannerController::class, 'form'])->name('banners.form');
    Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banners.edit');
    Route::get('/delete/{id}', [BannerController::class, 'delete'])->name('banners.delete');
    Route::get('/{id}', [BannerController::class, 'ConfirmDelete'])->name('banners.confirm-delete');
    Route::get('/view/{id}', [BannerController::class, 'viewbanner'])->name('banners.view');
    Route::post('/update/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::post('/search', [BannerController::class, 'search'])->name('banners.search');
});

// reviews
Route::group(['prefix'=>'admin/reviews','middleware' => 'admin'],function(){
    Route::post('/store', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/form',[ ReviewController::class, 'form'])->name('reviews.form');
    Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::get('/delete/{id}', [ReviewController::class, 'delete'])->name('reviews.delete');
    Route::get('/{id}', [ReviewController::class, 'ConfirmDelete'])->name('reviews.confirm-delete');
    Route::get('/view/{id}', [ReviewController::class, 'viewreview'])->name('reviews.view');
    Route::post('/update/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::post('/search', [ReviewController::class, 'search'])->name('reviews.search');
});

//classes
Route::group(['prefix'=>'admin/classes','middleware' => 'admin'],function(){
    Route::post('/store', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/form',[ ClassController::class, 'form'])->name('classes.form');
    Route::get('/edit/{id}', [ClassController::class, 'edit'])->name('classes.edit');
    Route::get('/delete/{id}', [ClassController::class, 'delete'])->name('classes.delete');
    Route::get('/{id}', [ClassController::class, 'ConfirmDelete'])->name('classes.confirm-delete');
    Route::get('/view/{id}', [ClassController::class, 'viewclass'])->name('classes.view');
    Route::post('/update/{id}', [ClassController::class, 'update'])->name('classes.update');
    Route::post('/search', [ClassController::class, 'search'])->name('classes.search');
});
   
//getintouch
Route::group(['prefix'=>'admin/getintouch','middleware' => 'admin'],function(){
    Route::post('/store', [TouchController::class, 'store'])->name('getintouch.store');
    Route::get('/form',[ TouchController::class, 'form'])->name('getintouch.form');
    Route::get('/edit/{id}', [TouchController::class, 'edit'])->name('getintouch.edit');
    Route::get('/delete/{id}', [TouchController::class, 'delete'])->name('getintouch.delete');
    Route::get('/{id}', [TouchController::class, 'ConfirmDelete'])->name('getintouch.confirm-delete');
    Route::get('/view/{id}', [TouchController::class, 'viewtouch'])->name('getintouch.view');
    Route::post('/update/{id}', [TouchController::class, 'update'])->name('getintouch.update');
    Route::post('/search', [TouchController::class, 'search'])->name('getintouch.search');
});

//users
Route::group(['prefix'=>'admin/users','middleware' => 'admin'],function(){
    Route::get('/form',[ UserController::class, 'form'])->name('users.form');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/{id}', [UserController::class, 'ConfirmDelete'])->name('users.confirm-delete');
    Route::get('/view/{id}', [UserController::class, 'viewuser'])->name('users.view');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/search', [UserController::class, 'search'])->name('users.search');
});

