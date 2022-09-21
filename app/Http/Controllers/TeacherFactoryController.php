<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherFactoryController extends Controller
{
    //
    // private $var;
    // public function __construct()
    // {
    //     $this->var="Initialise variable";
    // }
    public function __invoke()
    {
        // generate only
    $generated=Teacher::factory()->upTheNameLol()->make();

    //generate and save to db
    // $generated=Teacher::factory()->create();
    return $generated;
    }
}
