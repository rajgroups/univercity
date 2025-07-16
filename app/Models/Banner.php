<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

   protected $table = 'banner'; // explicitly define table name

    protected $fillable = ['title', 'image', 'link', 'description', 'status'];
}
