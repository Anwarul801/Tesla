<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 16:47:39
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-08 14:13:50
 * @Description: Innova IT
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FileCustomizeTrait;
use App\Models\Lesson;
class LessonController extends Controller
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

        $lesson = new Lesson();
        $lesson->module_id = $request->module_id;
        $lesson->title = $request->title;
        if( $lesson->type = 'video'){
            $lesson->video_type = $request->video_type;
            $lesson->link = $request->link;
        }
        if( $lesson->type = 'docs'){
            if($request->hasFile('document')){
                $file = $request->file('document') ;
                $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/storage/document/' ;
                $file->move($destinationPath,$fileName);
                $lesson->document = '/storage/document/'.$fileName;
            }
        }

        if( $lesson->type = 'quiz'){
            $lesson->mark = $request->mark;
            $lesson->duration = $request->duration;
            $lesson->description = $request->description;
        }
        $lesson->course_id = $request->course_id;
        $lesson->type = $request->type;
        $lesson->description = $request->description;
        $lesson->is_free = $preview;
        $lesson->save();

         return back()->with('success', 'Lesson Create successfully');
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


        $lesson = Lesson::find($id);
        $oldPDF = $lesson->document;
        if ($request->is_free){
            $preview = 1;
        }else{
            $preview = 2;
        }
        $lesson->title = $request->title;
        if( $lesson->type = 'video'){
            $lesson->link = $request->link;

        }
        if( $lesson->type = 'docs'){

            if($request->hasFile('document')){
                $file = $request->file('document') ;
                $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/storage/document/' ;
                $file->move($destinationPath,$fileName);
                $lesson->document = '/storage/document/'.$fileName;
            }else{
                $lesson->document =$oldPDF;
            }

            if($request->hasFile('document')){
                FileCustomizeTrait::deleteFile($oldPDF);
            }

        }

        if( $lesson->type = 'quiz'){
            $lesson->mark = $request->mark;
            $lesson->duration = $request->duration;
            $lesson->description = $request->description;
        }
        $lesson->type = $request->type;
        // $lesson->started_time = $request->started_time??NULL;
        // $lesson->end_time = $request->end_time??NULL;
        $lesson->description = $request->description;
        $lesson->is_free = $preview;
        $lesson->save();

         return back()->with('success', 'Lesson updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
       // $lesson->users()->detach();
        $lesson->delete();
         return back()->with('success', 'Lesson Deleted successfully');
    }
}
