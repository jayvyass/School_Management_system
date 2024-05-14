<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function store(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'subject' => 'required|string|max:255',
            'teachers_id' => 'required|exists:teachers,teachers_id',
            'age_group' => 'required|string|max:255',
            'time_duration' => 'required|string|max:255',
            'capacity' => 'required|numeric',
            'status_hidden' => 'required|in:Active,Away',
            'subject_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Create a new Classes instance
        $class = new Classes();

        // Assign validated data to class attributes
        $class->subject = $validatedData['subject'];
        $class->teachers_id = $validatedData['teachers_id'];
        $class->age_group = $validatedData['age_group'];
        $class->time_duration = $validatedData['time_duration'];
        $class->capacity = $validatedData['capacity'];
        $class->status = $validatedData['status_hidden'];

        // Process and save the uploaded image if available
        if ($request->hasFile('subject_photo')) {
            $image = $request->file('subject_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images'), $imageName);
            $class->subject_photo = 'images/' . $imageName;
        }

        // Save the class data to the database
        $class->save();

        // Redirect back to the classes page after successful creation
        return redirect('admin/classes');
    }

    public function form() {
        $submit = "SUBMIT";
        $mode = "ADD CLASS";
        $viewMode = false;
        $teachers = Teacher::all();
        $class = Classes::with('teacher')->where('status', 'Active')->get();
        return view('admin/classesform', compact('mode', 'viewMode', 'submit', 'class', 'teachers'));
    }

    public function delete($id) {
        $classes = Classes::find($id);
        if (!is_null($classes)) {
            echo '<script>';
            echo 'if (confirm("Are you sure you want to delete this Class?")) {';
            echo '  window.location.href = "' . route('classes.confirm-delete', ['id' => $id]) . '";';
            echo '} else {';
            echo '  window.location.href = "' . route('class') . '";'; // Redirect back to student list
            echo '}';
            echo '</script>';
            exit;
        }
    }

    public function confirmDelete($id) {
        $classes = Classes::find($id);
        if (!is_null($classes)) {
            $classes->delete();
        }
        return redirect('admin/classes');
    }

    public function edit($id) {
        $classes = Classes::find($id);
        if (is_null($classes)) {
            return redirect()->back();
        } else {
            $teachers = Teacher::all();
            $id = "";
            $submit = "UPDATE";
            $viewMode = false;
            $mode = "EDIT CLASS";
            $data = compact("classes", "id", "viewMode", "mode", "submit", "teachers");
            return view('admin/classesform')->with($data);
        }
    }

    public function update($id, Request $request){
        $class = Classes::find($id);
        $class->subject = $request->input('subject');
        $class->teachers_id = $request->input('teachers_id');
        $class->age_group = $request->input('age_group');
        $class->time_duration = $request->input('time_duration');
        $class->capacity = $request->input('capacity');
        $class->status = $request->input('status_hidden');

        if ($request->hasFile('subject_photo')) {
            $image = $request->file('subject_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images'), $imageName);
            $class->subject_photo = 'images/' . $imageName;
        }

        $class->save();

        return redirect('admin/classes');
    }

    public function viewclass($id) {
        $classes = Classes::find($id);
        $teachers = Teacher::all();

        if (is_null($classes)) {
            return redirect()->back();
        } else {
            $submit = "OK";
            $viewMode = true;
            $mode = "CLASS DETAILS";
            $data = compact("classes", "viewMode", "mode", "submit", "teachers");
            return view('admin/classesform')->with($data);
        }
    }

    public function search(Request $request) {
        $query = $request->input('query');

        // Perform search in your database based on the $query
        $classdata = Classes::where('status', 'Active')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', "%{$query}%")
                    ->orWhere('profession', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->get();

        return response()->json(['classdata' => $classdata]);
    }
}
