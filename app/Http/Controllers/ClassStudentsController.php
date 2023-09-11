<?php

namespace App\Http\Controllers;


use App\Models\Class_students;
use Illuminate\Http\Request;

class ClassStudentsController extends Controller
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
     * @param  \App\Models\Class_students  $class_students
     * @return \Illuminate\Http\JsonResponse
     */

    //maria------------------------------
    public function showClass()
    {
        $className = Class_students::get(['name','id']);

        return response()->json([
            'data' =>  $className,
            'statusCode'=>200,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Class_students  $class_students
     * @return \Illuminate\Http\Response
     */
    public function edit(Class_students $class_students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Class_students  $class_students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Class_students $class_students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Class_students  $class_students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Class_students $class_students)
    {
        //
    }
}
