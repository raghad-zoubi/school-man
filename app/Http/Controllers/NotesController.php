<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Models\Notes;
use App\Models\Students;
use App\Models\Subjects;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotesController extends Controller
{

    //عرض ملاحظاتي
    public function show_students($type)
    {
        $notes= DB::table('notes')
            ->join('subjects', 'notes.subject_id', '=', 'subjects.id')->


        where('student_id', auth()->user()->id)->
        where('typeNote',$type)->
            select('subjects.name','notes.semester',
                'notes.date','notes.text')->get();

        return response()->json($notes);


    }
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'typeNote'=>'required|max:100|string',
            'semester'=>'required|max:100|string',
            'text'=>'required|max:250',
            'date'=>'required|date',
            'name'=>'required',
            'nickname'=>'required',
            'fatherName'=>'required',
            'subject'=>'required|max:50|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            ////date check
            $date=$request->input('date');
            $today=Carbon::now();
            $now=Carbon::parse($today);
            $to=Carbon::parse($date);
            $time=$now->diffInDays($to);
            if($time < 0)
            {
                return response()->json(['message'=>'this is future history'],400);
            }
            if($time> 364)
            {
                return response()->json(['message'=>'wrong this history of a year ago'],400);
            }
            ///
            $student=Students::where([['name','=',$request->name],['nickname','=',$request->nickname],['fatherName','=',$request->nickname]])->first();
            if($student==null)
            {
                return response()->json(['message'=>'error  student not found'],400);
            }
            ///
            $subject=Subjects::where('name',$request->subject)->first();
            if($subject==null)
            {
                return response()->json(['message'=>'error  subject not found'],400);
            }
            //
            $new=Notes::create([
                'typeNote'=>$request->input('typeNote'),
                'semester'=>$request->input('semester'),
                'text'=>$request->input('text'),
                'date'=>$date,
                'student_id'=>$student->id,
                'subject_id'=>$subject->id,
            ]);
            broadcast(new Notification("تمت أضافة ملاحظات  ", $student->id,"  تنبيه  ",));

            return response()->json($new,200);
        }
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $notes)
    {
        //
    }
}
