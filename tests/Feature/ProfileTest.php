<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_tedfr_can_create_profile(){
        $teacher=Teacher::factory()->create();

        $teacher->profile()->create([
            'fullname'=>'Teacher A',
            'dob'=>now()->subYears(20)->toDateString()
        ]);

        $this->assertDatabaseHas(Profile::class,[
            'profileable_id'=>$teacher->id,
            'fullname'=>'Teacher A',
            'dob'=>now()->subYears(20)->toDateString()
        ]);
        
    }

    public function test_student_can_create_profile(){
        $student=Student::factory()->create();

        $student->profile()->create([
            'fullname'=>'student A',
            'dob'=>now()->subYears(20)->toDateString()
        ]);
        $this->assertDatabaseHas(Profile::class,[
            'profileable_id'=>$student->id,
            'fullname'=>'student A',
            'dob'=>now()->subYears(20)->toDateString()
        ]);
    }
}
