<?php

namespace App\Http\Controllers;
use App\Events\Notification;
use App\Models\Class_students;
use App\Models\Follow_up_type;
use App\Models\Marks;
use App\Models\Sections;
use App\Models\Students;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MarksController extends Controller
{public function show_student(Request $request)
{
    $validator = Validator::make($request->all(), [

        'id' => 'required',
        'from' => 'date',
        'to' => 'date'
    ]);
    if ($validator->fails()) {
        return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    //   if($request->from==null&&$request->to==null)
    //  $result=Marks::where('student_id','=', auth()->user()->id)
    //    ->where('subject_id',$request->id)
    // -> whereBetween("date",[$request->from,$request->to])
    //   ->get();

    $result2= DB::table('marks')
        ->join('follow_up_types', 'marks.follow_up_type_id', '=', 'follow_up_types.id')
        ->where('marks.subject_id','=',$request->id)
        ->where('marks.student_id','=',auth()->user()->id)
        -> whereBetween("date",[$request->from,$request->to])
        ->select('marks.semester',
            'marks.studentMark',
            'marks.lowMark' ,
            'marks.highMark' ,
            'marks.date',
            'follow_up_types.name')

        ->get();

    //   //broadcast(new Notification("message", 1, "title"));


    return response()->json(
        $result2,
    );

}

    public function indexMarkDetail( $idStudent,$idType,$idSubject)
    {

        $t2=Marks::where([['student_id','=',$idStudent],['follow_up_type_id','=',$idType],['subject_id','=',$idSubject]])->get(['id','studentMark','lowMark','highMark']);
        foreach ($t2 as $t) {
            $t1 = Follow_up_type::where('id', $idType)->get(['name'])->first();
            $t3 = Subjects::where('id', $idSubject)->get(['name'])->first();
            $t['type'] = $t1;
            $t['subject'] = $t3;
        }
//       $data=collect(json_decode($t2,true))->except('type','subject')->values()->toArray();
//      $cleanData=json_encode($data);
        return response()->json($t2, 200);
    }


    public function create()
    {
        //
    }


    public function storeMark(Request $request,$idSubject,$idType){
        $validator = Validator::make($request->all(), [
//            'className' => 'required', 'string',
            'semester' =>  'required','string',
//            'gender' => 'required','string',
//            'section' => 'required','string',
            'upMark' =>'required','double',
            'downMark' => 'required','double',
//            'idSubject' => 'required',
//            'idType' => 'required',
            'marks',
            'date' => 'date',
//            =>'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        if(blank($request->semester)||
        blank($request->upMark)||
            blank($request->downMark)||
            blank($idType)||
            blank($idSubject))


        {

            return response()->json([
                'statusCode'=>400,
                'message'=>'الرجاء تعبئة المعلومات',
            ]);
        }
                if(blank($request->marks)) {
                    return response()->json([
                        'statusCode' => 400,
                        'message' => 'الرجاء إضافة علامة',
                    ]);
                }
//
        foreach ($request->marks as $mark) {
            Marks::query()->create([
                'semester' => $request->semester,
                'highMark' => $request->upMark,
                'lowMark' => $request->downMark,
                'date'=> '2023-08-22',
                    //$request->date,
                'subject_id' => $idSubject,
                'follow_up_type_id' => $idType,
                'studentMark' => $mark['mark'],
                'student_id' => $mark['id']
            ]);
        }
        return response()->json([
            'statusCode'=>200,
            'message'=>'تمت العملية بنجاح',
        ]);
    }


    public function showStudentMark(Request $request,$idSubject,$idType)
    {

        $class=Class_students::where('name','=',$request->class)->get()->first();
        // dd($class);
        $section = Sections::where([['name','=',$request->section],['gender','=',$request->gender],['class_student_id','=',$class->id]])->get()->first();

        $student=Students::where('section_id', $section->id)->get(['id','name','nickname','fatherName']);
        if(blank($student)){
            return response()->json([
                ['message' => 'لا يوجد طلاب']
            ]);
        }
        foreach ($student as $record) {
            // dd($record->password);
            $t2=Marks::where([['semester','=',$request->semester],['student_id','=',$record->id],['follow_up_type_id','=',$idType],['subject_id','=',$idSubject]])->get(['id','studentMark','lowMark','highMark']);
            //   $t2=$record->password;
//            $t1=Follow_up_type::where('id',$idType)->get(['name'])->first();
//            $t3=Subjects::where('id',$idSubject)->get(['name'])->first();
            $record->number = $t2->count();
//            $t2['type']=$t1;
//            $t2['subject']=$t3;
//            $record->idMark = $t2;

        }

        return response()->json($student, 200);
    }


    public function editMark(Request $request)
    {
        if(blank($request->marks)){
            return response()->json(
                ['message' => 'لا يوجد قيمة لتعديلها',
                    'statusCode'=>400
                ]
            );
        }

        foreach ($request->marks as $mark) {

            if($mark['studentMark'] >= 0) {
                $m = Marks::where([['id', $mark['id']], ['highMark', '>=', $mark['studentMark']]])->update(['studentMark' => $mark['studentMark']]);

                if($m == 0) {
                    return response()->json([
                        'statusCode' => 400,
                        'message' => 'الرجاء وضع العلامة ضمن مجال العلامة ',
                    ]);
                }
            }
            else{
                return response()->json([
                    'statusCode' => 400,
                    'message' => 'الرجاء وضع العلامة ضمن مجال العلامة ',
                ]);
            }
        }

        return response()->json(
            ['statusCode' => 200,
                'message' => 'تمت العملية'
            ]
        );
    }


    public function update(Request $request, Marks $marks)
    {
        //
    }


    public function destroyMark ($idMark)
    {
        $mark=Marks::where('id',$idMark)->delete();
        if(!$mark){
            return response()->json([
                'statusCode' => 400,
                'message' => 'الرجاء إعادة المحاولة ',
            ]);
        }
        return response()->json([
            'statusCode' => 200,
            'message' => 'تمت العملية',
        ]);
    }
}
