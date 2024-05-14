<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 27; $i++) {
            $teacher = new Teacher();
            $teacher->name = $faker->name;
            $teacher->email = $faker->email;
             $fakerImage = $faker->image(public_path('admin/images'), 200, 200, 'profile', false);
            $teacher->photo = 'images/' . $fakerImage;
            $teacher->designation = $faker->randomElement(['Professor', 'Lecturer', 'Assistant Professor']);
            $teacher->contact_no = $faker->phoneNumber();
            $startDate = '2024-01-01';
            $endDate = '2024-12-31';
            $teacher->joined_date = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
            $teacher->status ='Active';
            
            // Select 1 or 2 subjects randomly
            $selectedSubjects = $faker->randomElements(['Maths', 'Physics', 'Economics', 'Biology', 'Chemistry', 'English'], $faker->numberBetween(1, 2));
            $teacher->subject = implode(',', $selectedSubjects);
            $teacher->save();
        }
    }
}

