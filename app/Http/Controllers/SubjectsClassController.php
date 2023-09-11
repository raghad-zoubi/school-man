<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Http\Controllers\SubjectsController;
use App\Models\Class_students;
use App\Models\Subjects;
use App\Models\Subjects_class;
use Illuminate\Http\Request;


use App\Models\Section_ads;
//>>>>>>> 42231069c138dd2b54d030622428f18629ccb4f5
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SubjectsClassController extends Controller
{  public function show_student()
    {
//        DB::table('working_papers_sections')
//        ->join('students', 'working_papers_sections.section_id', '=', 'students.section_id')
//          //  ->join('sections', 'working_papers_sections.section_id', '=', 'sections.id')


        $result2= DB::table('students')//'Subjects_class')
        ->join('sections', 'students.section_id', '=', 'sections.id')

        ->join('subjects_classes','sections.class_student_id','=','subjects_classes.class_student_id')
        ->join('subjects','subjects_classes.subject_id','=','subjects.id')
        ->where('students.id','=',auth()->user()->id)
        ->select('subjects.*')
        ->get();

        return response()->json(
            $result2);

    }

    public function showSubject(Request $request)
    {
        $classId=Class_students::where('name', $request->className)->get()->first();
        $subjectIds=Subjects_class::where('class_student_id', $classId->id)->get('subject_id');
        if(blank($subjectIds)){
            return response()->json([
                ['message' => 'لا يوجد مواد']
            ]);
        }
        foreach ($subjectIds as $subjectId){
            $subject= Subjects::where('id', $subjectId->subject_id)->get()->first();
//        dd( $subject);
            $subjectId["name"]=$subject->name;
            $subjectId["id"]=$subject->id;

        }

//        $sub["name"]= $subjectIds->name;
//        if(blank($subjectIds)){
//            return response()->json([
//                ['message' => 'لا يوجد مواد']
//            ]);
//        }
//        else {
        return response()->json(
            $subjectIds, 200
        );
//        }
    }
    public function index()
    {
        //
    }

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
                $sub=$request->input('subject');
                $SubjectsController->create($sub);
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


    public function store(Request $request)
    {
        //
    }


    public function show(Subjects_class $subjects_class)  //( request ....)
    {
        $all_sub=Subjects_class::all();
        $respon=null;
        foreach($all_sub as $one){
            $class=Class_students::find($one->class_student_id);
            $subject=Subjects::find($one->subject_id);
            $respon[]=([
                'id'=>$one->id,
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


    public function edit(Subjects_class $subjects_class)
    {
        //
    }


    public function update(Request $request, Subjects_class $subjects_class)
    {

    }


    public function destroy(Request $request){
        $subjectclass=Subjects_class::find($request->subjectclass_id);
        if($subjectclass==null){
            return response()->json('error section not fond',400);
        }
        Subjects_class::destroy($subjectclass->id);
        return response()->json('subject_class deleted successfully',200);
    }
}
