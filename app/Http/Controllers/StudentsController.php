<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $t=Students::where('id', 11)->get()->first()->password;

        $t2=decrypt($t);
        return $t2;
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


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string',
            'fatherName' => 'required','string',
            'workFather'=> 'required','string',
            'motherName' => 'required','string',
            'workMother' => 'required','string',
            'gender' => 'required','string',
            'newClass' => 'required','string',
            'schoolTransferred' => 'string',
            'average',
            'placeOfBirth' => 'required','string',
            'birthDate'=> 'required', 'date',
            'brothersNumber'=> 'required', 'integer',
            'address'=> 'required', 'string',
            'matherPhone'=>'integer',
            'fatherPhone'=>'integer',
            'livesStudent'=>'required', 'string',
            'landPhone'=>'integer',
            'character'=>'required', 'string',
            'transportationType'=>'required', 'string',
            'result',
            'percentage',
            'managementNotes'=>'string'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }
       $password = Str::random(5);
        $student = Students::query()->create([
            'name' => $request->name,
            'fatherName' =>  $request->fatherName,
            'workFather'=> $request->workFather,
            'motherName' => $request->motherName,
            'workMother' => $request->workMother,
            'gender' =>$request->gender,
            'newClass' => $request->newClass,
            'schoolTransferred' => $request->schoolTransferred,
            'average'=>$request->average,
            'placeOfBirth' => $request->placeOfBirth,
            'birthDate'=> $request->birthDate,
            'brothersNumber'=> $request->brothersNumber,
            'address'=> $request->address,
            'matherPhone'=>$request->matherPhone,
            'fatherPhone'=>$request->fatherPhone,
            'livesStudent'=>$request->livesStudent,
            'landPhone'=>$request->landPhone,
            'character'=>$request->character,
            'transportationType'=>$request->transportationType,
            'result'=>$request->result,
            'percentage'=>$request->percentage,
            'managementNotes'=>$request->managementNotes,
            'password'=> encrypt($password),
        ]);
        $tokenResult = $student->createToken("API TOKEN")->plainTextToken;

        $data["user"] = $student;
        $data["token_type"] = 'Bearer';
        $data["access_token"] = $tokenResult;

        return response()->json($data, 200);

    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        $o= encrypt($request->password);

        $credentials = request(  [ $request->password]);
      // dd( $o);
//dd($credentials );
        if (!Auth::attempt($credentials )) {

            throw new AuthenticationException();
        }
        $student = $request->user();
        //dd($student);
        $tokenResult = $student->createToken("API TOKEN")->plainTextToken;

      //  $data["user"] = $student;
        $data["token_type"] = 'Bearer';
        $data["access_token"] = $tokenResult;

        return response()->json($data, 200);


    }
    function  LoginEmployeeOrSpecialist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);

        }
       $pass=encrypt($request->password);
        //   $y=Students::where('password',$request->password)->first();
       $y=Students::where('password',encrypt($request->password))->exists();
      // dd($y);
        if($y)
        {
            $tokenResult = $y->createToken("API TOKEN")->plainTextToken;


            return response()->json([
                'message' => ' successfully',
                'token' => $tokenResult,
            ]);
            // return $this->sendResponse([new EmployeeResource($user)], "login " . $request->role . " successfuly") ;
        }
        return response()->json(['message'=>'yyyy'] );
    }

    ///عرض جميع الموظفين ف

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $students)
    {
        //
    }
}


