<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; 
use App\Models\Teacher; 
use App\Models\Student;
use App\Models\Attendance;
use Dompdf\Dompdf;
use Dompdf\Options;

class ResultController extends Controller
{
    public function store(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'stud_id' => 'required|exists:students,stud_id',
            'teachers_id' => 'required|exists:teachers,teachers_id',
            'exam_date' => 'required|date',
            'status_hidden' => 'required|in:Active,Away',
        ]);
    
        // Create a new Result instance
        $result = new Result();
    
        // Assign validated data to result attributes
        $result->stud_id = $validatedData['stud_id'];
        $result->teachers_id = $validatedData['teachers_id'];
        $result->exam_date = $validatedData['exam_date'];
        $result->status = $validatedData['status_hidden']; 
        $marks = implode(',', $request->input('marks'));
        $result->marks = $marks;
        // Save the result data to the database
        $result->save();
    
        // Redirect back to the results page after successful creation
        return redirect('admin/results');
    }
    

    
    public function getResult(Request $request) {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'dob' => 'required|date',
        ]);
       
        // Check if the student exists with the provided credentials
        $student = Student::where('name', $request->name)
                          ->where('email', $request->email)
                          ->where('dob', $request->dob)
                          ->first();
                
                if ($student) {
                    // If student exists, get the result
                    $result = Result::where('stud_id', $student->stud_id)->first();
                              
                if ($result) {
                    $attendance = Attendance::where('stud_id',$student->stud_id)->first();
                    $allResults = Result::all();
                    // If result exists, return welcome message and result details
                    return view('frontend/yourresult', compact('student', 'result','attendance','allResults'));
            } else {
                // If no result found, return error message
                return back()->with('status', 'error')->with('message', 'No result found for this student.');
            }
        } else {
            // If student not found, return error message
            return back()->with('status', 'error')->with('message', 'Student not found with provided credentials.');
        }
    }

    // $result = Result::where('stud_id',$student->stud_id)->get();
    public function downloadPDF(Student $student) {
        $pdf = new Dompdf();
        $allResults = Result::all();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);
        $results = Result::where('stud_id',$student->stud_id)->get();
        $resultHtml = '<h1>Result for ' . $student->name . '</h1>';

    foreach ($results as $result) {
        $resultHtml .= '<p>Marks: ' . $result->marks . '</p>';
        $resultHtml .= '<p>Grade: ' . $result->grade . '</p>';
        // Add other necessary fields here
    }
        // Define the HTML structure to be included in the PDF
        $html = '<style>
                /* Add custom CSS styles for better presentation */
                .table {
                    border-collapse: collapse;
                    width: 100%;
                }
                .table th, .table td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: left;
                }
                body {
                    font-family: Arial, sans-serif;
                }
                .container {
                    width: 100%;
                    padding: 20px;
                }
                .school-name {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .letter-pad {
                    border: 2px solid #000;
                    padding: 20px;
                    margin-bottom: 20px;
                }
                .school-name {
                    font-size: 24px;
                    font-weight: bold;
                    text-align: center;
                    margin-bottom: 20px;
                }
                .card-header {
                    font-size: 20px;
                    font-weight: bold;
                    background-color: #007bff;
                    color: #fff;
                    padding: 10px;
                    text-align: center;
                    margin-bottom: 20px;
                }
                .student-info {
                    margin-bottom: 20px;
                }
                .student-photo {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    margin-right: 20px;
                }
                .table-bordered th, .table-bordered td {
                    border: 1px solid #000;
                }
                .remarks {
                    font-style: italic;
                    margin-top: 20px;
                }
                .download-btn {
                    text-align: center;
                }
            </style>
            <div class="school-name">
                <h2>Divine Life International School</h2>
            </div>             
            <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: center;"><strong>Name:</strong></td>
                        <td style="text-align: center;">' . $student->name . '</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><strong>Exam Date:</strong></td>
                        <td style="text-align: center;">' . $result->exam_date . '</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><strong>Standard:</strong></td>
                        <td style="text-align: center;">' . $student->grade . '</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr>
                        <th style="text-align: center;">Subjects</th>
                        <th style="text-align: center;">Marks(100)</th>
                        <th style="text-align: center;">Grade</th>
                    </tr>
                </thead>
                <tbody>';
               
            
                $subjects = explode(',', $student->subjects);
                $marks = explode(',', $result->marks);
                $totalMarks = 0;
                function calculateMarks($marks) {
                    if ($marks >= 85) {
                        return 'A'; // Highest Grade
                    } elseif ($marks >= 70 && $marks < 85) {
                        return 'B'; // Second Highest Grade
                    } elseif ($marks >= 50 && $marks < 70) {
                        return 'C'; // Third Highest Grade
                    } elseif ($marks >= 35 && $marks < 50) {
                        return 'D'; // Fourth Highest Grade
                    } else {
                        return 'F'; // Lowest Grade
                    }
                }
                foreach ($subjects as $index => $subject) {
                    $html .= '<tr>
                        <td style="text-align: center;">' . $subject . '</td>
                        <td style="text-align: center;">';
            
                        if (isset($marks[$index])) {
                            $html .= $marks[$index];
                        }
            
                        $html .= '</td>
                        <td style="text-align: center;">';
            
                        $grade = calculateMarks($marks[$index]);
                        $html .= $grade;
            
                        $html .= '</td>
                    </tr>';
            
                    if (isset($marks[$index])) {
                        $totalMarks += intval($marks[$index]);
                    }
                }
            
            
            $html .= '</tbody>
            </table>
            <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: center;"><strong>Total Marks:</strong></td>
                        <td style="text-align: center;">' . $totalMarks . '</td>
                        <td style="text-align: center;"><strong>Percentage:</strong></td>
                        <td style="text-align: center;">';
                        $marksArray = explode(',', $result->marks);
                        $totalMarks = array_sum($marksArray);
                        $totalSubjects = count($marksArray);
                        $maximumMarks = $totalSubjects * 100;
                        $percentage = ($totalMarks / $maximumMarks) * 100;
                        $html .= number_format($percentage, 2) . '%';
            
                       
                        $percentages = $allResults->map(function ($result) {
                            $marksArray = explode(',', $result->marks);
                            $totalMarks = array_sum($marksArray);
                            $totalSubjects = count($marksArray);
                            $maximumMarks = $totalSubjects * 100;
                            return ($totalMarks / $maximumMarks) * 100;
                        })->toArray();
            
                        rsort($percentages);
                        $position = array_search($percentage, $percentages);
                        $totalStudents = count($percentages);
                        $percentile = ($totalStudents - $position) / $totalStudents * 100;
                        
                     
                       
            
                        // Calculate percentage and add to HTML
            
            $html .= '</td>;
            
                        <td style="text-align: center;"><strong>Percentile:</strong></td>
                        <td style="text-align: center;">' . number_format($percentile, 2) . '%</td>
                          
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6">
                   
                    <div class="remarks">';
                
            
                    if ($percentage >= 85) {
                        $html .= '<p class="text-success">>Remarks: Congratulations! You\'ve secured first class. Your outstanding performance reflects your dedication and hard work. Keep up the excellent work!</p>';
                    } elseif ($percentage <= 35) {
                        $html .= '<p class="text-danger">Remarks:Remarks: Unfortunately, your performance falls below the passing criteria, indicating areas that need improvement. We encourage you to seek guidance and put in extra effort to excel in your studies.</p>';
                    } else {
                        $html .= ' You\'ve secured Second class. Your performance demonstrates a commendable effort, but there\'s still room for improvement. Keep striving for excellence!</p>';
                    }
            
                        // Add remarks based on percentage
                        
            
            $html .= '</div>
                </div>
            </div>';
    
    // Load HTML content into Dompdf
    
    $pdf->loadHtml($html);
    
    // Set paper size and orientation
    
    $pdf->setPaper('A4', 'portrait');
    
    // Render PDF
    
    $pdf->render();
    
    // Output PDF as a downloadable file
    
    $pdf->stream('result.pdf');

    
}


    
        
    public function form() {    
        $teachers = Teacher::all();
        $students = Student::all();
        $submit = "SUBMIT";
        $viewMode = false;
        $mode = "CREATE RESULT";
        return view('admin/resultsform', compact('mode','viewMode', 'submit', 'students','teachers'));
    }
    
        
    public function delete($id) {
        $results = Result::find($id);
        if (!is_null($results)) {
            echo '<script>';
            echo 'if (confirm("Are you sure you want to delete this result?")) {';
            echo '  window.location.href = "' . route('results.confirm-delete', ['id' => $id]) . '";';
            echo '} else {';
            echo '  window.location.href = "' . route('results') . '";'; // Redirect back to student list
            echo '}';
            echo '</script>';
            exit; 
        }
    
    }

    public function confirmDelete($id) {
        $results = Result::find($id);
        if (!is_null($results)) {
            $results->delete();
        }
        return redirect('admin/results');
    }
            
    
    public function edit($id) {
            $results = Result::find($id);
            if (is_null($results)) {
                return redirect()->back();
            } else {

                $id = "";
                $students = Student::all();
                $teachers = Teacher::all();
                $submit="UPDATE";
                $viewMode = false; 
                $mode = "EDIT RESULT";
                $data = compact("results","id","viewMode", "mode","submit","teachers","students");
                return view('admin/resultsform')->with($data);
            }
    }
        
    public function update($id, Request $request) {
        $result = Result::find($id);

        $result->stud_id = $request->input('stud_id');
        $result->teachers_id = $request->input('teachers_id');
        $marks = implode(',', $request->input('marks'));
        $result->marks = $marks;
        $result->exam_date = $request->input('exam_date');
        $result->status = $request->input('status_hidden'); 
        $result->save();
        return redirect('admin/results');
    }


    public function viewresult($id) {
            $results = Result::find($id);
            $students = Student::all();
            $teachers = Teacher::all();
            if (is_null($results)) {
                return redirect()->back();
            } else {
                $submit="OK";  
                $viewMode = true;               
                $mode = "RESULT DETAILS";
                $data = compact("results","viewMode", "mode","submit","teachers","students");
                return view('admin/resultsform')->with($data);
            }
    }
        
    public function search(Request $request) {
        $query = $request->input('query');
    
        // Perform search in your database based on the $query
        $resultdata =Result::with('students')
                            ->where('status', 'Active')
                            ->where(function ($queryBuilder) use ($query) {
                                $queryBuilder->orWhereHas('students', function ($studentQuery) use ($query) {
                                    $studentQuery->where('name', 'like', "%{$query}%")
                                                ->orWhere('photo', 'like', "%{$query}%")
                                                ->orWhere('marks', 'like', "%{$query}%")
                                                ->orWhere('subjects', 'like', "%{$query}%");
                                });
                            })
                            ->get();
                    
    
        return response()->json(['resultdata' => $resultdata]);
    }

}

