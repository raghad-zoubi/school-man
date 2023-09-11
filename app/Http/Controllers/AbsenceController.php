<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Models\Absence;
use App\Models\Class_students;
use App\Models\Sections;
use App\Models\Student_time;
use App\Models\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AbsenceController extends Controller

{
//عرض غيايات من قبل صاحبها
    public function index_student()
    {
        $all= Absence::where('student_id', auth()->user()->id)
            ->count();
        $absm= Absence::where('student_id', auth()->user()->id)
            ->where('reason','!=',NULL)
            ->count();
        $absunm= Absence::where('student_id', auth()->user()->id)
            ->where('reason',NULL)
            ->count();
        return response()->json([

            'excusedCount' => $absm,
            'UnexcusedCount'=>$absunm,
            'allCount' => $all,
            'allDay'=>290
        ]);

    }
//عرض تفاصيل الغياب من قبل صاحبها
    public function show_student($kind)
    {
        if($kind=='reason'){
            $absm= Absence::where('student_id', auth()->user()->id)
                ->where('reason','!=',NULL)
                ->get();
            return response()->json(
                $absm


            );}
        else if($kind=='unreason'){
            $absunm= Absence::where('student_id', auth()->user()->id)
                ->where('reason',NULL)
                ->get();
            return response()->json(
                $absunm );
        }


    }

    //maria------------------------------
    public function indexAbsence( $idStudent)
    {
//        $student = Students::where('id',$idStudent)->get()->first();
//        if(blank($student)){
//            return response()->json([
//                ['message' => 'طالب غير موجود']
//            ]);
//        }
        $student=Absence::where('student_id', '=', $idStudent)->get();
        if(blank($student)){
            return response()->json([
                ['message' =>  'لا يوجد غيابات'],
            ]);
        }
        Carbon::setLocale('ar');
        foreach ($student as $record) {
            $nameDate = Carbon::parse($record->date)->dayName;
            $record->day = $nameDate;
//        $MyOrder = DB::table('absences as a')
//            ->join('student_times as s', 's.id', '=','a.student_time_id' )
//            ->select('a.id', 'a.reason','a.student_time_id','s.semester', 's.date')
//            ->where('s.student_id', '=', $student->id)
//            ->groupBy('a.id','a.reason','s.semester', 's.date','a.student_time_id')
//            ->get()->first();
////dd($MyOrder==null);
//        if($MyOrder==null ){
//            return response()->json([
//                'message' => 'لا يوجد غيابات',
//            ]);
//        }

        }

        return response()->json($student, 200);
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
     * @return \Illuminate\Http\JsonResponse
     */

    //maria-------------------------
    public function storeAbsence(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'name' => 'required', 'string',
//            'nickname' => 'required', 'string',
//            'fatherName' => 'required','string',
//            'typeAbsence' => 'required','boolean',
            'semester' => 'required',
//            'reason' => 'string',
//            'date' => 'required','date'
            'rows'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if(blank($request->semester))
        {
            return response()->json([
                'statusCode'=>400,
                'message'=>'الرجاء تعبئة الفصل',
            ]);
        }
        if(blank($request->rows)) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'لايوجد علامات للاضافة',
            ]);
        }
        foreach ($request->rows as $row) {
            Absence::query()->create([
                'semester' => $request->semester,
                'typeAbsence' => $row['check'],
                'reason' =>$row['reason'],
                'date' =>now()->format('Y-m-d'),
                'student_id' => $row['student_id']

            ]);
        broadcast(new Notification("تم أضافة غياب ", $row['student_id'],"  تنبيه  ",));
        }
        //        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
//        if(blank($student)){
//            return response()->json([
//                'statusCode'=>400,
//                'message'=>'يرجى إعادة المحاولة مرة أخرى',
//            ]);
//        }
//        $absence= Absence::query()->create([
//            'semester' => $request->semester,
//            'date' =>  $request->date,
//            'student_id' => $student->id,
//            'typeAbsence' => $request->typeAbsence,
//            'reason' =>  $request->reason,
//
//        ]);
        //

        return response()->json([
            'statusCode'=>200,
            'message'=>'تمت العملية بنجاح',
        ]);
    }



    //maria----------------------
    public function showAbsence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nameSection' => 'required',
            'semester' => 'required',
            'class' => 'required',
            'gender' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $className = Class_students::where('name','=',$request->class)->get()->first();
        // dd($className);
        $section = Sections::where([['name','=',$request->nameSection],['gender','=',$request->gender],['class_student_id','=',$className->id ]])->get()->first();
//        $MyOrder = DB::table('section_students as a')
//            ->join('students as s', 's.id', '=','a.students_id' )
//            ->select('s.id', 's.name','s.fatherName')
//            ->where('a.sections_id', '=',  $section->id)
//            ->where('a.semester', '=',  $request->semester)
//            ->groupBy('s.id', 's.name','s.fatherName')
//            ->get()->all();
        $MyOrder=Students::where('section_id','=',$section->id)->get(['id','name','nickname','fatherName']);
        if($MyOrder==null ){
            return response()->json([
                'data' => 'لا يوجد طلاب',
            ]);
        }
        return response()->json([
            'data' => $MyOrder,
            'statusCode'=>200,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAbsenceReason(Request $request)
    {
        if(blank($request->newReason)){
            return response()->json(
                ['message' => 'لا يوجد قيمة لتعديلها',
                    'statusCode'=>400
                ]
            );
        }

        foreach ($request->newReason as $reason) {
//            return response()->json([
//                'statusCode' => 200,
//                'message' =>$reason['typeAbsence'],
//            ]);
            $m = Absence::where('id', $reason['id'])->update(['reason' => $reason['reason'],'typeAbsence' => $reason['typeAbsence']]);

            if($m == 0) {
                return response()->json([
                    'statusCode' => 400,
                    'message' => $m ,
                ]);
            }
        }
        return response()->json(
            ['statusCode' => 200,
                'message' => 'تمت العملية'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absence)
    {
        //
    }
}
