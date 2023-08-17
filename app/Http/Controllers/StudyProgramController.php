<?php

namespace App\Http\Controllers;

use App\Models\Class_students;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use App\Models\Section_ads;
use App\Models\Subjects_class;
use Illuminate\Support\Facades\DB;
use App\Models\Section_student;
use App\Models\Sections;
use App\Models\Study_program;
use App\Models\Subjects;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{

    public function index()
    {
        //
    }
    public function show_student()
    {
        $result2= DB::table('section_students')
        ->join('sections', 'section_students.sections_id', '=', 'sections.id')
        ->join('study_programs','sections.id','=','study_programs.section_id')
        ->join('subjects','study_programs.subject_id','=','subjects.id')
        ->where('section_students.students_id','=',auth()->user()->id)
        ->select('study_programs.session','study_programs.day','study_programs.id','subjects.name')
        ->get();



        return response()->json(
        $result2


        );

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
            'section'=>'required|max:50|string',
            'gender'=>'required|max:50|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $class=$request->input('class');
            $clas=Class_students::where('name',$class)->first();
            if($clas==null){
                return response()->json(['message'=>'wrong data'],400);
            }

            $section=Sections::where('name',$request->input('section'))->where('class_student_id',$clas->id)->where('gender',$request->input('gender'))->first();
            if($section==null){
                return response()->json(['message'=>'wrong data'],400);
            }



            $data=$request->programdata;
            if($data!=null)
            {
          //      $section=json_decode($request['sections'],true);
                foreach ($data as $s)
                {
                    $sub=Subjects::where('name','like','%'.$s->subject.'%');
                    $emp=Employee::where('name','like','%'.$s->teacher);
                    $new=Study_program::create([
                        'section_id'=>$section->id,
                        'day'=>$s->day,
                        'period'=>$s->time,
                        'employee_id'=>$emp->id,
                        'subject_id'=>$sub->id,
                    ]);

            }
        }
        else{
            return response()->json(['message'=>'wrong data '],400);
        }
        return response()->json('program added to section successfully',200);

        }
    }







    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Study_program  $study_program
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'class'=>'required|max:50|string',
            'section'=>'required|max:50|string',
            'gender'=>'required|max:50|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $class=$request->input('class');
            $clas=Class_students::where('name',$class)->first();
            if($clas==null){
                return response()->json(['message'=>'wrong data'],400);
            }

            $section=Sections::where('name',$request->input('section'))->where('class_student_id',$clas->id)->where('gender',$request->input('gender'))->first();
            if($section==null){
                return response()->json(['message'=>'wrong data'],400);
            }

            $all_pro= $section->study_program;
            $respon=null;
            foreach($all_pro as $one){
                $emp=$one->employee;
                $sub=$one->subject;
                $respon[]=([
                    'id'=>$one->id,
                    'day'=>$one->day,
                    'time'=>$one->period,
                    'section_id'=>$one->section_id,
                    'teacher'=>$emp->name,
                    'subject'=>$sub->name,
                ]);
        }

        if($respon==null){      ///if null send null?.......?
            return response()->json(['message'=>'ليس  مضاف'],400);
        }
        return response()->json($respon);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Study_program  $study_program
     * @return \Illuminate\Http\Response
     */
    public function edit(Study_program $study_program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Study_program  $study_program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Study_program $study_program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Study_program  $study_program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $section=Sections::find($request->section_id);
        $all_pro= $section->study_program;
        foreach($all_pro as $one){
            Study_program::destroy($one->id);
        }
        return response()->json('program deleted successfully',200);
    }
}
