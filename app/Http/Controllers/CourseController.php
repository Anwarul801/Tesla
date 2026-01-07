<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 15:00:04
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-07 14:43:55
 * @Description: Innova IT
 */

namespace App\Http\Controllers;
use App\Services\CourseService;
use App\Models\Course;
use App\Models\Book;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {

       $data['items'] = $this->service->getAll($request);
       $data['request']=$request;
       $data['books'] = Book::where('status','Active')->get();

        return view('backend.course.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       $data['request']=$request;
       $data['page_type']='create';
       $data['books'] = Book::where('status','Active')->get();

        return view('backend.course.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $this->service->store($data);

        return redirect()
            ->route('course.index')
            ->with('success', 'Course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
         $modules = Module::where('course_id',$course->id)->get();

         $course_info = $course;
        return view('backend.course.module', compact('course_info', 'modules'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Course $course)
    {
       $data['request']=$request;
       $data['course']=$course;
       $data['page_type']='edit';
       $data['books'] = Book::where('status','Active')->get();

        return view('backend.course.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $this->validatedData($request);
        $this->service->update($course, $data);

        return redirect()
            ->route('course.index')
            ->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

     private function validatedData(Request $request): array
    {
        return $request->validate([
            'name'              => 'required|string|max:255',
            'book_id'           => 'nullable|integer',
            'price'             => 'nullable|integer',
            'discount'          => 'nullable|integer',
            'order'             => 'nullable|integer',
            'status'            => 'required|in:Active,Inactive',
            'promo_video'       => 'nullable|string',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'banner'    => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'document'  => 'nullable|file|mimes:pdf,doc,docx',
        ]);
    }
}
