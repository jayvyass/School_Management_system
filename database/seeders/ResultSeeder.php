<?php
namespace Database\Seeders;

use App\Models\Result;
use App\Models\Student;
use App\Models\Teacher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Loop to create 5 results
        for ($i = 1; $i <= 150; $i++) {
            $result = new Result();
            $student = Student::inRandomOrder()->first();

            if ($student) {
                $result->stud_id = $student->stud_id;
                $selectedSubjects = explode(',', $student->subjects);
                $marksArray = [];
                foreach ($selectedSubjects as $subject) {
                    $marksArray[] = $faker->numberBetween(70, 100); // Generate random marks for each subject
                }
                $result->marks = implode(',', $marksArray);
                $result->exam_date = $faker->date();
                $teacher = Teacher::inRandomOrder()->first();
                if ($teacher) {
                    $result->teachers_id = $teacher->teachers_id;
                }
                $result->status = 'Active';
                $result->save();
            }
        }
    }
}
