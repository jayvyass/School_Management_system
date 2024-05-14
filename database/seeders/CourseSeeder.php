<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $subjects = ["Algebra", "Calculus", "Physics I", "Chemistry I", "World History", "Geography", "English Literature", "Introduction to Programming", "Microeconomics", "Psychology", "Sociology", "Philosophy", "Art History", "Music Theory", "Physical Education"];

        for ($i = 1; $i <= 60; $i++) {
            $course = new Course();
            $course->course_name = $faker->randomElement($subjects); 
            $course->semester = $faker->randomElement(['fall', 'spring', 'summer']);
            $course->credits = $faker->numberBetween(1, 5); 
            $course->status = 'Active';
            $teacher = Teacher::inRandomOrder()->first();
            $course->teachers_id = $teacher->teachers_id;
            
            $course->save();
        }
    }
}
