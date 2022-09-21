<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $guarded=[
        'teacher_id',
        // 'type_id'
    ];

    // protected $casts=[
    //     "date"=>
    // ];
public function teacher(){
    return $this->belongsTo(Teacher::class);
}

    public function classroomType(){
        return $this->belongsTo(ClassroomType::class,'type_id');
    }
   
    public function attachment(){
        return $this->hasOne(Attachment::class);
    }
}
