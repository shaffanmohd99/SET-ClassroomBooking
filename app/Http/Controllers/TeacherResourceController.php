<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Notifications\SuccessRegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

// use Illuminate\Notifications\Notification;

class TeacherResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data=Teacher::all();
        Log::channel('mylog')->info($request->ip(). "retrive list of teacher");

        return response()->json(TeacherResource::collection($data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTeacherRequest $request)
    {
        //
        $teacher=Teacher::create($request->all());

        // $teacher->assignRole('Administrator');
    // $data=Teacher::all();

    Notification::route('mail',"shaffan1022@gmail.com")
    ->notify(new SuccessRegisterNotification($teacher));    

    return response()->json($teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return Teacher::findOrFail($id);
        
        $teacher=Teacher::findOrFail($id);
        $this-> authorize('view', $teacher);
        return $teacher;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    //     $teacher=Teacher::findOrFail($id);
    // // update hte info given in payload to that teacher
    // $teacher->update($request->all());
    // // return updated teacher info
    // return $teacher;
    // }
    public function update(Request $request, $id)
    {
        //
        $data=$request->validate(
            ['name'=>'string|required'],
            ['name.required'=>'testing134']
        );
        $teacher=Teacher::findOrFail($id);
    // update hte info given in payload to that teacher
    // $teacher->update($request->all());
    // return updated teacher info
    return tap($teacher)->update($request->all()) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Teacher::findOrFail($id)->delete();
        return response("Delete Teacher: ".$id,204);
    }

    
}
