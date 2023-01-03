<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    // sebenernya gk butuh krn bisa detect, tapi tetep ku bikin aja utk practice 
    protected $table = 'students';
    protected $primaryKey = 'id';

    // sblm bisa pake insert update dgn eloquent butuh declare fillable dulu disini
    protected $fillable = [
        'name', 'gender', 'nis', 'class_id', 'image'
    ];


    public function class()
    {
        // sebenernya kalo dah ikutin naming nya gk perlu di input parameter foreign key ama owner key nya
        // seperti yg kali ini, tapi tetep aku tulis aja
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
    }

    public function extracurriculars()
    {
        return $this->belongsToMany(Extracurricular::class, 'student_extracurricular', 'student_id', 'extracurricular_id');
    }
}
