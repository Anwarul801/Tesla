<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Imports\ImportQuestion;
use App\Traits\FileCustomizeTrait;
use App\Models\QuizQuestion;
use App\Models\Lesson;
class QuizQuestionController extends Controller
{
    public function index(Request $request)
    {
        $search_result = $this->form_search($request);
        $questions = QuizQuestion::with('lesson')->where($search_result)->orderby('created_at','DESC')->paginate(20);
        $quiz_list = Lesson::with('module','course')->where('type','Quiz')->get();

        return view('backend.quiz_question.index',compact('questions','quiz_list','request'));
    }

    private function form_search($request){
        $search_items = [];

        if ($request->name){
            $search_items[] = ['name', 'like', '%' . $request->name . '%'];
        }
        if ($request->option1){
            $search_items[] = ['option1', 'like', '%' . $request->option1 . '%'];
        }
        if ($request->option2){
            $search_items[] = ['option2', 'like', '%' . $request->option2 . '%'];
        }
        if ($request->option3){
            $search_items[] = ['option3', 'like', '%' . $request->option3 . '%'];
        }
        if ($request->option4){
            $search_items[] = ['option1', 'like', '%' . $request->option4 . '%'];
        }
        if ($request->lesson_id){
            $search_items[] = ['lesson_id', $request->lesson_id];
        }
        if ($request->mark){
            $search_items[] = ['mark', $request->mark];
        }

        return $search_items;

    }


    public function import_question(Request $request){
        $request->validate([
            'lesson_id' => 'required',
            'quiz_question' => 'required',
        ]);

        Excel::import(new ImportQuestion($request->lesson_id), $request->file('quiz_question'));
        return back()->with('success', 'Data updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $page_type = 'create';
        $quiz_list = Lesson::with('module','course')->where('type','Quiz')->get();
        return view('backend.quiz_question.form',compact('quiz_list','request','page_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required',
        ]);
        $lession = Lesson::with('question')->where('id',$request->lesson_id)->first();
        $question = new QuizQuestion();
        $question->lesson_id = $request->lesson_id;
        $question->course_id = $lession->course_id;
        $question->module_id = $lession->module_id;
        $question->name = $request->name;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->option4 = $request->option4;
        $question->mark = $request->mark;
        $question->correct_answers = $request->correct_answers;
        $question->notes = $request->notes;

        if (empty($lession->question)){
            $question->order = 1;
        }else{
            $question->order = $lession->question->order +1;
        }
        $question->save();
      return redirect()->route('quiz_question.index')->with('success', 'Data Add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestion $question)
    {
        //
    }

    function order_change(Request $request)
    {

        $id = $request->id;
        $question =  QuizQuestion::where('id', $request->id)->first();
        $question->order = $request->order;
        $question->save();
        $data= array();
        $data['order'] =$request->order;

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,QuizQuestion $question,$id)
    {
         $page_type = 'edit';
         $question = QuizQuestion::with('lesson')->where('id',$id)->first();

         $quiz_list = Lesson::with('module','course')->where('type','Quiz')->get();
         return view('backend.quiz_question.form',compact('quiz_list','request','page_type','question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'lesson_id' => 'required',
        ]);
       $lession = Lesson::where('id',$request->lesson_id)->first();
        $question = QuizQuestion::where('id',$request->id)->first();
        $question->lesson_id = $request->lesson_id;
        $question->course_id = $lession->course_id;
        $question->module_id = $lession->module_id;
        $question->name = $request->name;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->option4 = $request->option4;
        $question->mark = $request->mark;
        $question->correct_answers = $request->correct_answers;
        $question->notes = $request->notes;

        $question->save();
       return redirect()->route('quiz_question.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizQuestion $question,$id)
    {
        $question = QuizQuestion::where('id',$id)->first();
        $question->delete();
        return back()->with('success', 'Data Deleted successfully');
    }
}
