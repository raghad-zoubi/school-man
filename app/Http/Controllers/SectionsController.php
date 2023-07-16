<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Class_students;
use App\Models\Section_ads;
use App\Models\Sections;
use App\Models\Students;
use App\Models\Working_papers;
use App\Models\Working_papers_section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder\Class_;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

            $new=Sections::create([
                'class_student_id'=>$class->id,
                'name'=>$request->input('name'),
                'capacity'=>$request->input('capacity'),
                'gender'=>$request->input('gender'),
            ]);
            return response()->json($new,200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

            $all_stu=Students::where('newClass',$class)->where('gender',$gen)->where('section_id',null);
            $respon=null;
            foreach($all_stu as $one){
                $respon[]=([
                    'id'=>$one->id,
                    'average'=>$one->average,
                    'name'=>$one->name,
                ]);
        }
        if($respon==null){      ///if null send null?.......?
            return response()->json(['message'=>'ليس هنالك  طلاب بهذا الصف لا تنتمي لشعبة'],400);
        }
        return response()->json($respon);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
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
            $all_suc=$class->sections;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
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

            $section=Sections::where('name',$request->input('subject'))->where('class_student_id',$class->id)->where('gender',$request->input('gender'))->first();
            if($section==null){
                return response()->json(['message'=>'wrong data'],400);
            }

            $students=$request->students;
            //    if($request->sections!=null)
            if($students!=null)
                {
              //      $section=json_decode($request['sections'],true);
                    foreach ($students as $s)
                    {
                        $stud=Students::find($s);
                    $stud->quantity=$section->id;
                    $stud->save();
                }
            }
            else{
                return response()->json(['message'=>'wrong data no student'],400);
            }
            return response()->json('students added to section successfully',200);
    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sections $sections)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $section=Sections::find($request->section_id);
        if($section==null){
            return response()->json('error section not fond',400);
        }
        ///delete section ads
        $sectionAds=$section->Section_ads;
        foreach($sectionAds as $one){
            $ads=Ads::find($one->ad_id);
            $num_sec_ads=$ads->section_ads->count();
            Section_ads::destroy($one->id);
            if($num_sec_ads==1){
                Ads::destroy($ads->id);
            }
        }
        ///DELETE section work papers
        $sectionWorkP=$section->workpapers_Section;
        foreach($sectionWorkP as $one){
            $workP=Working_papers::find($one->working_papers_id);
            $num_sec_workp=$workP->working_papers->count();
            Working_papers_section::destroy($one->id);
            if($num_sec_workp==1){
                Working_papers::destroy($workP->id);
            }
        }
        ///detach students from this section
        ////
        ///delet section
        Sections::destroy($section->id);
        return response()->json('section deleted successfully',200);
    }
}
