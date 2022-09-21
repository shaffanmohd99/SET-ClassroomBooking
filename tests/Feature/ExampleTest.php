<?php

namespace Tests\Feature;

use App\Models\ClassroomType;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_dispatch_create_teacher_job()
    {
        $this->getJson(('execute-job'))->assertJson(200);
    }
}
