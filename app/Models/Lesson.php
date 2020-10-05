<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @param $lessons
     * @param $lesson_id
     * @return bool
     */
    public function getLessonByIdFromCollection($lessons, $lesson_id)
    {
        if (!empty($lessons))
            foreach ($lessons as $lesson) {
                if ($lesson->id === $lesson_id){
                    return $lesson->pivot->rating;
                }
            }
        return false;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_lessons');
    }
}
