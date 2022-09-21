<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AuthController as ControllersAuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherFactoryController;
use App\Http\Controllers\TeacherResourceController;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\TeacherResource;
use App\Jobs\CreateTeacherJob;
use App\Models\Classroom;
use App\Models\ClassroomType;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

// use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('classroom-type',function(Request $request){
    // return 'test123';
    // return $request->all();
    // ClassroomType::create($request->all());
    ClassroomType::create();
    return ClassroomType::all();
}); 




// TEACHERSSSSSSSSSSSSSS
// return list of teacher
// index
// Route::get('teacher',[TeacherController::class,'index
//old syntax
// Route::get('teacher',function(){
//     $data=Teacher::all();
//     return response()->json($data);
// });

// get specific teacher
// show()
// new syntax
// Route::get('teacher',[TeacherController::class,'show']);
// old syntax
// Route::get('teacher/{id}',function($id){
//     return Teacher::findOrFail($id);
// });

// add new teacher 
// store
// new syntax
// Route::post('teacher',[TeacherController::class,'store']);

// old syntax
// Route::post('teacher',function(Request $request){
//     // $request['secret']=Hash::make($request->secret);
//     Teacher::create($request->all());
//     $data=Teacher::all();

//     return response()->json($data);
// });

// update existing teacher 
// update
// new syntax
// Route::put('teacher',[TeacherController::class,'update']);

// old syntax
// Route::put('teacher/{id}',function($id,Request $request){
//     // select specific teacher
//     $teacher=Teacher::findOrFail($id);
//     // update hte info given in payload to that teacher
//     $teacher->update($request->all());
//     // return updated teacher info
//     return $teacher;
//     // dd($id,$request->all());
// });

// delete exisitng teacher
//destroy
// new syntax
// Route::delete('teacher',[TeacherController::class,'destroy']);

// old syntax
// Route::delete('teacher/{id}',function($id){
//     Teacher::findOrFail($id)->delete();
//     return response("Delete Teacher: ".$id,204);
// });


// fake teacher factory
// new syntax
Route::get('factory-teacher',TeacherFactoryController::class);

// old syntax
// Route::get('fake-teacher',function(){
//     // generate only
//     $generated=Teacher::factory(10)->upTheNameLol()->make();

//     //generate and save to db
//     // $generated=Teacher::factory()->create();
//     return $generated;
// });

// newest syntax using --r when making controller
Route::apiResource('teacher',TeacherResourceController::class)->except(['destroy']); // blacklist, cant access
// Route::apiResource('teacher',TeacherResourceController::class)->only(['destroy']); //whitelist, an access only


// Route::apiResource('teacher',TeacherResourceController::class)->middleware('auth:sanctum');  

Route::apiResource('teacher',TeacherResourceController::class);  


Route::post('teacher-login',[ControllersAuthController::class,'login']);
Route::post('teacher-logout',[ControllersAuthController::class,'logout'])->middleware('auth:sanctum');


//get user name 
Route:: get('auth',function(){
    // dd(Auth::user()->name);
})->middleware(['auth:sanctum','role:Administrator']);


// Route::get('teacher',[TeacherController::class,'show'])->middleware('auth:sanctum');

Route::get('permission-to-role',function(){
    $role=Role::findByName('Administrator');
    $role->givePermissionTo(['teacher:edit','teacher:delete']);
    return $role;
});

Route::get('permission-test',function(){
    return 'success';
})->middleware(['permission:teacher:edit|permission:teacher:delete']);


 Route::post(('middle-test'),function(Request $request ){
    return $request ->has('isAdmin');
 } )->middleware('is_admin');



//  Route::group(function (){
//     //specific route to exlcude middleware 
//     Route::get('/')->withoutMiddleware(['is_admin']);

//     // all other route will use 'is_admin'
//     Route::post('/');
//  })->middleware('is_admin');

Route::get('get-all-teachers',function(){
    $teachers=Teacher::all();
    return response()->json(TeacherResource::collection($teachers));
});


Route::get('one-teacher',function(){
    $teacher=Teacher::first();
    $teacher['pass_data']="this pass data";
    return response()->json(new TeacherResource($teacher));
});


Route::apiResource('classroom',ClassroomController::class)->middleware('auth:sanctum');

//search classroom route
Route::post('classroom/search',function(Request $request){
    $request->validate([
        'teacher_id'=>'exists:teachers,id',
        'type_name'=>'string',
        'search_topic'=>'string|min:3',
        'search_teacher_name'=>'string',
    ]);
    

    $collection = Classroom::query()
        ->when($request->teacher_id, function($q) use ($request) {
            $q->where('teacher_id', $request->teacher_id);
        })
        ->when($request->type_name, function($q) use ($request){
            // using relation to query
            $q->whereHas('classroomType', function($q) use ($request) {
                $q->where('type', $request->type_name);
            });
        })
        ->when($request->search_topic, function($q) use ($request) {
            $q->where('name', 'like',  "%$request->search_topic%");
        })
        ->when($request->search_teacher_name, function($q) use ($request) {
            $q->whereHas('teacher', function($q) use ($request) {
                $q->where('name', 'like', "%$request->search_teacher_name%");
            });
        })
        ->get();

        return ClassroomResource::collection($collection);
});


Route::get('execute-job',function (){

    CreateTeacherJob::dispatch("kucing")->delay(now()->addMinutes(1));
    CreateTeacherJob::dispatch("meow")->delay(now()->addMinutes(1));
    CreateTeacherJob::dispatch("woof")->delay(now()->addMinutes(1));
    
    
    return 'successful';
});


Route::get('mailtrap-inboxes',function(){
    //store the account id and token in .env
    // after that store in services.php
    $account_id=config('services.mailtrap.account_id');
    $baseURL="https://mailtrap.io/api";
    $url="/accounts/" .$account_id . "/inboxes";
    $response=Http::acceptJson()->withHeaders([
        'Api-Token'=>config('services.mailtrap.token')
    ])->get($baseURL.$url);
// dd($baseURL.$url);
    if($response->successful()){
        // return $response->collect();
        return $response->collect()->pluck('project_id');
    }
    return response()->json('something wrong',409);
});

