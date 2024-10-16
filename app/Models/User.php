<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship for the courses this user is instructing
    public function courses(){
        return $this->hasMany(Course::class, 'instructor_id');
    }

    // Relationship for the tasks this user (as an instructor) created
    public function tasks(){
        return $this->hasMany(Task::class, 'instructor_id');
    }

    // Relationship for the solutions submitted by this user (as a student)
    public function solutions(){
        return $this->hasMany(Solution::class, 'user_id');
    }

    // Many-to-Many relationship for the courses this user (as a student) is enrolled in
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }
}
