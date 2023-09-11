<?php

namespace App\Http\Controllers;
use App\Events\Notification;
use App\Models\Ads;
use App\Models\Class_students;
use App\Models\Section_ads;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{


    public function indexSectionAds(Request $request)
    {
        $classId=Class_students::where('name',$request->className)->get(['id'])->first();

        if($request->gender === 'إناث و ذكور'){
            $allSection=Sections::where('class_student_id','=',$classId->id )->get(['name','id']);
        }
        else{
            $allSection=Sections::where([['gender','=',$request->gender],['class_student_id','=',$classId->id ]])->get(['name','id']);
        }

        return response()->json([
            'data' => $allSection,
            'statusCode'=>200,
            'message'=>'success'
        ]);
    }
    public function create()
    {
        //
    }


    public function storeFile(Request $request)
    {
        if($request->typeClick){
//       $g=$request->hasfile('file');
//        return response()->json([
//            'statusCode'=>200,
//            'message'=>$request->typeClick
//        ]);
            if ($request->typeClick == "1") {
//        $g=$request->hasfile('file');
//        return response()->json([
//            'statusCode'=>200,
//            'message'=>$request->file
//        ]);
                $validator = Validator::make($request->all(), [
                    'title' => ['required'],
                    'file' => ['required', 'file'],
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                if($request->hasfile('file')){

                    $file = $request->file('file');
                    $extention = $file->getClientOriginalName();
//                 $filename= $file->storeAs('uploads', $extention,'public');
//                $filename = time() . '.' . $extention;
                    //  $filename=time(). "-". $request->name ."-".$request->file->extension();
//                 $file->storeAs('uploads', $extention,'public');
                    $fil=$file->storeAs('uploads',$extention,'public');
                    $file->move(public_path('uploads'),$fil);
//                $file->move('uploads', $file);
//                dd($filename);
//                    $admin->file =$filename;

                    $ads = Ads::query()->create([
                        'title' => $request->title,
                        'type' => $request->typeClick,
                        'text' => $extention,
                    ]);
                    return response()->json([
                        'statusCode'=>200,
                        'message'=>'تمت العملية بنجاح',
                    ]);
                }
                else{
                    return response()->json([
                        'statusCode'=>400,
                        'message'=>'تعذر تحميل الملف  ',
                    ]);
                }
            }

            if ($request->typeClick == "2") {

                $validator = Validator::make($request->all(), [
                    'title' => ['required'],
                    'className'=> ['required'],
                    'gender' => ['required'],
                    'file' => ['required'],
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                $classId=Class_students::where('name',$request->className)->get(['id'])->first();
                if($request->gender === 'إناث و ذكور'){
                    $sections=Sections::where('class_student_id',$classId->id)->get(['id']);
                    if(blank($sections)){
                        return response()->json([
                            'statusCode'=>400,
                            'message' => 'لا يوجد شعب لهذا الصف'
                        ] );
                    }
                }
                else{
                    $sections=Sections::where([['class_student_id',$classId->id],['gender',$request->gender]])->get(['id']);
                    if(blank($sections)){
                        return response()->json([
                            'statusCode'=>400,
                            'message'=> 'لا يوجد شعب لهذا الصف'
                        ] );
                    }
                }
                if($request->file != null){

                    foreach ($sections as $section){
                        if($request->hasfile('file'))
                        {
                            $file = $request->file('file');
                            $extention = $file->getClientOriginalName();
                            $fil=$file->storeAs('uploads',$extention,'public');
                            $file->move(public_path('uploads'),$fil);


//                    $admin->file =$filename;
                }
                        $ads = Ads::query()->create([
                            'title' => $request->title,
                            'type' =>"2",
                            'text' => $extention,
                        ]);
                        $section_ads = Section_ads::query()->create([
                            'sections_id'=>$section->id,
                            'ad_id'=>$ads->id
                        ]);

                    }
                }
                else{
                    return response()->json([
                        'statusCode'=>400,
                        'message'=>'يرجى اختيار ملف',
                    ]);
                }
            }
            if ($request->typeClick == "3") {

                $validator = Validator::make($request->all(), [
                    'title' => ['required'],
                    'className'=> ['required'],
                    'gender' => ['required'],
                    'file' => ['required'],
                    'section'=>['required']
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                $classId=Class_students::where('name',$request->className)->get(['id'])->first();
                if($request->gender === 'إناث و ذكور'){
                    $sections=Sections::where([['class_student_id',$classId->id],['name',$request->section]])->get(['id']);
                    if(blank($sections)){
                        return response()->json([
                            'statusCode'=>400,
                            'message' => 'لا يوجد شعب لهذا الصف'
                        ] );
                    }
                }
                else{
                    $sections=Sections::where([['class_student_id',$classId->id],['gender',$request->gender],['name',$request->section]])->get(['id']);
                    if(blank($sections)){
                        return response()->json([
                            'statusCode'=>400,
                            'message' => 'لا يوجد شعب لهذا الصف'
                        ] );
                    }
                }
                if($request->file != null){
                    foreach ($sections as $section){

                        if($request->hasfile('file'))
                        {
                            $file = $request->file('file');
                            $extention = $file->getClientOriginalName();
                            $fil=$file->storeAs('uploads',$extention,'public');
                            $file->move(public_path('uploads'),$fil);

//                    $admin->file =$filename;
                        }
                        $ads = Ads::query()->create([
                            'title' => $request->title,
                            'type' =>"2",
                            'text' => $extention,
                        ]);
                        $section_ads = Section_ads::query()->create([
                            'sections_id'=>$section->id,
                            'ad_id'=>$ads->id
                        ]);

                    }
                }
                else{
                    return response()->json([
                        'statusCode'=>400,
                        'message'=>'يرجى اختيار ملف',
                    ]);
                }

            }
            //broadcast(new Notification("تم أضافة اعلان جديد ", 1,"  تنبيه  ",));

            return response()->json([
                'statusCode'=>200,
                'message'=>'تمت العملية بنجاح',
            ]);
        }
        else{
            return response()->json([
                'statusCode'=>400,
                'message'=>'يرجى تحديد وجهة الإعلان',
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $ads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ads $ads)
    {
        //
    }

    public function destroyFile($idFile)
    {
        $classId=Ads::where('text',$idFile)->delete();
        if(!$classId){
            return response()->json([
                'statusCode' => 400,
                'message' => 'الرجاء إعادة المحاولة ',
            ]);
        }
        return response()->json([
            'statusCode' => 200,
            'message' => 'تمت العملية',
        ]);
        // return response()->json($idFile);
    }
}
