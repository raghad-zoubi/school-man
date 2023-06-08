<?php

namespace App\Http\Controllers;

use App\Models\Delay;
use Illuminate\Http\Request;

class DelayController extends Controller
{//عرض التاخيرات من قبل صاحبها
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
            'reason' => $absm,
            'unreason'=>$absunm,
            'allday' => $all,
            'statusCode'=>200

        ]);

    }
    //عرض تفاصيل التاخيرات من قبل صاحبها
    public function show_student($kind)
    {
        if($kind=='reason'){
            $absm= Delay::where('student_id', auth()->user()->id)
                ->where('reason','!=',NULL)
                ->get();
            return response()->json([
                'reason' => $absm,
                'statusCode'=>200

            ]);}
        else if($kind=='unreason'){
            $absunm= Delay::where('student_id', auth()->user()->id)
                ->where('reason',NULL)
                ->get();
            return response()->json([
                'unreason'=>$absunm,
                'statusCode'=>200  ]);
        }


    }
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
