<?php

namespace Database\Seeders;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = ['math', 'physics', 'economics', 'biology', 'chemistry','English'];

        $faker = Faker::create();
        for ($i = 1; $i <=100; $i++) {
            $student = new Student;
            $fakerImage = $faker->image(public_path('admin/images'), 200, 200, 'subjects', false); 
            $student->photo ='images/' . $fakerImage;
            $student->document ='images/' . $fakerImage;
            $student->name = $faker->name;
            $student->email = $faker->email;
            $student->gender = $faker->randomElement(['male', 'female']);
            $student->grade = $faker->numberBetween(1, 12);
            $student->guardian_name = $faker->name;
            $student->contact_no = $faker->phoneNumber();
            $startDate = '2022-01-01';
            $endDate = '2022-12-31';
            $student->dob = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
            
            $student->status = 'Active';
            
            // Randomly select subjects and join them into a comma-separated string
            $selectedSubjects = $faker->randomElements($subjects, $faker->numberBetween(1, count($subjects)));
            $student->subjects = implode(',', $selectedSubjects);
            
            $student->save();
        }
    }
}
