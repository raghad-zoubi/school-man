<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function countReports()
    {
        $report = Report::all();
        $count = count($report);
        return response()->json(['count' => $count], 200);
    }

    public function indexReport()
    {
        $report = Report::query()->select('id','text')->get();
        if($report){
        return response()->json($report, 200);}
        return response()->json(['message'=>'ليس هناك إبلاغات بعد'], 200);
    }
}
