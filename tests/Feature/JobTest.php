<?php

namespace Tests\Feature;

use App\Jobs\CreateTeacherJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class JobTest extends TestCase
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

    public function test_job_run()
    {
        Queue::fake();
        $this->getJson('api/execute-job')->assertStatus(200);

        //check job is called 
        Queue::assertPushed( CreateTeacherJob::class,1);
    }
}
