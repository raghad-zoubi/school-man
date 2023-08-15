<?php

namespace App\Http\Controllers;
use App\Events\Notification;
use App\Models\Marks;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marks  $marks
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }
    public function show_student(Request $request)
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

     //   broadcast(new Notification("message", 1, "title"));


        return response()->json(
           $result2,
        );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marks  $marks
     * @return \Illuminate\Http\Response
     */
    public function edit(Marks $marks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marks  $marks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marks $marks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marks  $marks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marks $marks)
    {
        //
    }
}
