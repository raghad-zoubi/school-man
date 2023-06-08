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
        $password = Str::random(7);
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
            'password'=>($password)

        ]);
        $tokenResult = $student->createToken("API TOKEN")->plainTextToken;

        $data["user"] = $student;
        $data["token_type"] = 'Bearer';
        $data["access_token"] = $tokenResult;

        return response()->json($data, 200);

    }
    public function login_student(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        //  $pass=Crypt::encrypt($request->password);Crypt::decrypt($y->password);

        $y=Students::where('password',$request->password)->first();

        if($y)
        {
            $tokenResult = $y->createToken('ProductsTolken')->plainTextToken;

            return response()->json([
                'message' => ' successfully',
                'name'=>$y->name,
                'token' => $tokenResult,
                'statusCode'=>200

            ]);
        }
        return response()->json(['message'=>'Unauthenticated',
            'statusCode'=>200 ] );


    }

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


