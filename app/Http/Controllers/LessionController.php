<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FileCustomizeTrait;
use App\Models\Lession;
class LessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
           'module_id' => 'required',
           'title' => 'required',
        ]);
        $preview = 2;
        if ($request->is_free){
            $preview = 1;
        }

        $lession = new Lession();
        $lession->module_id = $request->module_id;
        $lession->title = $request->title;
        if( $lession->type = 'video'){
            $lession->video_type = $request->video_type;
            $lession->link = $request->link;
        }
        if( $lession->type = 'docs'){
            if($request->hasFile('document')){
                $file = $request->file('document') ;
                $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/storage/document/' ;
                $file->move($destinationPath,$fileName);
                $lession->document = '/storage/document/'.$fileName;
            }
        }

        if( $lession->type = 'quiz'){
            $lession->mark = $request->mark;
            $lession->duration = $request->duration;
            $lession->description = $request->description;
        }
        $lession->course_id = $request->course_id;
        $lession->type = $request->type;
        $lession->description = $request->description;
        $lession->is_free = $preview;
        $lession->save();

         return back()->with('success', 'Lession Create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);


        $lession = Lession::find($id);
        $oldPDF = $lession->document;
        if ($request->is_free){
            $preview = 1;
        }else{
            $preview = 2;
        }
        $lession->title = $request->title;
        if( $lession->type = 'video'){
            $lession->link = $request->link;

        }
        if( $lession->type = 'docs'){

            if($request->hasFile('document')){
                $file = $request->file('document') ;
                $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/storage/document/' ;
                $file->move($destinationPath,$fileName);
                $lession->document = '/storage/document/'.$fileName;
            }else{
                $lession->document =$oldPDF;
            }

            if($request->hasFile('document')){
                FileCustomizeTrait::deleteFile($oldPDF);
            }

        }

        if( $lession->type = 'quiz'){
            $lession->mark = $request->mark;
            $lession->duration = $request->duration;
            $lession->description = $request->description;
        }
        $lession->type = $request->type;
        // $lession->started_time = $request->started_time??NULL;
        // $lession->end_time = $request->end_time??NULL;
        $lession->description = $request->description;
        $lession->is_free = $preview;
        $lession->save();

         return back()->with('success', 'Lession updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lession $lession)
    {
       // $lession->users()->detach();
        $lession->delete();
         return back()->with('success', 'Lession Deleted successfully');
    }
}
