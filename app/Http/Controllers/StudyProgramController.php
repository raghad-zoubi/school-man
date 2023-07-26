<?php

namespace App\Http\Controllers;

use App\Models\Section_ads;
use App\Models\Subjects_class;
use Illuminate\Support\Facades\DB;
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
        $result2= DB::table('section_students')
        ->join('sections', 'section_students.sections_id', '=', 'sections.id')
        ->join('study_programs','sections.id','=','study_programs.section_id')
       ->join('subjects','study_programs.subject_id','=','subjects.id')
        ->where('section_students.students_id','=',auth()->user()->id)
        ->select('study_programs.session','study_programs.day','study_programs.id','subjects.name')
        ->get();



        return response()->json(
        $result2


        );

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
