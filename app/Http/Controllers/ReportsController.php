<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Reports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function countReports()
    {
        $report = Reports::all();
        $count = count($report);
        return response()->json(['count' => $count], 200);
    }

    public function indexReport()
    {
        $report = Reports::query()->select('id','text')->get();
        if($report){
        return response()->json($report, 200);}
        return response()->json(['message'=>'ليس هناك إبلاغات بعد'], 200);
    }

    public function store_student(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'text' => 'required', 'string',

        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        $report = Reports::query()->create([
            'text' => $request->text,
            'students_id'=>auth()->user()->id

        ]);

        return response()->json([$report]);
    }
    public function show_student()
    {


        $report = Reports::where('students_id',auth()->user()->id)->get();


        return response()->json([

            $report,

        ]);
    }


}
