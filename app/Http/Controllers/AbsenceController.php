<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    //عرض غيايات من قبل صاحبها
    public function index_student()
    {
        $all= Absence::where('student_id', auth()->user()->id)
            ->count();
        $absm= Absence::where('student_id', auth()->user()->id)
            ->where('reason','!=',NULL)
            ->count();
        $absunm= Absence::where('student_id', auth()->user()->id)
            ->where('reason',NULL)
            ->count();
        return response()->json([
            'reason' => $absm,
            'unreason'=>$absunm,
            'allday' => $all,
            'statusCode'=>200

        ]);

    }
    //عرض تفاصيل الغياب من قبل صاحبها
    public function show_student($kind)
    {
        if($kind=='reason'){
            $absm= Absence::where('student_id', auth()->user()->id)
                ->where('reason','!=',NULL)
                ->get();
            return response()->json([
                'reason' => $absm,
                'statusCode'=>200

            ]);}
        else if($kind=='unreason'){
            $absunm= Absence::where('student_id', auth()->user()->id)
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
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absence)
    {
        //
    }
}
