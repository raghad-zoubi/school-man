<?php

namespace App\Http\Controllers;

use App\Models\Student_time;
use App\Models\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class StudentTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
//    public function indexDelay(Request $request)
//    {
//        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
//        $date=Student_time::where('student_id', '=', $student->id)->get()->first();
//        if($date==null){
//            return response()->json([
//                'message' => 'لا يوجد تأخيرات',
//            ]);
//        }
//        Carbon::setLocale('ar');
//        $nameDate=Carbon::parse($date->date)->dayName;;
//        $MyOrder = DB::table('delays as d')
//            ->join('student_times as s', 's.id', '=','d.student_time_id' )
//            ->select('d.id', 'd.reason', 'd.duration','d.student_time_id','s.semester', 's.date')
//            ->where('s.student_id', '=', $student->id)
//            ->groupBy('d.id','d.reason', 'd.duration', 's.semester', 's.date','d.student_time_id')
//            ->get()->first();
//        if($MyOrder==null){
//            return response()->json([
//                'message' => 'لا يوجد تأخيرات',
//            ]);
//        }
//        $MyOrder->day=$nameDate;
//        return response()->json($MyOrder);
//    }

    //-------------------------------------------

//    public function indexPermission(Request $request)
//    {
//        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
//        $date=Student_time::where('student_id', '=', $student->id)->get()->first();
//        if($date==null){
//            return response()->json([
//                'message' =>  'لا يوجد أذونات',
//            ]);
//        }
//        Carbon::setLocale('ar');
//        $nameDate=Carbon::parse($date->date)->dayName;
//        $MyOrder = DB::table('permissions as p')
//            ->join('student_times as s', 's.id', '=','p.student_time_id' )
//            ->select('p.id', 'p.reason','p.student_time_id','s.semester', 's.date')
//            ->where('s.student_id', '=', $student->id)
//            ->groupBy('p.id','p.reason','s.semester', 's.date','p.student_time_id')
//            ->get()->first();
//       // dd($MyOrder->date);
//        if($MyOrder==null ){
//            return response()->json([
//                'message' => 'لا يوجد أذونات',
//            ]);
//        }
//        $MyOrder->day=$nameDate;
//        return response()->json($MyOrder);
//    }
    //-------------------------------------------

//    public function indexAbsence(Request $request)
//    {
//        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
//        $date=Student_time::where('student_id', '=', $student->id)->get()->first();
//        if($date==null){
//            return response()->json([
//                'message' =>  'لا يوجد غيابات',
//            ]);
//        }
//        Carbon::setLocale('ar');
//        $nameDate=Carbon::parse($date->date)->dayName;
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
//
//            $MyOrder->day = $nameDate;
//
//        return response()->json($MyOrder);
//    }

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student_time  $student_time
     * @return \Illuminate\Http\Response
     */
    public function show(Student_time $student_time)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student_time  $student_time
     * @return \Illuminate\Http\Response
     */
    public function edit(Student_time $student_time)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student_time  $student_time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student_time $student_time)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student_time  $student_time
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student_time $student_time)
    {
        //
    }
}
