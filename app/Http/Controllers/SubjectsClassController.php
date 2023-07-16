<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
use App\Http\Controllers\SubjectsController;
use App\Models\Class_students;
use App\Models\Subjects;
=======

use App\Models\Section_ads;
use App\Models\Section_student;
>>>>>>> 42231069c138dd2b54d030622428f18629ccb4f5
use App\Models\Subjects_class;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectsClassController extends Controller
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
    public function show_student()
    {

        $result2= DB::table('section_students')//'Subjects_class')
            ->join('sections', 'section_students.sections_id', '=', 'sections.id')
            ->join('subjects_classes','sections.class_student_id','=','subjects_classes.class_student_id')
            ->join('subjects','subjects_classes.subject_id','=','subjects.id')
            ->where('section_students.students_id','=',auth()->user()->id)
            ->select('subjects.*')
            ->get();


        return response()->json([
            'result' => $result2,
            'statusCode'=>200

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'class'=>'required|max:50|string',
            'subject'=>'required|max:50|string',
            'lowMark'=>'required|max:191|integer',
            'highMark'=>'required|max:191|integer',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $low=$request->input('lowMark');
            $high=$request->input('highMark');
            if($low >= $high){
                return response()->json(['message'=>'wrong data'],400);
            }

            $class=Class_students::where('name',$request->input('class'))->first();
            if($class==null){
                return response()->json(['message'=>'wrong data'],400);
            }

            $subject=Subjects::where('name',$request->input('subject'))->first();
            if($subject==null){
                $SubjectsController=new SubjectsController();
                $SubjectsController->create($request->input('subject'));
                $subject=Subjects::where('name',$request->input('subject'))->first();
            }

            $new=Subjects_class::create([
                'class_student_id'=>$class->id,
                'subject_id'=>$subject->id,
                'highMark'=>$high,
                'lowMark'=>$low,
            ]);
            return response()->json($new,200);
        }
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
     * @param  \App\Models\Subjects_class  $subjects_class
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects_class $subjects_class)  //( request ....)
    {
        $all_sub=Subjects_class::all();
        $respon=null;
        foreach($all_sub as $one){
            $class=Class_students::find($one->class_student_id);
            $subject=Subjects::find($one->subject_id);
            $respon[]=([
                'class'=>$class->name,
                'subject'=>$subject->name,
                'highMark'=>$one->highMark,
                'lowMark'=>$one->lowMark,
            ]);
        }
        if($respon==null){
            return response()->json(['message'=>'ليس هنالك مقررات مضافة'],400);
        }
        return response()->json($respon);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjects_class  $subjects_class
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects_class $subjects_class)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subjects_class  $subjects_class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects_class $subjects_class)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subjects_class  $subjects_class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $subjectclass=Subjects_class::find($request->subjectclass_id);
        if($subjectclass==null){
            return response()->json('error section not fond',400);
        }
        Subjects_class::destroy($subjectclass->id);
        return response()->json('subject_class deleted successfully',200);
    }
}
