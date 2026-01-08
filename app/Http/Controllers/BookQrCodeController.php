<?php

namespace App\Http\Controllers;

use App\Models\BookQrCode;
use Illuminate\Http\Request;
use App\Services\BookQrCodeService;

class BookQrCodeController extends Controller
{
    protected $BookQrCodeService;

    public function __construct(BookQrCodeService $BookQrCodeService)
    {
        $this->BookQrCodeService = $BookQrCodeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['book_id', 'status']);
        $data['books'] = $this->BookQrCodeService->list($filters);
        $data['request'] = $request;
        return view('backend.book.book_qr_codes', $data);
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
        //
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
    public function destroy(BookQrCode $bookQrCode)
    {
        //
    }
}
