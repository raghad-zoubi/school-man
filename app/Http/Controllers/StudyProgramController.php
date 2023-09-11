<?php

namespace App\Http\Controllers;

use App\Models\Class_students;
use App\Models\Employee;
use App\Models\Section_ads;
use App\Models\Sections;
use App\Models\Subjects;
use App\Models\Subjects_class;
use Illuminate\Support\Facades\DB;
use App\Models\Study_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudyProgramController extends Controller
{


    public function show_student()
    {
        $result2=   $result2= DB::table('students')
            //  ->join('sections', 'students.sections_id', '=', 'sections.id')
            ->join('study_programs','students.section_id','=','study_programs.section_id')
            ->join('subjects','study_programs.subject_id','=','subjects.id')
            ->where('students.id','=',auth()->user()->id)
            ->orderBy('study_programs.updated_at', 'desc')
            ->select('study_programs.period','study_programs.day','study_programs.id','subjects.name')//,$lastUpdate)
            ->get();

        return response()->json(
            $result2

        );

    }



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
                return response()->json(['message'=>'wrong data class'],400);
            }

            $section=Sections::where('name',$request->input('section'))->where('class_student_id',$clas->id)->where('gender',$request->input('gender'))->first();
            if($section==null){
                return response()->json(['message'=>'wrong data section'],400);
            }



            $data=$request->programdata;
            if($data!=null)
            {
                //      $section=json_decode($request['sections'],true);
                foreach ($data as $s)
                {

                    $sub=Subjects::where('name','like','%'.$s['subject'].'%')->first();
                    if($sub==null)
                    {
                        return response()->json(['message'=>'wrong subject'],400);
                    }
                    $emp=Employee::where('name','like','%'.$s['teacher'])->where('status',1)->first();
                    if($emp==null)
                    {
                        return response()->json(['message'=>'wrong employee'],400);
                    }
                    $old=Study_program::where('section_id',$section->id)->where('period',$s['time'])->where('day',$s['day'])->first();
                    if($old!=null){
                        $old->employee_id=$emp->id;
                        $old->subject_id=$sub->id;
                        $old->save();
                    }
                    else{
                        $new=Study_program::create([
                            'section_id'=>$section->id,
                            'day'=>$s['day'],

                            'period'=>$s['time'],
                            'employee_id'=>$emp->id,
                            'subject_id'=>$sub->id,
                        ]);}

                }
            }
            else{
                return response()->json(['message'=>'wrong data '],400);
            }
            return response()->json(['message'=>'program added to section successfully'],200);

        }
    }



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
                return response()->json(['message'=>'wrong data class'],400);
            }

            $section=Sections::where('name',$request->input('section'))->where('class_student_id',$clas->id)->where('gender',$request->input('gender'))->first();
            if($section==null){
                return response()->json(['message'=>'wrong data section'],400);
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




    public function destroy(Request $request){
        $section=Sections::find($request->section_id);
        $all_pro= $section->study_program;
        foreach($all_pro as $one){
            Study_program::destroy($one->id);
        }
        return response()->json('program deleted successfully',200);
    }



    public function showProgramDash(Request $request)
    {
//class id,gender,section,day
        $p = DB::table('study_programs as sp')
            ->join('employees as emp', 'emp.id', 'sp.employee_id')
            ->join('sections as se', 'se.id', 'sp.section_id')
            ->join('subjects as sub', 'sp.subject_id', 'sub.id')
            ->where([
                ['sp.day', $request->day],
                ['sp.section_id', $request->section],
                ['se.gender', $request->gender],
                ['se.class_student_id', $request->class]
            ])
            ->select('sub.name as subjects_name', 'emp.name as employee_name',)
            ->orderBy('sp.period')->get();


        return response()->json([
            'data' => $p,
            'statusCode' => 200,
            'message' => 'success'
        ]);


    }
}
