<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomType extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'type'
    ];
    protected $appends=[
        'uppercase_type'
    ];
    // protected $hidden=[
    //     'id'
    // ];

    public function getUppercaseTypeAttribute()
    {
        return strtoupper($this->type);
    }

//     public function getWhateverAttribute()
//     {
//         return ucwords($this->email);
//     }

    protected $attributes=[
        'type'=>'woofwoof'
    ];
}
