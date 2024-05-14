<!-- result.blade.php -->
@extends('frontend/front')
@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->name }}'s Result</title>
    <style>
        /* Add custom CSS styles for better presentation */
        body {
            font-family: Arial, sans-serif;
            background-image:{{asset('img/resultimage.jpg')}}; /* Add your background image URL here */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .letter-pad {
            border: 2px solid #000;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fff; /* Set the background color for the letter pad */
            opacity: 0.9; /* Adjust opacity as needed */
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
</head>
<body>
<div class="container">
        <div class="letter-pad">
            <div class="card">
                <div class="card-header">{{ $student->name }}'s Result</div>
                <div class="card-body">
                    <div class="student-info">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('admin/'.$student->photo) }}" alt="Student Photo" class="student-photo">
                            </div>
                            <div class="col-md-6">
                                <h2>Divine Life International School</h2>
                                <p>Karma Complex Ahmedabad, Gujarat, India</p>
                            </div>
                            <div class="col-md-2">
                                <img src="{{ asset('img/logos/logo2.png') }}" alt="Student Photo" class="student-photo">
                            </div>
                            <div class="col-md-6">
                                <h5>{{ $student->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" >
                                <tbody>
                                <tr>
                                        <td style="text-align: center;"><strong>Name:</strong></td>
                                        <td style="text-align: center;">{{ $student->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;"><strong>Exam Date:</strong></td>
                                        <td style="text-align: center;">{{ $result->exam_date }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;"><strong>Standard:</strong></td>
                                        <td style="text-align: center;">{{ $student->grade }}</td>
                                    </tr>
                                    </table>
                                    <tr>
                                        <td colspan="3" style="text-align: center;">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Subjects</th>
                                                        <th style="text-align: center;">Marks(100)</th>
                                                        <th style="text-align: center;">Grade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            @php
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
                                                    @endphp

                                            @foreach($subjects as $index => $subject)
                                                <tr>
                                                    <td style="text-align: center;">{{ $subject }}</td>
                                                    <td style="text-align: center;">
                                                        @if(isset($marks[$index]))
                                                            {{ $marks[$index] }}
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center;"> 
                                                        @php                           
                                                            $grade = calculateMarks($marks[$index]); 
                                                            echo $grade;
                                                            
                                                        @endphp
                                                    </td>
                                                </tr>
                                                    
                                                @php
                                                    // Calculate total marks
                                                    if(isset($marks[$index])) {
                                                        $totalMarks += intval($marks[$index]);
                                                    }
                                                @endphp
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Your existing table goes here -->
                                    <table  class="table table-bordered">
                                        <tr>
                                            <td style="text-align: center;"><strong>Total Marks:</strong></td>
                                            <td style="text-align: center;">{{ $totalMarks }}</td>                                                                                        
                                            <td style="text-align: center;"><strong>Percentage:</strong></td>
                                            <td style="text-align: center;">
                                                @php
                                                    // Split comma-separated marks into an array
                                                    $marksArray = explode(',', $result->marks);                                                   
                                                    // Calculate total marks
                                                    $totalMarks = array_sum($marksArray);                                                  
                                                    // Assuming each subject is out of 100 marks
                                                    $totalSubjects = count($marksArray);
                                                    $maximumMarks = $totalSubjects * 100;                                                   
                                                    // Calculate percentage
                                                    $percentage = ($totalMarks / $maximumMarks) * 100;                                                   
                                                    // Display percentage with two decimal places
                                                        echo number_format($percentage, 2) . '%';                                                    
                                                    $percentages = $allResults->map(function ($result) {
                                                        $marksArray = explode(',', $result->marks);
                                                        $totalMarks = array_sum($marksArray);
                                                        $totalSubjects = count($marksArray);
                                                        $maximumMarks = $totalSubjects * 100;
                                                        return ($totalMarks / $maximumMarks) * 100;
                                                    })->toArray();

                                                // Sort the percentages in descending order
                                                rsort($percentages);

                                                // Find the position of the current student's percentage
                                                $position = array_search($percentage, $percentages);

                                                // Calculate the percentile
                                                $totalStudents = count($percentages);
                                                
                                                $percentile = ($totalStudents - $position) / $totalStudents * 100;
                                            @endphp
                                            </td>
                                            <td style="text-align: center;"><strong>Percentile:</strong></td>
                                            <td style="text-align: center;">{{ number_format($percentile, 2) }}%</td>                                                                                                                                                                                  
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </tbody>                            
                        <div class="row">
                        <div class="col-md-6">                                  
                            <div class="remarks">
                            @if ($percentage >= 85)
                                    <p class="text-success">Remarks: Congratulations! You've secured first class. Your outstanding performance reflects your dedication and hard work. Keep up the excellent work!</p>
                                @elseif ($percentage <= 35)
                                    <p class="text-danger">Remarks: Unfortunately, your performance falls below the passing criteria, indicating areas that need improvement. We encourage you to seek guidance and put in extra effort to excel in your studies.</p>
                                @else
                                    <p class="text-info">Remarks: You've secured Second class. Your performance demonstrates a commendable effort, but there's still room for improvement. Keep striving for excellence!</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <!-- Image -->
                            <img src="{{ asset('img/small-logos/sign.jpg') }}" alt="Student Photo" class="student-photo">
                        </div>
                    </div>
            </div>
            <hr>
            <div class="download-btn">
                <a href="{{ route('download-pdf', $student->stud_id) }}" class="btn btn-primary">Download Result</a>
            </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
