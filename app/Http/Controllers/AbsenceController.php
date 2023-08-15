<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
        $date=Absence::where('student_id', '=', $student->id)->get()->first();
        if($date==null){
            return response()->json([
                'message' =>  'لا يوجد غيابات',
            ]);
        }
        Carbon::setLocale('ar');
        $nameDate=Carbon::parse($date->date)->dayName;
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

        $date->day = $nameDate;

        return response()->json($date);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string',
            'fatherName' => 'required','string',
            'typeAbsence' => 'required','boolean',
            'semester' => 'required',
            'reason' => 'string',
            'date' => 'required','date'
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
        $absence= Absence::query()->create([
            'semester' => $request->semester,
            'date' =>  $request->date,
            'student_id' => $student->id,
            'typeAbsence' => $request->typeAbsence,
            'reason' =>  $request->reason,

        ]);
        return response()->json($absence);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\JsonResponse
     */

    //maria----------------------
    public function show(Request $request)
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
        $MyOrder = DB::table('section_students as a')
            ->join('students as s', 's.id', '=','a.students_id' )
            ->select('s.id', 's.name','s.fatherName')
            ->where('a.sections_id', '=',  $section->id)
            ->where('a.semester', '=',  $request->semester)
            ->groupBy('s.id', 's.name','s.fatherName')
            ->get()->all();
        if($MyOrder==null ){
            return response()->json([
                'message' => 'لا يوجد طلاب',
            ]);
        }
        return response()->json($MyOrder);
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absence $absence)
    {
        //
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
