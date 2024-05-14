<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Teacher;
use App\Models\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            $attendance = new Attendance();
            $attendance->stud_id =  Student::inRandomOrder()->first()->stud_id; // Assuming you have 100 students
            $attendance->status = 'present';
            $attendance->month = $faker->monthName();
            $attendance->teachers_id = Teacher::inRandomOrder()->first()->teachers_id;
            $attendance->save();
        }
    }
}
