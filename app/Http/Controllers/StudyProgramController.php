<?php

namespace App\Http\Controllers;

use App\Models\Section_student;
use App\Models\Study_program;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{

    public function index()
    {
        //
    }
    public function show_student()
    {

        $result1=Section_student::where('students_id', auth()->user()->id)->get()->first();
        $result2=Study_program::with('section')->
        where('section_id','=',$result1->sections_id)
            ->get();

        return response()->json([
            'result' => $result2,
            'statusCode'=>200

        ]);

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
     * @param  \App\Models\Study_program  $study_program
     * @return \Illuminate\Http\Response
     */
    public function show(Study_program $study_program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Study_program  $study_program
     * @return \Illuminate\Http\Response
     */
    public function edit(Study_program $study_program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Study_program  $study_program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Study_program $study_program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Study_program  $study_program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Study_program $study_program)
    {
        //
    }
}
