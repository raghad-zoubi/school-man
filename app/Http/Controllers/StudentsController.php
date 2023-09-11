<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Http\Requests\PremiumRequest;
use
    App\Models\Class_students;
use App\Models\Illness;
use App\Models\Premium;
use App\Models\Sections;
use App\Models\Students;
use App\Models\Subjects;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class StudentsController extends Controller
{
    public function listStudentBudget()
    {

        $t = Students::query()->select('id', 'name', 'total')->get();
       // $p = Premium::query()->where('students_id', $t->first()->id)->get('payment')->count();
//

        $st = DB::table('students as s')
            ->join('premiums as pr', 's.id', 'pr.students_id')
            ->select('pr.students_id', 's.id', 's.name', 's.total', DB::raw('SUM(pr.payment) as sum'))
            ->groupBy('pr.students_id', 's.id', 's.name', 's.total')
            ->get();
        return response()->json($st);
    }

    public function addPayment(PremiumRequest $request, $StudentID)
    {
        $total = Students::query()->where('id', $StudentID)->select('total')->get()->first()->total;
        $p = Premium::query()->where('students_id', $StudentID)->get()->sum('payment');

//        $payment = Premium::query()->create([
//            'payment' => $request->payment,
//            'date' => $request->date,
//            'student_id' => $StudentID,
//        ]);
        $payment = new Premium();
        $payment->payment = $request->payment;
        $payment->date = $request->date;
        $payment->students_id = $StudentID;

        if ($p + $request->payment > $total) {
            return response()->json([
                "message" => "المبلغ المدفوع تجاوز المبلغ الكلي",
                "statusCode" => 400]);
        } else {
            $payment->save();
            broadcast(new Notification("تم أضافة مبلغ الدفع ",$StudentID,"  تنبيه  ",));

            return response()->json(["message" => "تمت إضافة المبلغ بنجاح",
                "statusCode" => 200]);
        }
    }

    public function indexStudent(Request $request){$t=Students::where('id', 11)->get()->first()->password;
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
//            $t2= decrypt($record->password);
            $t2=$record->password;
            $record->password = $t2;
        }
        return response()->json($student, 200);}

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
            'total'=>'required','numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $password = Str::random(5);
       // $t2=encrypt($password);
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
            'total'=>$request->total,
            'password'=>($password),
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
                'message' => ' successfully',
                'name'=>$y->name,
                'token' => $tokenResult,
                'statusCode'=>200,
                'id'=>1

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
        $info = DB::table('students as st')
            ->where('st.id', $studentId)->select(
                'name', 'nickname', 'fatherName',
                'workFather', 'motherName', 'workMother',
                'grandFather', 'date', 'gender',
                'newClass', 'schoolTransferred',
                'average', 'placeOfBirth', 'birthDate',
                'brothersNumber', 'address', 'matherPhone',
                'fatherPhone', 'livesStudent', 'landPhone',
                'character', 'transportationType', 'result',
                'percentage', 'managementNotes')->get();
        $data['data']=$info;
        $ill = DB::table('illnesses as il')->
        where('il.student_id', $studentId)
            ->select('nameIllness', 'pharmaceutical')->get();

        // $ill=Illness::where('student_id', $studentId)->get();
        $data['illnesses']=$ill;

        return response()->json($data, 200  );
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


