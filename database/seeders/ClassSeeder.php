<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Teacher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 52; $i++) {
            $classes = new Classes();
            $subjects = ["Algebra", "Calculus", "Physics I", "Chemistry I", "World History", "Geography", "English Literature", "Introduction to Programming", "Microeconomics", "Psychology", "Sociology", "Philosophy", "Art History", "Music Theory", "Physical Education"];
            
            $classes->subject = $faker->randomElement($subjects); // Example data generation for subject
            $fakerImage = $faker->image(public_path('admin/images'), 200, 200, 'subjects', false); // Generate a random image and save it locally
            $classes->subject_photo = 'images/' . $fakerImage; // Set the path to the saved image in your database field
            $classes->age_group = $faker->randomElement(['child', 'adult' ,'teenager']); // Example data generation for age_group
            $classes->teachers_id = Teacher::inRandomOrder()->first()->teachers_id; // Example data generation for teachers_id
            $classes->time_duration = $faker->randomElement(['1_hour', '2_hour', '3_hour']); // Example data generation for time_duration
            $classes->capacity = $faker->randomElement([20, 30, 40]); // Example data generation for capacity
            $classes->status = 'Active'; // Example data generation for status
            $classes->save();
        }
    }
}
