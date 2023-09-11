<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Models\Premium;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PremiumController extends Controller
{

    public function Show_student()
    {

     $premiums=Premium::where('students_id',auth()->user()->id)
         ->orderBy('date', 'asc')
         ->get();
     $total=Students::where('id',auth()->user()->id)
         ->value('total');
     $sum=Premium::where('students_id',auth()->user()->id)
         ->sum('payment');

    $still=$total-(int)$sum;
        return response()->json([
            'still'=>$still,
            'total'=>$total,
             "sum"=>(int)$sum,
             "premiums"=>$premiums,
        ]);



    }  public function index()
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
     * @param  \App\Models\Premium  $premium
     * @return \Illuminate\Http\Response
     */
    public function show(Premium $premium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premium  $premium
     * @return \Illuminate\Http\Response
     */
    public function edit(Premium $premium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Premium  $premium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Premium $premium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premium  $premium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premium $premium)
    {
        //
    }
}
