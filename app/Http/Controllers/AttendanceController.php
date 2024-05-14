<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function store(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'stud_id' => 'required|exists:students,stud_id',
            'teachers_id' => 'required|exists:teachers,teachers_id',
            'status' => 'required|in:Present,Absent,On Leave',
            'month' => 'required|in:January,February,March,April,May,June,July,August,September,October,November,December'
        ]);
    
        // Create a new Attendance instance
        $attendance = new Attendance();
    
        // Assign validated data to attendance attributes
        $attendance->stud_id = $validatedData['stud_id'];
        $attendance->teachers_id = $validatedData['teachers_id'];
        $attendance->status = $validatedData['status'];
        $attendance->month = $validatedData['month'];
       
    
        // Save the attendance data to the database
        $attendance->save();
    
        // Redirect back to the attendance page after successful creation
        return redirect('admin/attendance');
    }

    public function view() {
        $attendances = Attendance::with('student', 'teacher')->where('status', 'present')->get();
        return view('attendance', ['attendances' => $attendances]);
    }

    public function form(){
        $students = Student::all();
        $teachers = Teacher::all();
        $submit = "SUBMIT";
        $viewMode = false;
        $mode = "ADD ATTENDANCE";
        return view('admin/attendanceform', compact('mode', 'viewMode', 'submit', 'teachers', 'students'));
    }

    public function delete($id) {
        $attendances = Attendance::find($id);
        if (!is_null($attendances)) {
            echo '<script>';
            echo 'if (confirm("Are you sure you want to delete this Attendance?")) {';
            echo '  window.location.href = "' . route('attendance.confirm-delete', ['id' => $id]) . '";';
            echo '} else {';
            echo '  window.location.href = "' . route('attendance') . '";'; // Redirect back to student list
            echo '}';
            echo '</script>';
            exit; 
        }
    }

    public function confirmDelete($id) {
        $attendances = Teacher::find($id);
        if (!is_null($attendances)) {
            $attendances->delete();
        }
        return redirect('admin/attendance');
    }

    public function edit($id) {
        $attendances = Attendance::find($id);
        if (is_null($attendances)) {
            return redirect()->back();
        } else {
            $students = Student::all();
            $teachers = Teacher::all();
            $attendance = "";
            $id = "";
            $viewMode = false; 
            $submit = "UPDATE";
            $months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            $mode = "EDIT ATTENDANCE";
            $data = compact("attendances", "viewMode", "months", "attendance", "id", "mode", "submit", "teachers", "students");
            return view('admin/attendanceform')->with($data);
        }
    }

    public function update($id, Request $request) {
         $attendance = Attendance::find($id);
         $attendance->stud_id = $request->input('stud_id');
         $attendance->teachers_id = $request->input('teachers_id');
         $attendance->status = $request->input('status');
         $attendance->month =  $request->input('month');
         $attendance->save();
         return redirect('admin/attendance');
    }

    public function viewattendance($id) {
        $attendances = Attendance::find($id);
        $teachers = Teacher::all();
        $students = Student::all();
        if (is_null($attendances)) {
            return redirect()->back();
        } else {
            $submit = "OK";
            $viewMode = true; 
            $mode = "ATTENDANCE DETAILS";
            $data = compact("attendances", "mode", "submit", "teachers", "students", "viewMode");
            return view('admin/attendanceform')->with($data);
        }
    }

    public function search(Request $request) {
        $searchQuery = $request->input('query');
    
        // Perform search in your database based on the $searchQuery
        $attendancedata = Attendance::with(['student', 'teacher'])
                                    ->where('status', 'Present')
                                    ->where(function ($query) use ($searchQuery) {
                                        $query->whereHas('student', function ($studentQuery) use ($searchQuery) {
                                                $studentQuery->where('name', 'like', "%{$searchQuery}%");
                                            })
                                            ->orWhereHas('teacher', function ($teacherQuery) use ($searchQuery) {
                                                $teacherQuery->where('name', 'like', "%{$searchQuery}%");
                                            });
                                    })
                                    ->get();
    
        return response()->json(['attendancedata' => $attendancedata]);
    }
}
