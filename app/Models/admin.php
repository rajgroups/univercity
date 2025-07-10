<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class admin extends Authenticatable
{
    protected $table='admin';
    use HasFactory;

    protected $fillable = [
        'logo',
        'admin_sign',
        'volunteer_sign',
        'created_at',
        'updated_at'
    ];
}
