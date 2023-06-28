<?php

namespace App\Http\Controllers;

use App\Models\Section_ads;
use App\Models\Section_student;
use App\Models\Subjects_class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectsClassController extends Controller
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
    public function show_student()
    {

        $result2= DB::table('section_students')//'Subjects_class')
            ->join('sections', 'section_students.sections_id', '=', 'sections.id')
            ->join('subjects_classes','sections.class_student_id','=','subjects_classes.class_student_id')
            ->join('subjects','subjects_classes.subject_id','=','subjects.id')
            ->where('section_students.students_id','=',auth()->user()->id)
            ->select('subjects.*')
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
     * @param  \App\Models\Subjects_class  $subjects_class
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects_class $subjects_class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjects_class  $subjects_class
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects_class $subjects_class)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subjects_class  $subjects_class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects_class $subjects_class)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subjects_class  $subjects_class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects_class $subjects_class)
    {
        //
    }
}
