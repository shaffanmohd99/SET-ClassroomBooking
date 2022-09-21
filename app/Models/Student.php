<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//store list of student 
class Student extends Model
{
    
    use HasFactory;
    protected $fillable=[
        'name',
        'password',
    ];
    protected $hidden=[
        'password',
        'remember_token'
    ];

    public function profile(){
        return $this->morphOne(Profile::class,'profileable');
    }
}
