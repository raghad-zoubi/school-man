<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Models\Permission;
use App\Models\Student_time;
use App\Models\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller

{    //عرض الاذونات من قبل صاحبها

    public function index_student()
    {
        $per= Permission::where('student_id', auth()->user()->id)
            ->count();

        return response()->json([
            'allCount' => $per,



        ]);

    }
    //عرض تفاصيل الاذن من قبل صاحبها
    public function showd_student()
    {


        $per= Permission::where('student_id', auth()->user()->id)
            ->get();
        return response()->json(
            $per,
        );
    }
    //maria---------------
    public function indexPermission(Request $request)
    {
        $student = Students::where([['name','=',$request->name],['fatherName','=',$request->fatherName]])->get()->first();
        if(blank($student)){
            return response()->json([
                ['message' => 'طالب غير موجود'],
            ]);
        }
        $date=Permission::where('student_id', '=', $student->id)->get();
        if(blank($date)){
            return response()->json([
                ['message' =>  'لا يوجد أذونات'],
            ]);
        }
        Carbon::setLocale('ar');
        foreach ($date as $record) {
            $nameDate = Carbon::parse($record->date)->dayName;
            $record->day = $nameDate;
//        $MyOrder = DB::table('permissions as p')
//            ->join('student_times as s', 's.id', '=','p.student_time_id' )
//            ->select('p.id', 'p.reason','p.student_time_id','s.semester', 's.date')
//            ->where('s.student_id', '=', $student->id)
//            ->groupBy('p.id','p.reason','s.semester', 's.date','p.student_time_id')
//            ->get()->first();
            // dd($MyOrder->date);
//        if($date==null ){
//            return response()->json([
//                'message' => 'لا يوجد أذونات',
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

    //maria---------------------
    public function storePermission(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string',
            'nickname' => 'required', 'string',
            'fatherName' => 'required','string',
            'semester' => 'required',
            'date' => 'required','date',
            'person' => 'required','string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $student = Students::where([['name','=',$request->name],['nickname','=',$request->nickname],['fatherName','=',$request->fatherName]])->get()->first();
        //dd($student->id);
        if(blank($student)){
            return response()->json([
                'statusCode'=>400,
                'message'=>'يرجى إعادة المحاولة مرة أخرى',
            ]);
        }
        $permission = Permission::query()->create([
            'semester' => $request->semester,
            'date' =>  $request->date,
            'student_id' => $student->id,
            'person' =>  $request->person,
        ]);
        broadcast(new Notification("تم طلب إذن ",$student->id ,"  تنبيه  ",));

        return response()->json([
            'statusCode'=>200,
            'message'=>'تمت العملية بنجاح',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
