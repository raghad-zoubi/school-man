<?php

namespace App\Http\Controllers;

use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = DB::table('users as u')
            ->join('user_roles as ur', 'ur.user_id', '=', 'u.id')
            ->join('roles as r', 'r.id', '=', 'ur.role_id')
            ->join('employees as e', 'e.id', '=', 'u.employee_id')
            ->select('u.id', 'e.name', 'u.password', 'r.roleName')
            ->get();
        return response()->json($user);


    }

    public function indexName()
    {
        $user = DB::table('employees as e')
            ->where('e.status',1)
            ->select('e.id','e.name')
            ->get();
        return response()->json($user);
    }


    public function store()
    {



    }




    public function show(User_role $user_role)
    {
        //
    }


    public function edit(User_role $user_role)
    {
        //
    }


    public function update(Request $request, User_role $user_role)
    {
        //
    }


    public function destroy(User_role $user_role)
    {
        //
    }
}
