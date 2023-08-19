<?php

namespace App\Http\Controllers;

use
    App\Models\Class_students;
use App\Models\Illness;
use App\Models\Sections;
use App\Models\Students;
use App\Models\Subjects;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexStudent(Request $request)
   {
//     $t=Students::where('id', 11)->get()->first()->password;
//
//        $t2=decrypt($t);
//        return $t2;
//        dd($request->class);

        $class=Class_students::where('name','=',$request->class)->get()->first();
      // dd($class);
        $section = Sections::where([['name','=',$request->section],['gender','=',$request->gender],['class_student_id','=',$class->id]])->get()->first();
        // dd($section);
//        if(blank($section)) {
//            return response()->json([
//                ['message' => 'لا يوجد ']
//            ]);
//        }
         $student=Students::where('section_id', $section->id)->get(['id','name','nickname','fatherName','password']);
        if(blank($student)){
            return response()->json([
                ['message' => 'لا يوجد طلاب']
           ] );
        }
        foreach ($student as $record) {
           // dd($record->password);
           $t2=decrypt($record->password);
           //$t2=$record->password;
            $record->password = $t2;
        }
        return response()->json($student, 200);
    }
   //191622 num section database
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

      //maria------------------------------------------------
    public function storeStudent(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string','regex:/^[أ-يa-zA-Z\s]+$/u',
            'nickname' => 'required', 'string','regex:/^[أ-يa-zA-Z\s]+$/u',
            'fatherName' => 'required','string','regex:/^[أ-يa-zA-Z\s]+$/u',
            'workFather'=> 'required','string','regex:/^[أ-يa-zA-Z\s]+$/u',
            'motherName' => 'required','string','regex:/^[أ-يa-zA-Z\s]+$/u',
            'workMother' => 'required','string','regex:/^[أ-يa-zA-Z\s]+$/u',
            'gender' => 'required','string',
            'newClass' => 'required','string',
            'schoolTransferred' => 'string',
            'average',
            'placeOfBirth' => 'required','string',
            'birthDate'=> 'required', 'date',
            'brothersNumber'=> 'required', 'integer',
            'address'=> 'required', 'string',
            'matherPhone'=>'regex:/^09\d{8}$/',
            'fatherPhone'=>'regex:/^09\d{8}$/',
            'livesStudent'=>'required', 'string',
            'landPhone'=>'integer','digits:7',
            'character'=>'required', 'string',
            'transportationType'=>'required', 'string',
            'result',
            'percentage',
            'managementNotes',
//            =>'string',
            'date'=> 'required', 'date',
            'grandFather'=>'required','string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $password = Str::random(5);
        $t2=encrypt($password);
        //dd($t2);
//        $student1 = Students::where([['name','=',$request->name],['nickname','=',$request->nickname],['fatherName','=',$request->fatherName]])->get()->first();
//        if(!blank($student1)){
//            return response()->json([
//                'message'=>'لقد قمت بالإضافة مسبقا',
//                'statusCode'=>200
//            ]);
//        }
        $student = Students::query()->create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'fatherName' =>  $request->fatherName,
            'grandFather'=>$request->grandFather,
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
            'date'=>$request->date,
            'password'=>($t2),
            //'section_id'=>1,

        ]);

        $illnesses=$request->illnesses;
      // dd($illnesses);
       if(!blank($illnesses)) {
            foreach ($illnesses as $illnesse) {
                //dd($illnesse);
//            if(!isset($illnesse->nameIllness) && !isset($illnesse->pharmaceutical) ){
//                    return response()->json( [
//                        'message'=>'الرجاء حذف السطر الإضافي',
//                        'statusCode'=>400
//                    ]);
//                }
//                elseif(!isset($illnesse->nameIllness) && isset($illnesse->pharmaceutical) ){
//                    return response()->json( [
//                        'message'=>'ادخل اسم المرض',
//                        'statusCode'=>400
//                    ]);
//                }
//                else  {
                    $addIllnesse = new Illness();
                    $addIllnesse->nameIllness = $illnesse['nameIllness'];
                    $addIllnesse->pharmaceutical = $illnesse['pharmaceutical'];
                    $addIllnesse->student_id = $student->id;
                    $addIllnesse->save();
                }

//            }
        }
        $tokenResult = $student->createToken("API TOKEN")->plainTextToken;

        $data["user"] = $student;
        $data["token_type"] = 'Bearer';
        $data["access_token"] = $tokenResult;

        return response()->json( [
                'message'=>'تمت العملية بنجاح',
                'statusCode'=>200
        ]);

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
                'message' => 'successfully',
                'name'=>$y->name,
                'id'=>$y->id,
                'token' => $tokenResult,
                'statusCode'=>200

            ]);
        }
        return response()->json(['message'=>'Unauthenticated',
            'statusCode'=>200 ] );


    }

     public function logout_student()
     {

         $result =Auth::user()->tokens()->delete();
         if($result){
             $response = response()->json('User logout successfully',200);
         }

         return $response;
     }


//maria---------------------------------------------------
    public function showDetailStudent($studentId)
    {
        $students=Students::where('id', $studentId)->get()->first();
        $ill=Illness::where('student_id', $studentId)->get();
        if(!blank($ill)){
            $students['illnesses']=$ill;
        }
        return response()->json([$students], 200  );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\JsonResponse
     */
    public function allStudent()
    {
        $student=Students::get(['id','name','nickname','fatherName']);
//        if(blank($student)){
//            return response()->json([
//                ['message' => 'لا يوجد طلاب']
//            ]);
//        }
        return response()->json($student, 200);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyStudent($idStudent)
    {
        $student=Students::where('id',$idStudent)->delete();
        if(!$student){
            return response()->json([
                'statusCode' => 400,
                'message' => 'الرجاء إعادة المحاولة ',
            ]);
        }
        return response()->json([
            'statusCode' => 200,
            'message' => 'تمت العملية',
        ]);
    }
    public function countStudents()
    {
        $student = Students::all();
        $count = count($student);
        return response()->json(['count' => $count], 200);
    }
}


