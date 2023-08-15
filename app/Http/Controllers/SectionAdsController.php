<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Section_ads;
use App\Models\Section_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionAdsController extends Controller
{
    public function __construct()
    {
       // $this->middleware(["auth:sanctum"]);

    }
    public function show_student($type)
{

        if($type==1)
            $result2=Ads::
            where('type','=',$type)
               ->get();

else
    $result2= DB::table('section_ads')
        ->join('section_students', 'section_ads.sections_id', '=', 'section_students.sections_id')
        ->join('sections', 'section_ads.sections_id', '=', 'sections.id')
        ->join('ads','section_ads.ad_id','=','ads.id')
        ->where('section_students.students_id','=',auth()->user()->id)
        ->where('ads.type','=',$type)
        ->select('section_ads.*','ads.*')
        ->get();

            return response()->json(
                $result2,
            );

    }

    public function index()
    {

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
     * @param  \App\Models\Section_ads  $section_ads
     * @return \Illuminate\Http\Response
     */
    public function show(Section_ads $section_ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section_ads  $section_ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Section_ads $section_ads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section_ads  $section_ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section_ads $section_ads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section_ads  $section_ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section_ads $section_ads)
    {
        //
    }
}
