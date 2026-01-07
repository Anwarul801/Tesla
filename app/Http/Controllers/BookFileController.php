<?php

namespace App\Http\Controllers;

use App\Models\BookFile;
use Illuminate\Http\Request;
use App\Services\BookFileService;

class BookFileController extends Controller
{
    protected $BookFileService;

    public function __construct(BookFileService $BookFileService)
    {
        $this->BookFileService = $BookFileService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        $data['book_files'] = $this->BookFileService->list($request->book_id);
        return view('backend.book.book_files', $data);
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
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf',
            'order' => 'nullable|integer',
            'status' => 'nullable|in:Active,In-Active',
        ]);
        try {
            $this->BookFileService->create($data);
            return redirect()->back()->withSuccess('Book file created successfully.');
        }catch (\Exception $exception){
            return redirect()->back()->withInput()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BookFile $bookFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookFile $bookFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf',
            'order' => 'nullable|integer',
            'status' => 'nullable|in:Active,In-Active',
        ]);
        try {
            $this->BookFileService->update($id, $data);
            return redirect()->back()->withSuccess('Book file updated successfully.');
        }catch (\Exception $exception){
            return redirect()->back()->withInput()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->BookFileService->delete($id);
            return redirect()->back()->withSuccess('Book file deleted successfully.');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
