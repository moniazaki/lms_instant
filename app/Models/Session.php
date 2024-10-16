<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_path',
        'course_id',
    ];


    protected $hidden = [

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
