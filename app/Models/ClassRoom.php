<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $table = 'class';

    public function students()
    {
        // kali ini nama foreign key kita beda jadi harus ditulis, krn yg dia pikir itu class_room_id bukan class_id
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}
