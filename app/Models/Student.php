<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // sebenernya gk butuh krn bisa detect, tapi tetep ku bikin aja utk practice 
    protected $table = 'students';
    protected $primaryKey = 'id';

    // sblm bisa pake insert update dgn eloquent butuh declare fillable dulu disini
    protected $fillable = [
        'name', 'gender', 'nis', 'class_id'
    ];
}
