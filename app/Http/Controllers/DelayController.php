<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Models\Delay;
use App\Models\Student_time;
use App\Models\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DelayController extends Controller
{ //عرض التاخيرات من قبل صاحبها
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
    public function indexDaley(Request $request)
    {

        $student = Students::where([['name','=',$request->name],['nickname','=',$request->nickname],['fatherName','=',$request->fatherName]])->get()->first();
        if(blank($student)){
            return response()->json([
                ['message' => 'طالب غير موجود']
            ]);
        }
        $date=Delay::where('student_id', '=', $student->id)->get();
        if(blank($date)){
            return response()->json([
                ['message' => 'لا يوجد تأخيرات']
            ]);
        }
        Carbon::setLocale('ar');
        foreach ($date as $record) {
            $nameDate = Carbon::parse($record->date)->dayName;
            $record->day = $nameDate;
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

        }
        return response()->json($date,200);
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
    public function storeDaley(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string',
            'nickname' =>  'required','string',
            'fatherName' => 'required','string',
            'semester' => 'required',
            'date' => 'required','date',
            'duration' =>['required'],
//            'regex:/\b(ساعه|ساعة|ساعتين|ساعات|دقيقة|دقيقه|دقيقتين|دقائق)\b/',//, 'regex:/^(?=.*\b(?:ساعه|ساعة|ساعتين|ساعات|دقيقة|دقيقه|دقيقتين|دقائق)\b).+$/'],
            // [ 'required,regex:^(?=.*\d)(?=.*\b(?:hour|minutes)\b).+$^'],
            'reason' => 'required','string',

        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        // ['nickname','=',$request->nickname]
        $student = Students::where([['name','=',$request->name],['nickname','=',$request->nickname],['fatherName','=',$request->fatherName]])->get()->first();
        //dd($student->id);
        if(blank($student)){
            return response()->json([
                'statusCode'=>400,
                'message'=>'"طالب غير موجود"',
            ]);
        }
        $delay = Delay::query()->create([
            'semester' => $request->semester,
            'date' =>  $request->date,
            'student_id' => $student->id,
            'duration' => $request->duration,
            'reason' =>  $request->reason,

        ]);
        //broadcast(new Notification("تم أضافةتأخير ", 1,"  تنبيه  ",));
        broadcast(new Notification("تم إضافة تأخير ", $student->id,"  تنبيه  ",));

        return response()->json([
            'statusCode'=>200,
            'message'=>'تمت العملية بنجاح',
        ]);
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
