<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


// store list of teacher 
class Teacher extends User
{
    use HasFactory, HasApiTokens,HasRoles;
    protected $fillable=[
        'name',
        'secret',

    ];

    protected $hidden=[
        'password',
        'remember_token'
    ];
    protected $appends=[
        'name_upper'
    ];

    //mutator function 
        public function setSecretAttribute($value){
            $this->attributes['secret']=Hash::make($value);
        }

    public function getNameUpperAttribute(){
        return strtoupper($this->name);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function profile(){
        return $this->morphOne(Profile::class,'profileable');
    }
}
