<?php

namespace App\Http\Controllers;

use App\Models\PermissionRecorde;
use App\Models\PermissionRecordeRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionRecordeController extends Controller
{
    public function indexListRole()
    {
        $permission = PermissionRecorde::all();
        return response()->json($permission);
    }


}
