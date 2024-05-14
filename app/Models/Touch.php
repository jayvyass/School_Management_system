<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Touch extends Model
{
    use HasFactory;
    protected $table = "intouch";
    protected $primaryKey = "id";
}
