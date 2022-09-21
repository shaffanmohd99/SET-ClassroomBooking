<?php

namespace Tests\Feature\Teacher;

use App\Http\Requests\AddTeacherRequest;
use App\Models\ClassroomType;
use App\Models\Teacher;
use App\Notifications\SuccessRegisterNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function checkInput($payLoad):bool
    {
        return Validator::make(
            // payload
            $payLoad,
            // extract rules from class
            (new AddTeacherRequest())->rules())
            // stop onfirst fail
            ->stopOnFirstFailure()
            // true if validation pass
            ->passes();
    }


    public function test_all_validation(){
        $this->assertEquals($this->checkInput([
            [
                'name'=>'1232445',
                'secret' => 'password123'
            ]
            ]),false);

            $this->assertEquals($this->checkInput([
                [
                    'name'=>'1232445',
                    'secret' => ''
                ]
                ]),false);
    }



    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_get_teacher_list()
    {
        // make request
        $respone=$this->getJson('api/teacher');

        // to check respone
        $respone->assertStatus(200);
        // 
        // ->assertJson([
        //     [
        //             "id"=> 10,
        //     "name"=> "Sio Ku Lien",
        //     "secret"=> "$2y$10$Mxkw1txLbGgmz48GE7JtZ.Sp5A1/WYgykl5zQMHRE5K0up4yA0d..",
        //     "created_at"=> "2022-09-09T07:27:17.000000Z",
        //     "updated_at"=> "2022-09-09T07:27"
        //     ]
        // ]);

        // $this->assertDatabaseHas(ClassroomType::class,[
        //     'id'=>1,
        //     'type'=>'live'
        // ]);

        


        
                //intialiase test with whatever variable
    }
    // call everything each test method 
    public function setUp():void{
        parent::setUp();
        
        // using token
        $teacher=Teacher::factory()->create([
            'name'=>'hallo',
            'secret'=>'password123'
        ]);
        Sanctum::actingAs($teacher);

        // $teacher->assignRole('Administrator');
    }


    public function test_auth_route(){
        $this->getJson(('api/auth'))->assertStatus(200);
    }

    // call once onlu
    // public function setUpBeforeClass(){
        
    // }
    public function test_can_register_teacher()
    {
        Notification::fake();
        // normal way
        // $teacher=Teacher::factory()->make();

        $name=$this->faker->name;
        $respone=$this->postJson('api/teacher',[
            'name'=>$name,
            'secret'=>"qwrwerwerwe"
        ])->assertOk();
        
        //
        // $respone=$this->postJson('api/teacher',[
        //     'name'=>$teacher ['name'],
        //     'secret'=>'yeyeyeyeeyey'
        // ]);
        
        $respone->assertOk();

        $this->assertDatabaseHas(Teacher::class,[
            'name'=>$name,
        ]);

        //assert using model
        // Notification::assertNotSentTo($teacher,SuccessRegisterNotification::class,1);

        //assert using random user 
        Notification::assertSentTo(new AnonymousNotifiable,SuccessRegisterNotification::class,1);
    }
    public function test_add_teacher_validation_fail()
    {
        $respone=$this->postJson('api/teacher',[
            'name'=>123,
            'secret'=>'dfdff'
        ]);
        $respone->assertStatus(422)
        // ->assertJson([
        //         "message"=> "The given data was invalid.",
        //         "errors"=> [
        //             "name"=> [
        //                 "The name must be a string."
        //             ]
        //         ]
        //     ])
            ;
    }

    public function test_permission_route()
    {
        $this->getJson('api/permission-test')->assertStatus(200);
    }


}


