<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\Employee;
use App\Models\PermissionRecorde;
use App\Models\PermissionRecordeRole;
use App\Models\Students;
use App\Models\User;
use App\Models\User_role;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRoleController extends Controller
{
    public function logout(Request $request)
    {
        $result = $request->user()->token()->revoke();
        if ($result) {
            $response = response()->json(['message' => 'User logout successfully.', 'statusCode' => 200],);
        } else {
            $response = response()->json(['message' => 'Something is wrong.', 'statusCode' => 400],);
        }
        return $response;
    }
    public function indexList()
    {
        $user = DB::table('users as u')
            ->join('user_roles as ur', 'ur.user_id', '=', 'u.id')
            ->join('roles as r', 'r.id', '=', 'ur.role_id')
            ->join('employees as e', 'e.id', '=', 'u.employee_id')
            ->select('u.id', 'e.name', 'u.password', 'r.roleName','u.created_at')
            ->orderByDesc('u.created_at')
            ->get();

        return response()->json($user);
    }

    public function indexName()
    {
        $user = DB::table('employees as e')
            ->where('e.status', 1)
            ->select('e.id', 'e.name')
            ->get();
        return response()->json($user);
    }


    public function adduser(UserRequest $request)
    {

        $va = $request->validate([
            'password' => ['required', 'min:8'],
            'employee_id' => ['required'],
            'role_id' => ['required'],

        ]);

//        $user = new User();
//        $user->employee_id = $request->input('employee_id');
//        $user->password =Hash::make($request->input('password')) ;
//        $user->save();

//        $request['password'] = Hash::make($request['password']);
        $user = User::query()->create([
            'employee_id' => $request->employee_id,
            'password' => $request->password,
        ]);

        $userRole = User_role::query()->create([
            'user_id' => $user->id,
            'role_id' => $request->role_id,
        ]);

        $data = $request->json()->all();
        foreach ($data['checkboxValues'] as $permission) {
            $p = new PermissionRecordeRole();

            $p->check = $permission['check'];
            $p->role_id = $userRole->id;
            $p->permission_id = $permission['permission_id'];
            $p->save();

        }
        $tokenResult = $user->createToken('PersonalAccessToken');

//        $info["user"] = $user;
//        $info["checkboxValues"] = $data;
        $info["token_type"] = 'Bearer';
        $info["access_token"] = $tokenResult->accessToken;

        return response()->json(["token" => $info, "message" => "تمت إضافة المستخدم بنجاح"], 200);

//foreach ($userRole->role_id as $r)
//
//         PermissionRecordeRole::query()->create([
//            'role_id' => $userRole->id,
//            'check' => $request->check,
//            'permission_id' => $request->permission_id,
//        ]);
//        $userRole = new User_role();
//        $userRole->user_id = $user->id;
//        $userRole->role_id = $request->input('role_id');
//        $permission=new PermissionRecordeRole();
//        $permission->role_id=$userRole->role_id;
//        $permission->check=$request->input('check');
//        $permission->permission_id=$request->input('permission_id');
//        $userRole->save();
//
//        $permission->save();
//        return response()->json([$user,$userRole,$permission]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => ['required'],
            'password' => ['required', 'min:8'],
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $name = Employee::query()->where('name', $request->input('employee_id'))->get('id')->first();
        if(blank($name)){
            return response()->json([
                'message' => 'Unauthenticated',
                'statusCode' => 400]);
        }

        $password=User::query()
            ->where('employee_id',$name->id)
            ->where('password',$request->input('password'))->get('password',)->first();


        if ($name && $password) {
            $user = User::query()->where('employee_id', $name->id)->get('employee_id')->first();
            $credentials = request([$user->employee_id, 'password']);
            $tokenResult = $user->createToken('Personal Access Token');
            $Puser=User::where('employee_id', $name->id)->first();
            $Puserrole=User_role::where('user_id', $Puser->id)->first();
            $Ppermishrole=PermissionRecordeRole::where('role_id', $Puserrole->id)->where('check', 1)->get();
            foreach($Ppermishrole as $per){
                $Ppername=PermissionRecorde::find($per->permission_id);
                $Pperm[]=(
                $Ppername->name
                );
            }
            return response()->json([

                'message' => ' successfully',
                'user' => $credentials,
                'permession'=>$Pperm,
                'token' => $tokenResult->accessToken,
                'statusCode' => 200
            ]);
        }

        return response()->json([
            'message' => 'Unauthenticated',
            'statusCode' => 400

        ]);
    }
//        $data["user"] = $credentials;
//        $data["token_type"] = 'Bearer';
//        $data["access_token"] = $tokenResult->accessToken;
//        return response()->json($data, 200);
//    }
//    public function login_student(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'password' => 'required',
//        ]);
//        if ($validator->fails()) {
//            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
//        }
//
//        $y=Students::where('password',$request->password)->first();
//
//        if($y)
//        {
//            $tokenResult = $y->createToken('ProductsTolken')->plainTextToken;
//
//            return response()->json([
//                'message' => ' successfully',
//                'name'=>$y->name,
//                'token' => $tokenResult,
//                'statusCode'=>200
//
//            ]);
//        }
//        return response()->json(['message'=>'Unauthenticated',
//            'statusCode'=>200 ] );
//
//
//    }


    public function destroyUser($userId)
    {
        $user = User::where('id', $userId)->delete();
        if ($user) {

            return response()->json(["result" => "تم حذف المستخدم بنجاح"]);
        } else {
            return response()->json(["result" => "العملية فشلت"]);

        }
    }


    public function updateUser(Request $request, $userId)
    {
        $validator = validator::make($request->all(), [
            'password' => 'required', 'min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 400);
        }
        $user = User::find($userId);
//        dd($user->id);

        $r = User_role::query()->where('user_id', $user->id)->get()->first();
        $p = PermissionRecordeRole::query()->where('role_id', $r->role_id)->get();

        $user->update([
            'password' => $request['password'],
        ]);

        {
            $data = $request->all();
            foreach ($data['permissions'] as $permissionData) {
                $permission = PermissionRecordeRole::query()->where('permission_id', $permissionData['id']);
                $e = $permission->exists();
//
                if ($permissionData['check'] == 1) {
                    if (!$e) {
                        $p = new PermissionRecordeRole();
//                        $p->id = $permissionData['id'];
//                        $p->role_id=$r->role_id;
//                        $p->permission_id=$permissionData['id'];
//                        $p->check = true;
//                        $p->save();
                        $p->check = $permissionData['check'];
                        $p->role_id = $r->id;
                        $p->permission_id = $permissionData['id'];
                        $p->save();

                    }

                } else {
                    if ($e) {
                        $permission->delete();
                    }
                }
            }


        }
        return response()->json(["message" => "تم تعديل معلومات المستخدم بنجاح"], 200);

    }


    public function getinfo($userId)
    {
        $user = User::find($userId);
        //$data['password'] = $user->password;
        $per = PermissionRecorde::query()->get();
        $r = User_role::query()->where('user_id', $user->id)->get()->first();
        foreach ($per as $pr) {
            $re = PermissionRecordeRole::query()
                ->where([['permission_id', $pr->id], ['role_id', $r->id]])->get('check')->first();
            if ($re == true) {
                $pr["check"] = "1";
            } else {
                $pr["check"] = "0";
            }
//            $pr['check'] = $re;
            $data["permissions"] = $per;

        }
//        $r = User_role::query()->where('user_id', $user->id)->get()->first();
//        $p = PermissionRecordeRole::query()->where('role_id', $r->id)->get();
//$rr=DB::table('permission_recordes as pr')
//    ->join('permission_recorde_roles as prr','prr.permission_id','pr.id')
//    ->where('prr.check',true)
//    ->where('prr.role_id',$r->id)
//    ->get('pr.name')
//        foreach ($p as $w) {
//            $f = PermissionRecorde::query()->where('id', $w->permission_id)->get()->first();
//            $w['checkboxValues'] = $f->name;
//
//        }
//        $data['ch'] = $p;
        return response()->json($data);
    }


    public function edit(User_role $user_role)
    {
        //
    }


}
