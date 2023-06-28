<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
    public function show(Marks $marks)
    {
        //
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
       // if($request->from==null&&$request->to==null)
       $result=Marks::where('student_id', auth()->user()->id)->where('subject_id',$request->id)
    //->where('','!=',NULL)
        ->get();

        return response()->json([
            'result' => $result,
            'statusCode'=>200

        ]);

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
