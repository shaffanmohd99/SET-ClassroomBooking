<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //

   
    public function index()
    {
        $data=Teacher::all();
        return response()->json($data);
    }


    public function show($id)
    {
        // return Teacher::findOrFail($id);

        $teacher=Teacher::findOrFail9($id);
        $this-> authorize('view', $teacher);
        return $teacher;
    }


    public function store(Request $request){
         // $request['secret']=Hash::make($request->secret);
    Teacher::create($request->all());
    $data=Teacher::all();

    return response()->json($data);
    }


    public function update($id,Request $request)
    {
         // select specific teacher
    $teacher=Teacher::findOrFail($id);
    // update hte info given in payload to that teacher
    $teacher->update($request->all());
    // return updated teacher info
    return $teacher;
    // dd($id,$request->all());
    }

    public function destroy($id){
        Teacher::findOrFail($id)->delete();
    return response("Delete Teacher: ".$id,204);
    }
}
