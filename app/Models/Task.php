<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'instructor_id',
        'session_id',
    ];


    protected $hidden = [

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function Session(){
        return $this->belongsTo(Session::class);
    }

    public function Instructor(){
        return $this->belongsTo(User::class,'instructor_id');
    }
    public function solutions(){
        return $this->hasMany(Solution::class);
    }
}
