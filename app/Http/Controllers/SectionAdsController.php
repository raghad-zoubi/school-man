<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Marks;
use App\Models\Section_ads;
use App\Models\Section_student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SectionAdsController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth:sanctum"]);
        //->except([]);
        //->only([]);
    }
    public function show_student()
    {

$result1=Section_student::where('students_id', auth()->user()->id)->get()->first();
$result2=Section_ads::with('ads')->
where('sections_id','=',$result1->sections_id)
            ->get();

        return response()->json([
            'result' => $result2,
            'statusCode'=>200

        ]);

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
