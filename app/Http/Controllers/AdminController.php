<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Result;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Facility;
use App\Models\Banner;
use App\Models\Contact_us;
use App\Models\Review;
use App\Models\Classes;
use App\Models\Touch;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard() {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalCourses = Course::count();
        $totalClasses = Classes::count();

        $totalStudents2024 = Student::whereYear('dob', '=', '2024')->count();
        $totalStudentsLastYear = Student::whereYear('dob', '=', '2023')->count();
        $percentageChange = 0;
        $iconClass = '';

        if ($totalStudentsLastYear > 0) {
            $percentageChange = (($totalStudents2024 - $totalStudentsLastYear) / $totalStudentsLastYear) * 100;
            $percentageChange = number_format($percentageChange, 2);

            if ($percentageChange > 0) {
                $iconClass = 'success';
                $percentageChange = '+' . $percentageChange . '%';
            } elseif ($percentageChange < 0) {
                $iconClass = 'danger';
                $percentageChange = '-' . $percentageChange . '%';
            }
        } else {
            $percentageChange = 0;
            $iconClass = 'info';
            $percentageChange = '0%';
        }

        // Dynamically show % increases in courses
        $totalFallCourses = Course::where('semester', 'Fall')->count();
        $totalSpringCourses = Course::where('semester', 'Spring')->count();
        $totalCourses = $totalFallCourses + $totalSpringCourses;
        $percentageFallCourses = 0;
        $percentageSpringCourses = 0;
        $iconClass2 = '';

        if ($totalCourses > 0) {
            $percentageFallCourses = number_format(($totalFallCourses / $totalCourses) * 100, 2);
            $percentageSpringCourses = number_format(($totalSpringCourses / $totalCourses) * 100, 2);
            if ($percentageFallCourses > 0) {
                $iconClass2 = 'success';
                $percentageFallCourses = '+' . $percentageFallCourses . '%';
            } elseif ($percentageFallCourses < 0) {
                $iconClass2 = 'danger';
                $percentageFallCourses = '-' . $percentageFallCourses . '%';
            }
        }

        // Dynamically show % increases for teachers
        $totalTeachers2024 = Teacher::whereYear('joined_date', '=', '2024')->count();
        $totalTeachersLastYear = Teacher::whereYear('joined_date', '=', '2023')->count();
        $percentageChangeTeachers = 0;
        $iconClass3 = '';

        if ($totalTeachersLastYear > 0) {
            $percentageChangeTeachers = (($totalTeachers2024 - $totalTeachersLastYear) / $totalTeachersLastYear) * 100;
            $percentageChangeTeachers = number_format($percentageChangeTeachers, 2);

            if ($percentageChangeTeachers > 0) {
                $iconClass3 = 'success';
                $percentageChangeTeachers = '+' . $percentageChangeTeachers . '%';
            } elseif ($percentageChangeTeachers < 0) {
                $iconClass3 = 'danger';
                $percentageChangeTeachers = '-' . $percentageChangeTeachers . '%';
            }
        }

        // Dynamically gets the x , y label for students results
        $results = Result::with('students')->orderByDesc('marks')->get();
        $gradeStats = [];
        foreach ($results as $result) {
            $grade = $result->students->grade;
            $marksArray = explode(',', $result->marks);
            $totalMarks = array_sum($marksArray);
            $percentage = ($totalMarks / (count($marksArray) * 100)) * 100;
            if (!isset($gradeStats[$grade])) {
                $gradeStats[$grade] = ['totalPercentage' => 0, 'count' => 0];
            }
            $gradeStats[$grade]['totalPercentage'] += $percentage;
            $gradeStats[$grade]['count']++;
        }
        $gradePercentages = [];
        foreach ($gradeStats as $grade => $stats) {
            $averagePercentage = $stats['totalPercentage'] / $stats['count'];
            $gradePercentages[$grade] = $averagePercentage;
        }
        arsort($gradePercentages);
        $gradeMapping = [];
        $index = 0;
        foreach ($gradePercentages as $grade => $percentage) {
            $index++;
            $gradeMapping[$grade] = $index;
        }
        $sortedGrades = range(1, 12);
        $sortedPercentages = [];
        foreach ($sortedGrades as $grade) {
            if (isset($gradePercentages[$grade])) {
                $percentage = number_format($gradePercentages[$grade], 2);
                $sortedPercentages[] = $percentage;
            } else {
                $sortedPercentages[] = 0;
            }
        }
        $sortedPercentages[] = 100;

        // Dynamically gets the x , y label for students attendance
        $attendanceMonths = Attendance::distinct()->where('status', 'present')->pluck('month')->toArray();
        sort($attendanceMonths);
        $allMonths = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        $totalPresentPerMonth = [];
        foreach ($allMonths as $month) {
            $totalPresentStudents = in_array($month, $attendanceMonths) ?
                Attendance::where('status', 'present')->where('month', $month)->count() : 0;
            $totalPresentPerMonth[] = $totalPresentStudents;
        }

        // Get top 10 students
        $results = Result::with('students')->get();
        $topStudents = $results->map(function ($result) {
            $marksArray = explode(',', $result->marks);
            $totalMarks = array_sum($marksArray);
            $totalSubjects = count($marksArray);
            $totalPossibleMarks = $totalSubjects * 100; // Assuming each subject is out of 100 marks
            $percentage = ($totalMarks / $totalPossibleMarks) * 100;
            $result->percentage = number_format($percentage, 2);
            return $result;
        });
        $topStudents = $topStudents->sortByDesc('percentage')->take(10);

        return view('admin.dashboard', [
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'totalCourses' => $totalCourses,
            'totalClasses' => $totalClasses,
            'topStudents' => $topStudents,
            'sortedGrades' => $sortedGrades,
            'sortedPercentages' => $sortedPercentages,
            'attendanceMonths' => $attendanceMonths,
            'totalPresentPerMonth' => $totalPresentPerMonth,
            'percentageChange' => $percentageChange,
            'percentageChangeTeachers' => $percentageChangeTeachers,
            'percentageFallCourses' => $percentageFallCourses,
            'iconClass' => $iconClass,
            'iconClass2' => $iconClass2,
            'iconClass3' => $iconClass3,
        ]);
    }

    public function profile()
    {
        return view('admin.profile');
    }
    public function index(){
        return view('admin.index');
    }
    public function students(){
        $students = Student::where('status', 'Active')->get();
        return view('admin.students', ['students' => $students]);
    }
    public function teachers(){
        $courses = Course::all();
        $teachers =Teacher::where('status', 'Active')->get();
            return view('admin.teachers', ['teachers' => $teachers], ['courses' => $courses]);
    }
    public function facilities(){
        $facilities =Facility::where('status', 'Active')->get();
        return view('admin.facilities', ['facilities' => $facilities]);
    }
    public function banners(){
        $banners =Banner::where('status', 'Active')->get();
        return view('admin.banners', ['banners' => $banners]);
    }
    public function reviews(){
        $reviews = Review::all();
        return view('admin.reviews', ['reviews' => $reviews]);
    }
    public function contact(){
        $contactForms = Contact_us::all();
        return view('admin.contact', ['contactForms' => $contactForms]);
    }
    public function courses(){
        $courses = Course::with('teacher')->where('status', 'Active')->get();
        return view('admin.courses', ['courses' => $courses]);
     
    }
    public function classes(){
        $classes = Classes::with('teacher')->where('status', 'Active')->get();
        return view('admin.classes', ['classes' => $classes]);
     
    }
    public function attendance() {
        $attendances = Attendance::with('student','teacher')->where('status', 'present')->get();
        return view('admin.attendance', ['attendances' => $attendances]);
    }
    public function results() {
        
        $teachers = Teacher::all();
        $results = Result::with('students')->where('status', 'Active')->get();
        return view('admin.results', ['results' => $results, 'teachers' => $teachers]);
    }
    public function touch(){
        $touchs = Touch::where('status', 'Active')->get();
        return view('admin.getintouch', ['touchs' => $touchs]);
    }
    public function signin(){
        return view('admin.signin');
    }
    public function users(){
        $users = User::whereIn('roles', ['user', 'teacher'])->get();        
        return view('admin.users', ['users' => $users]);
    }
}
