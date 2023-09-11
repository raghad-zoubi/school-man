<?php

namespace App\Http\Controllers;

use App\Models\Class_students;
use App\Models\Sections;
use App\Models\Subjects;
use App\Models\Working_papers;
use App\Models\Working_papers_section;
use App\Models\Working_papers_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WorkingPapersSectionController extends Controller
{

    public function show_studen($type)
    {
//        ['name' => 'advices'],
//        ['name' => 'records'],
//        ['name' => 'testpaper'],
//        ['name' => 'workpaper'],


        $result2= DB::table('working_papers_sections')
            ->join('students', 'working_papers_sections.section_id', '=', 'students.section_id')
          //  ->join('sections', 'working_papers_sections.section_id', '=', 'sections.id')
            ->join('working_papers','working_papers_sections.working_papers_id','=','working_papers.id')
            ->join('working_papers_types','working_papers.working_papers_type_id','=','working_papers_types.id')
            ->where('students.id','=',auth()->user()->id)
            ->where('working_papers_types.name','=',$type)
            ->select('working_papers.*')
            ->get();

        return response()->json(
            $result2,
        );


    }


    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'file'=>'required',
            'type'=>'required|max:191|string',
            'gender'=>'required|max:50|string',
            'class'=>'required|max:50|string',
            'subject'=>'required|max:50|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $class=$request->input('class');
            $clas=Class_students::where('name',$class)->first();
            if($clas==null){
                return response()->json(['message'=>'wrong data class'],400);
            }
            $type=$request->input('type');
            $typ=Working_papers_type::where('name',$type)->first();
            if($typ==null){
                return response()->json(['message'=>'this type not add'],400);
            }

            $sub=Subjects::where('name',$request->input('subject'))->first();
            if($sub==null){
                return response()->json(['message'=>'wrong data subject'],400);
            }
            $fil=time(). "-". $request->name ."-".$request->file->extension();
            $fil=$request->file('file')->store('workpapersFile','public');     ////
            $request->file->move(public_path('workpapersFile'),$fil);
            $new=Working_papers::create([
                //    'class_student_id'=>$class->id,
                'text'=>$fil,
                'title'=>"newwwww",
                'subject_id'=>$sub->id,
                'working_papers_type_id'=>$typ->id,
            ]);

            $sections=$request->sections;
            //    if($request->sections!=null)
            if($sections!=null)
            {
                //  $section=json_decode($request['sections'],true);
                foreach ($sections as $s)
                {
                    $section=Sections::where('name',$s)->where('class_student_id',$clas->id)->where('gender',$request->input('gender'))->first();
                    $new_work_section=Working_papers_section::create([
                        'section_id'=>$section->id,
                        'working_papers_id'=>$new->id,
                    ]);
                }
            }
            else{
                return response()->json(['message'=>'wrong data null'],400);
            }
            return response()->json($new,200);
        }
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Working_papers_section  $working_papers_section
     * @return \Illuminate\Http\Response
     */
    public function show(Working_papers_section $working_papers_section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Working_papers_section  $working_papers_section
     * @return \Illuminate\Http\Response
     */
    public function edit(Working_papers_section $working_papers_section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Working_papers_section  $working_papers_section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Working_papers_section $working_papers_section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Working_papers_section  $working_papers_section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Working_papers_section $working_papers_section)
    {
        //
    }
}
