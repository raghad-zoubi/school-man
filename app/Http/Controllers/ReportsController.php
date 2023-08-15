<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    public function countReport()
    {
        $report = Reports::all();
        $count = count($report);
        return response()->json(['count'=>$count],200);
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
