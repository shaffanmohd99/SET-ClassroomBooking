<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class MailtrapTest extends TestCase
{
    public function setUp():void{
        parent::setUp();
        Http::fake([ //*is wildcart,accept everything after that  
            
            'https://mailtrap.io/api/*'=>Http::response([
                [
                    "project_id"=>1392870
                ]
                ],200)
        ]);
    }


    public function test_mailtrap_return_project_id()
    {
        $this->getJson('api/mailtrap-inboxes')
        ->assertJson([
            ['project_id'=>1392870]
        ]);
    }
}
