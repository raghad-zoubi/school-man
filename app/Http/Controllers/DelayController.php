<?php

namespace App\Http\Controllers;

use App\Models\Delay;
use App\Models\Student_time;
use App\Models\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DelayController extends Controller
{//عرض التاخيرات من قبل صاحبها
    public function index_student()
    {
        $all= Delay::where('student_id', auth()->user()->id)
            ->count();
        $absm= Delay::where('student_id', auth()->user()->id)
            ->where('reason','!=',NULL)
            ->count();
        $absunm= Delay::where('student_id', auth()->user()->id)
            ->where('reason',NULL)
            ->count();
        return response()->json([
            'excusedCount' => $absm,
            'UnexcusedCount'=>$absunm,
            'allCount' => $all,
            'allDay'=>290
        ]);
    }
      



  
    //عرض تفاصيل التاخيرات من قبل صاحبها
    public function show_student($kind)
    {
        if($kind=='reason'){
            $absm= Delay::where('student_id', auth()->user()->id)
                ->where('reason','!=',NULL)
                ->get();
            return response()->json(
              $absm
       

            );}
        else if($kind=='unreason'){
            $absunm= Delay::where('student_id', auth()->user()->id)
                ->where('reason',NULL)
                ->get();
            return response()->json(
              $absunm
              );
        }


    }
    //maria---------------------
    public function index(Request $request)
    {

        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
        $date=Delay::where('student_id', '=', $student->id)->get()->first();
        if($date==null){
            return response()->json([
                'message' => 'لا يوجد تأخيرات',
            ]);
        }
        Carbon::setLocale('ar');
        $nameDate=Carbon::parse($date->date)->dayName;;
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
        $date->day=$nameDate;
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
    //maria--------------------
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string',
            'fatherName' => 'required','string',
            'semester' => 'required',
            'date' => 'required','date',
            'duration' => 'required','string',
            'reason' => 'required','string',

        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
        //dd($student->id);
        $delay = Delay::query()->create([
            'semester' => $request->semester,
            'date' =>  $request->date,
            'student_id' => $student->id,
            'duration' => $request->duration,
            'reason' =>  $request->reason,

        ]);
        return response()->json($delay);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delay  $delay
     * @return \Illuminate\Http\Response
     */
    public function show(Delay $delay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delay  $delay
     * @return \Illuminate\Http\Response
     */
    public function edit(Delay $delay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delay  $delay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delay $delay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delay  $delay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delay $delay)
    {
        //
    }
}
