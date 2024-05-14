<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student; 
class StudentController extends Controller
{
        public function store(Request $request) {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email|unique:students,email',
                'gender' => 'required|in:male,female',
                'grade' => 'required|numeric',
                'guardian_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'contact' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'document_upload' => 'nullable|file|mimes:pdf,doc,png,jpeg,jpg,docx',
                'dob' => 'required|date',
                'status_hidden' => 'required|in:Active,Away',
                'subjects' => 'required|array',
                'subjects.*' => 'required|string|max:255',
            ]);
        
            // Create a new Student instance
            $student = new Student();
        
            $student->name = $validatedData['name'];
            $student->email = $validatedData['email'];
            $student->gender = $validatedData['gender'];
            $student->grade = $validatedData['grade'];
            $student->guardian_name = $validatedData['guardian_name'];
            $student->contact_no = $validatedData['contact'];
        
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('admin/images'), $imageName);
                $student->photo = 'images/' . $imageName;
            }
        
            if ($request->hasFile('document_upload')) {
                $document = $request->file('document_upload');               
                $documentName = time() . '.' . $document->getClientOriginalExtension();
                $document->move(public_path('documents'), $documentName);
                $student->document = 'documents/' . $documentName;
            }
            
            $student->dob = $validatedData['dob'];  
            $student->status = $validatedData['status_hidden']; 
            $student->subjects = implode(', ', $validatedData['subjects']);
            $student->save();
            
            return redirect('admin/students');
        }
        

   
        public function view() {
            $students = Student::where('status', 'Active')->get();
            return view('students', ['students' => $students]);
           
        } 

   
        
        public function form() {
            $student = [];
            $imageUrl="";
            $submit="SUBMIT";
            $viewMode = false;
            $mode ="ADD STUDENTS";
            return view('admin/studentsform',compact('mode',"viewMode",'submit','imageUrl'));
        }

        
        public function delete($id) {
            $student = Student::find($id);
            if (!is_null($student)) {
                echo '<script>';
                echo 'if (confirm("Are you sure you want to delete this student?")) {';
                echo '  window.location.href = "' . route('students.confirm-delete', ['id' => $id]) . '";';
                echo '} else {';
                echo '  window.location.href = "' . route('students') . '";'; // Redirect back to student list
                echo '}';
                echo '</script>';
                exit; 
            }           
        }
      

        public function confirmDelete($id) {
            $student = Student::find($id);
            if (!is_null($student)) {
                $student->delete();
            }
            return redirect('admin/students');
        }
        
        

        
        public function edit($id) {
            $students = Student::find($id);

            if (is_null($students)) {
                return redirect()->back();
            } else {
                $id ="";
                $submit="UPDATE";
                $viewMode = false;
                $mode = "EDIT STUDENT";
                $data = compact("students","viewMode", "id", "mode","submit");
               
                return view('admin/studentsform')->with($data);
            }
        }
        
        
        public function update($id, Request $request) {
            $students = Student::find($id);

            $students->name = $request->input('name');
            $students->email = $request->input('email');
            $students->gender = $request->input('gender');
            $students->grade = $request->input('grade');
            $students->guardian_name = $request->input('guardian_name');
            $students->contact_no = $request->input('contact');      
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('admin/images'), $imageName);
                $students->photo = 'images/' . $imageName;
            }
            if ($request->hasFile('document_upload')) {
                $document = $request->file('document_upload');
                $documentName = time() . '.' . $document->getClientOriginalExtension();
                $document->move(public_path('documents'), $documentName);
                $students->document = 'documents/' . $documentName;
            }
            $students->dob = $request->input('dob');
            $students->status = $request->input('status_hidden'); 
            $students->subjects = implode(',', $request->input('subjects'));
            $students->save();
            return redirect('admin/students');
        }
        
        
        
        public function viewstudent($id) {
            $students = Student::find($id);

            if (is_null($students)) {
                return redirect()->back();
            } else {
                $submit="OK";   
                $viewMode = true;
                $mode = "STUDENT DETAIS";
                $data = compact("students","viewMode", "mode","submit");
                return view('admin/studentsform')->with($data);
            }
        }



        public function search(Request $request) {                  
            
                $query = $request->input('query');
                $gender = $request->input('gender'); // Get the gender filter
            
                $queryBuilder = Student::where('status', 'Active');
            
                // Apply search query
                if (!empty($query)) {
                    $queryBuilder->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('name', 'like', "%{$query}%")
                            ->orWhere('email', 'like', "%{$query}%")
                            ->orWhere('grade', 'like', "%{$query}%")
                            ->orWhere('contact_no', 'like', "%{$query}%");
                    });
                }
            
                // Apply gender filter
                if (!empty($gender) && $gender !== 'Reset') {
                    $queryBuilder->where('gender', $gender);
                }
            
                $studentdata = $queryBuilder->get();
            
                return response()->json(['studentdata' => $studentdata]);
        }
        
        
}
