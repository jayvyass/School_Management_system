<?php

namespace App\Models;
use  App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = "teachers";
    protected $primaryKey = "teachers_id";

    public function courses()
    {
        return $this->hasMany(Course::class, 'teachers_id', 'teachers_id');
        
    }
  
   
}
