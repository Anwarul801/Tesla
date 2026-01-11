<?php

namespace App\Http\Controllers;

use App\Models\BookQrCode;
use App\Services\BookService;
use Illuminate\Http\Request;
use App\Services\BookQrCodeService;

class BookQrCodeController extends Controller
{
    protected $BookQrCodeService;
    protected $BookService;

    public function __construct(BookQrCodeService $BookQrCodeService, BookService $BookService)
    {
        $this->BookQrCodeService = $BookQrCodeService;
        $this->BookService = $BookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['book_id','name', 'status']);
        $book_filters = ['status' => 'Active'];
        $data['book_qr_codes'] = $this->BookQrCodeService->list($filters);
        $data['request'] = $request;
        $data['books'] = $this->BookService->list($book_filters);
        return view('backend.book.book_qr_codes', $data);
    }

    public function print_book_qr_codes(Request $request)
    {
        $filters = $request->only(['book_id','name','id', 'status']);
        $data['qrs'] = $this->BookQrCodeService->getQrs($filters);
        return view('backend.book.print_book_qr_codes', $data);
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
      $data =  $request->validate([
            'book_id' => 'required|exists:books,id',
            'name'    => 'required|string|max:255|unique:book_qr_codes,name',
            'amount'   => 'required|numeric',
        ]);
        try {
            $this->BookQrCodeService->create($data);
            return redirect()->route('book_qr_code.index')->withSuccess('Book QR Codes created successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BookQrCode $bookQrCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookQrCode $bookQrCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookQrCode $bookQrCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->BookQrCodeService->delete($id);
            return redirect()->route('book_qr_code.index')->withSuccess('Book QR Code deleted successfully.');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

}
