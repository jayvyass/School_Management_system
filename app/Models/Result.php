<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $table = "results";
    protected $primaryKey = "results_id";

    public function students() {
            
        return $this->belongsTo( Student::class, 'stud_id', 'stud_id');
    }
    public function teachers() {
            
        return $this->belongsTo( Teacher::class, 'teachers_id', 'teachers_id');
    }
}
