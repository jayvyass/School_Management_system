<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Teacher; 
class TeacherController extends Controller
{
        public function store(Request $request) {
            // Create a new Student instance
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email|unique:teachers,email',
                'post' => 'required|string|max:255',
                'contact' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'joining_date' => 'required|date',
                'status_hidden' => 'required|in:Active,Away',
                'subjects' => 'required|array',
                'subjects.*' => 'required|string|max:255',
            ]);
            
            $teacher = new Teacher();
            $teacher->name = $validatedData['name'];
            $teacher->email = $validatedData['email'];
            $teacher->designation = $validatedData['post'];
            $teacher->contact_no = $validatedData['contact'];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('admin/images'), $imageName);
                $teacher->photo = 'images/' . $imageName;
            }

            $teacher->joined_date = $validatedData['joining_date'];  
            $teacher->status = $validatedData['status_hidden']; 
            $teacher->subject = implode(',', $validatedData['subjects']);

            $teacher->save();


            return redirect('admin/teachers');
         }

        public function view() {
            $teachers =teacher::where('status', 'Active')->get();
            return view('admin/teachers', ['teachers' => $teachers]);
         } 
   
        
        public function form() {
            $submit="SUBMIT";
            $viewMode = false;
            $mode ="ADD TEACHER";
            return view('admin/teachersform',compact('mode','submit','viewMode'));
        }

        
        public function delete($id) {
            $teachers = Teacher::find($id);
                if (!is_null($teachers)) {
                    echo '<script>';
                    echo 'if (confirm("Are you sure you want to delete this Teacher?")) {';
                    echo '  window.location.href = "' . route('teachers.confirm-delete', ['id' => $id]) . '";';
                    echo '} else {';
                    echo '  window.location.href = "' . route('teachers') . '";'; // Redirect back to student list
                    echo '}';
                    echo '</script>';
                    exit; 
                }
            
        }

        public function confirmDelete($id) {
            $teachers = Teacher::find($id);
            if (!is_null($teachers)) {
                $teachers->delete();
            }
            return redirect('admin/teachers');
        }


        public function edit($id) {
            $teachers = Teacher::find($id);
            if (is_null($teachers)) {
                return redirect()->back();
            } else {
              
                $id ="";
                $submit="UPDATE";
                $viewMode = false;
                $mode = "EDIT TEACHER";
                $data = compact("teachers","viewMode", "id", "mode","submit");
                return view('admin/teachersform')->with($data);
            }
        }
        
        public function update($id, Request $request) {
            $teachers = Teacher::find($id);
            $teachers->name = $request->input('name');
            $teachers->email = $request->input('email');
            $teachers->designation = $request->input('post');
            $teachers->contact_no = $request->input('contact');    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('admin/images'), $imageName);
                $teachers->photo = 'images/' . $imageName;
            }    
            $teachers->joined_date = $request->input('joining_date');
            $teachers->status = $request->input('status_hidden');
            $teachers->subject = implode(',', $request->input('subjects'));
            $teachers->save();
            return redirect('admin/teachers');
        }

        public function viewteacher($id) {
            $teachers = Teacher::find($id);

            if (is_null($teachers)) {
                return redirect()->back();
            } else {
                $submit="OK";
                $mode = "TEACHER DETAILS";
                $viewMode = true;
                $data = compact("teachers","viewMode","mode","submit");
                return view('admin/teachersform')->with($data);
            }
        }
       
        public function search(Request $request) {                       
                   
            $query = $request->input('query');
            $subject = $request->input('subject');

            $queryBuilder = Teacher::where('status', 'Active');

            // Apply search query
            if (!empty($query)) {
                $queryBuilder->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%")
                        ->orWhere('subject', 'like', "%{$query}%")
                        ->orWhere('designation', 'like', "%{$query}%")
                        ->orWhere('contact_no', 'like', "%{$query}%");
                });
            }

            // Apply subject filter
            if (!empty($subject) && $subject !== 'Reset') {
                $queryBuilder->where('subject', 'like', "%{$subject}%");
            }

            $teacherdata = $queryBuilder->get();

            return response()->json(['teacherdata' => $teacherdata]);
        }
    }