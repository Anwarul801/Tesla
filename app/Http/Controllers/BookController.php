<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\BookService;

class BookController extends Controller
{
    protected $BookService;

    public function __construct(BookService $BookService)
    {
        $this->BookService = $BookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['books'] = $this->BookService->list();
        $data['request'] = $request;
        return view('backend.book.book', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_type'] = 'Create';
        return view('backend.book.book_create_or_update', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);
        try {
            $this->BookService->create($data);
            return redirect()->route('book.index')->withSuccess('Book created successfully.');
        }catch (\Exception $exception){
            return redirect()->back()->withInput()->withErrors(['error' => $exception->getMessage()]);
        }

    }


    public function validator($request)
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'nullable|numeric',
            'discount'    => 'nullable|numeric',
            'image'       => 'nullable|image',
            'description' => 'nullable|string',
            'document'    => 'nullable|mimes:pdf',
            'promo_video' => 'nullable|string|max:255',
            'type'        => 'nullable|string|max:255',
            'order'       => 'nullable|integer',
            'status'      => 'nullable|string|max:255',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
