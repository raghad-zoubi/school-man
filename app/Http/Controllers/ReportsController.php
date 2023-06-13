<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function countReport()
    {
        $report = Report::all();
        $count = count($report);
        return response()->json(['count'=>$count],200);
    }
}
