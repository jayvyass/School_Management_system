<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Teacher;

class CourseController extends Controller
{
    public function store(Request $request){
        // Validate the incoming request data
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'teachers_id' => 'required|exists:teachers,teachers_id',
            'semester' => 'required|string|max:255',
            'credits' => 'required|numeric',
            'status_hidden' => 'required|in:Active,Away',
        ]);

        // Create a new Course instance
        $course = new Course();

        // Assign validated data to course attributes
        $course->course_name = $validatedData['course_name'];
        $course->teachers_id = $validatedData['teachers_id'];
        $course->semester = $validatedData['semester'];
        $course->credits = $validatedData['credits'];
        $course->status = $validatedData['status_hidden'];

        // Save the course data to the database
        $course->save();

        // Redirect back to the courses page after successful creation
        return redirect('admin/courses');
    }

    public function view() {
        $courses = Course::with('teacher')->where('status', 'Active')->get();
        return view('courses', ['courses' => $courses]);
    }

    public function form() {
        $teachers = Teacher::all();
        $submit = "SUBMIT";
        $viewMode = false;
        $mode = "ADD COURSE";
        return view('admin/coursesform', compact('mode', 'viewMode', 'submit', 'teachers'));
    }

    public function delete($id) {
        $courses = Course::find($id);
        if (!is_null($courses)) {
            echo '<script>';
            echo 'if (confirm("Are you sure you want to delete this Course?")) {';
            echo '  window.location.href = "' . route('courses.confirm-delete', ['id' => $id]) . '";';
            echo '} else {';
            echo '  window.location.href = "' . route('courses') . '";'; // Redirect back to student list
            echo '}';
            echo '</script>';
            exit;
        }
    }

    public function confirmDelete($id) {
        $courses = Course::find($id);
        if (!is_null($courses)) {
            $courses->delete();
        }
        return redirect('admin/courses');
    }

    public function edit($id) {
        $courses = Course::find($id);
        if (is_null($courses)) {
            return redirect()->back();
        } else {
            $id = "";
            $viewMode = false;
            $teachers = Teacher::all();
            $submit = "UPDATE";
            $mode = "EDIT COURSE";
            $data = compact("courses", "id", "viewMode", "mode", "submit", "teachers");
            return view('admin/coursesform')->with($data);
        }
    }

    public function update($id, Request $request) {
        $course = Course::find($id);
        $course->course_name = $request->input('course_name');
        $course->teachers_id = $request->input('teachers_id');
        $course->semester = $request->input('semester');
        $course->credits = $request->input('credits');
        $course->status = $request->input('status_hidden');
        $course->save();
        return redirect('admin/courses');
    }

    public function viewcourse($id) {
        $courses = Course::find($id);
        $teachers = Teacher::all();
        if (is_null($courses)) {
            return redirect()->back();
        } else {
            $submit = "OK";
            $viewMode = true;
            $mode = "COURSE DETAILS";
            $data = compact("courses", "viewMode", "mode", "submit", "teachers");
            return view('admin/coursesform')->with($data);
        }
    }

    public function search(Request $request) {
        {
            $query = $request->input('query');
            // Perform search in your database based on the $query
            $coursedata = Course::with('teacher')
                ->where('status', 'Active')
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('course_name', 'like', "%{$query}%")
                        ->orWhere('credits', 'like', "%{$query}%")
                        ->orWhere('semester', 'like', "%{$query}%")
                        ->orWhereHas('teacher', function ($teacherQuery) use ($query) {
                            $teacherQuery->where('name', 'like', "%{$query}%");
                        });
                })
                ->get();

            //  return view('students', compact('studentdata'));
            return response()->json(['coursedata' => $coursedata]);
        }
    }
}
