<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable=[
        'uri'
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
