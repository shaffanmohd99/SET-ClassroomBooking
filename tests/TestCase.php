<?php

namespace Tests;

use App\Jobs\CreateTeacherJob;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Queue;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    public function getTeacherData(){
        return Teacher::factory()->make()->toArray();
    }

    public function test_job_run()
    {
        Queue::fake();
        $this->getJson('execute-json')->assertStatus(200);

        //check job is called 
        Queue::assertPushed( CreateTeacherJob::class);
    }
}
