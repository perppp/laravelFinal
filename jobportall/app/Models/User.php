<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    // Relationship with applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // Relationship with jobs
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    // Relationship with roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}