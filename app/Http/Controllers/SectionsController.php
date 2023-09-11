<?php

namespace App\Http\Controllers;


use App\Models\Class_students;
use App\Models\Sections;
use Illuminate\Http\Request;

use App\Models\Ads;

use App\Models\Section_ads;

use App\Models\Students;
use App\Models\Working_papers;
use App\Models\Working_papers_section;

use Illuminate\Support\Facades\Validator;
use PhpParser\Builder\Class_;

class SectionsController extends Controller
{
    //maria---------------------
    public function showSection(Request $request)
    {
        $className = Class_students::where('name','=',$request->className)->get()->first();
        $allSection=Sections::where([['gender','=',$request->gender],['class_student_id','=',$className->id ]])->get(['name','id']);

        return response()->json([
            'data' => $allSection,
            'statusCode'=>200,
            'message'=>'success'
        ]);
    }
//bayan============================================

    public function showSectionDash(Request $request)
    {
        $className = Class_students::where('id','=',$request->className)->get()->first();
        $allSection=Sections::where([['gender','=',$request->gender],['class_student_id','=',$className->id ]])->get(['name','id']);

        return response()->json([
            'data' => $allSection,
            'statusCode'=>200,
            'message'=>'success'
        ]);
    }
    public function index()
    {
        //
    }


    public function create(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:50|string',
            'gender'=>'required|max:50|string',
            'class'=>'required|max:50|string',
            'capacity'=>'required|max:100|numeric|min:1',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $class=Class_students::where('name',$request->input('class'))->first();
            if($class==null){
                return response()->json(['message'=>'wrong data'],400);
            }

            $nam=$request->input('name');
            $gen=$request->input('gender');
            $sect=Sections::where('name',$nam)->where('class_student_id',$class->id)->where('gender',$gen)->first();
            if($sect !=null){
                return response()->json(['message'=>'الشعبة مضافة مسبقا'],400);
            }

            $new=Sections::create([
                'class_student_id'=>$class->id,
                'name'=>$nam,
                'capacity'=>$request->input('capacity'),
                'gender'=>$gen,
            ]);
            return response()->json($new,200);
        }
    }


    public function get_students_withoutSection(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'gender'=>'required|max:50|string',
            'class'=>'required|max:50|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $class=$request->input('class');
            $clas=Class_students::where('name',$class)->first();
            if($clas==null){
                return response()->json(['message'=>'wrong data'],400);
            }
            $gen=$request->input('gender');

            $all_stu=Students::where('newClass',$class)->where('gender',$gen)->where('section_id',NULL)->get();
            $respon=null;
            foreach($all_stu as $one){
                $respon[]=([
                    'id'=>$one->id,
                    'average'=>$one->average,
                    'name'=>"$one->name $one->fatherName $one->nickname",
                ]);
            }
            if($respon==null){      ///if null send null?.......?
                return response()->json(['message'=>'ليس هنالك  طلاب بهذا الصف لا تنتمي لشعبة'],400);
            }
            return response()->json($respon);

        }
    }

    public function show(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'gender'=>'required|max:50|string',
            'class'=>'required|max:50|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $class=Class_students::where('name',$request->input('class'))->first();
            if($class==null){
                return response()->json(['message'=>'wrong data'],400);
            }
            $gen=$request->input('gender');
            $all_suc=Sections::where('class_student_id',$class->id)->get();
            $respon=null;
            foreach($all_suc as $one){
                if(strcmp($one->gender,$gen)==0){
                    $respon[]=([
                        'id'=>$one->id,
                        'name'=>$one->name,
                        'capacity'=>$one->capacity,
                    ]);
                }
            }
            if($respon==null){      ///if null send null?.......?
                return response()->json(['message'=>'ليس هنالك شعب مضافة'],400);
            }
            return response()->json($respon);
        }
    }

    public function add_studentToSection(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:50|string',
            'gender'=>'required|max:50|string',
            'class'=>'required|max:50|string',
            'students'=>'required',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $class=Class_students::where('name',$request->input('class'))->first();
            if($class==null){
                return response()->json(['message'=>'wrong data'],400);
            }

            $section=Sections::where('name',$request->input('name'))->where('class_student_id',$class->id)->where('gender',$request->input('gender'))->first();
            if($section==null){
                return response()->json(['message'=>'wrong '],400);
            }

            $capaci= $section->capacity;
            $numstu=Students::where('section_id',$section->id)->get()->count();
            $able=$capaci-$numstu;
            if($able ==0){
                return response()->json(['message'=>'the section is full  '],400);
            }

            $students=$request->students;

            //    if($request->sections!=null)
            if($students!=null)
            {
                $i=count($students);
                if($i >$able){
                    return response()->json(['message'=>'the student num more than the section capacity  '],400);
                }
                //      $section=json_decode($request['sections'],true);
                foreach ($students as $s)
                {

                    $stud=Students::find($s);
                    $stud->section_id=$section->id;
                    $stud->save();
                }
            }
            else{
                return response()->json(['message'=>'wrong data no student'],400);
            }
            return response()->json('students added to section successfully',200);
        }
    }
    public function update(Request $request, Sections $sections)
    {
        //
    }


    public function destroy(Request $request){
        $section=Sections::find($request->section_id);
        if($section==null){
            return response()->json('error section not fond',400);
        }
        ///delete section ads
        /* $sectionAds=Section_ads::where('sections_id',$section->id)->get();               ////////////////
         foreach($sectionAds as $one){
             $ads=Ads::find($one->ad_id);
             $num_sec_ads=$ads->section_ads->count();
             Section_ads::destroy($one->id);
             if($num_sec_ads==1){
                 Ads::destroy($ads->id);
             }
         }*/
        ///DELETE section work papers

        $sectionWorkP=Working_papers_section::where('section_id',$section->id);

        foreach($sectionWorkP as $one){
            $workP=Working_papers::find($one->working_papers_id);
            $num_sec_workp=$workP->working_papers->count();
            Working_papers_section::destroy($one->id);
            if($num_sec_workp==1){
                Working_papers::destroy($workP->id);
            }
        }
        ///detach students from this section
        $sectionStud=$section->Section_students;
        foreach($sectionStud as $one){
            $one->section_id=null;
            $one->save();
        }
        ///delet section
        Sections::destroy($section->id);
        return response()->json('section deleted successfully',200);
    }
}
