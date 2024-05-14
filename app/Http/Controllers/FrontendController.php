<?php

namespace App\Http\Controllers;
use App\Models\Facility; 
use App\Models\Banner; 
use App\Models\Review; 
use App\Models\Teacher; 
use App\Models\Classes;
use App\Models\Touch;



use Illuminate\Http\Request;


class FrontendController extends Controller
{
    public function index() {
        $footerAddress = "3rd Floor,Karma Complex,Ahmedabad,India";
        $footerPhone = "+7878787878";
        $footerEmail = "info@iflair.com";
        $teachers =Teacher::where('status','Active')->get();
        $classes = Classes::with('teacher')->where('status','Active')->get();
        $facilities = Facility::where('status','Active')->get(); 
        $reviews = Review::all();
        $banners = Banner::where('status','Active')->get(); 
        return view('frontend.index', compact('facilities','classes','banners','reviews','teachers'));
    }

    public function about(){
        $teachers =Teacher::where('status','Active')->get();
        return view('frontend.about',compact('teachers'));
    }

    public function classes() {
        $classes = Classes::with('teacher')->where('status','Active')->get();
        $reviews = Review::all();
        return view('frontend.classes',compact('reviews','classes'));
    }

    public function facility() {

        $facilities = Facility::where('status','Active')->get(); 
        return view('frontend.facility', compact('facilities'));

    }
    public function review() {
        return view('frontend.review');
    }
    public function teachers() {
        $teachers =Teacher::where('status','Active')->get();
        return view('frontend.teachers',compact('teachers'));
    }

    public function becomeTeacher() {
       
        return view('frontend.become_teacher');
    }

    public function writereview() {
        return view('frontend.write_review');
    }
    public function result() {
        return view('frontend.result');
    }
    public function testimonial() {
        $reviews = Review::all();
        return view('frontend.testimonial',compact('reviews'));
    }

    public function contact() {
        $touchs = Touch::where('status', 'Active')->get();
        return view('frontend.contact',compact('touchs'));
    }

    public function error404() {
        return view('frontend.error_404');
    }
}
