<?php

namespace App\Http\Controllers;

use App\Models\Working_papers_type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class WorkingPapersTypeController extends Controller
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
            'name'=>'required|max:191|string',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $name=$request->input('name');
            $type=Working_papers_type::where('name',$name)->first();
            if($type!=null){
                return response()->json(['message'=>'this type was previously added'],400);
            }

            $new=Working_papers_type::create([
                'name'=>$name,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Working_papers_type  $working_papers_type
     * @return \Illuminate\Http\Response
     */
    public function show(Working_papers_type $working_papers_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Working_papers_type  $working_papers_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Working_papers_type $working_papers_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Working_papers_type  $working_papers_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Working_papers_type $working_papers_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Working_papers_type  $working_papers_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Working_papers_type $working_papers_type)
    {
        //
    }
}
