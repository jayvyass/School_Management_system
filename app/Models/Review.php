<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'profession', 'description'];

    protected $table = "reviews";
    protected $primaryKey = "reviews_id";
}
