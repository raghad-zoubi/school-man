<?php

namespace App\Http\Controllers;

use App\Models\Class_students;
use App\Models\Subjects;
use App\Models\Subjects_class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $name)
    {
       /* $validator=Validator::make($request->all(),[
            'name'=>'required|max:50|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{*/
        $newuser=Subjects::create([
            'name'=>$name,
        ]);
        return response()->json($newuser,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'class'=>'required|max:191|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
        $class=Class_students::where('name',$request->input('class'))->first();
        if($class==null){
            return response()->json(['message'=>'wrong data'],400);
        }

        $all=Subjects_class::where('class_student_id',$class->id)->get();

        foreach($all as $one){
            $sub=Subjects::find($one->subject_id);
                $respon[]=([
                'id'=>$one->id,
                'name'=>$sub->name,
            ]);
        }
        if($respon==null){
            return response()->json(['message'=>'there are no subject'],400);
        }
        return response()->json($respon,200);
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects $subjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subjects)
    {
        //
    }
}
