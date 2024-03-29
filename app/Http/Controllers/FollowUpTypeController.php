<?php

namespace App\Http\Controllers;

use App\Models\Follow_up_type;
use Illuminate\Http\Request;

class FollowUpTypeController extends Controller

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
     * @param  \App\Models\Follow_up_type  $follow_up_type
     * @return \Illuminate\Http\JsonResponse
     */
    public function showType()
    {
        $typeName = Follow_up_type::get(['name','id']);

        return response()->json([
            'data' =>  $typeName,
            'statusCode'=>200,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Follow_up_type  $follow_up_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow_up_type $follow_up_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Follow_up_type  $follow_up_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follow_up_type $follow_up_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follow_up_type  $follow_up_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow_up_type $follow_up_type)
    {
        //
    }
}
