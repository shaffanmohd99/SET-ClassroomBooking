<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return only class belong to me (as a teacher)
        $myClass=Auth::user()->classrooms;

        // $data=Classroom::all();
        return ClassroomResource::collection($myClass);
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
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        // $class=Auth::user()->classrooms()->create($request->all());

        
        

        $class=Auth::user()->classrooms()->create($request->except('uri'));

        //check exist 
        if($request->has('uri')){
            //create attachemt using class instance 
            $class->attachment()->create($request->only('uri'));  
        }

        return new ClassroomResource($class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    //    return $classroom;
            if($classroom->teacher_id==Auth::id()){
                return new ClassroomResource($classroom);
            }
            abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        //
        // return tap($classroom)->update($request->all());
        // $class=Auth::user()->classrooms()->where('id',$classroom->id)->first()->update($request->all());

        if($classroom->teacher_id == Auth::id()){

            $classroom->update($request->except('uri'));
        
            // check payload has uri
            if($request->has('uri')){
                //update or crate uri 
                // $classroom->attachment()->updateOrCreate($request->only('uri'));

                $classroom->attachment()->update(
                    $request->only('uri')
                );
            }
            
            return new ClassroomResource($classroom);
        }
        
        abort(403);

        // $class = Classroom::findOrfail($classroom);    
        // return new ClassroomResource($class);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
        // $classroom->delete();
        if($classroom->teacher_id==Auth::id()){
            $classroom->delete();
            return response()->json(null,204);
        }
        abort(403);
    }
}
