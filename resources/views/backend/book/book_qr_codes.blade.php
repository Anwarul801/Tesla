@extends('layouts.app')
@section('page_title')
    Book Qr Codes
@endsection
@section('content')
    <style>
        #datatable-buttons_info,
        #datatable-buttons_paginate,
        #datatable-buttons_filter {
            display: none;
        }
    </style>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5>{{ __('Manage Book Qr Codes') }}</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('book.index') }}" class="btn btn-success">
                        <i class="fa fa-arrow-left"></i> Back To Books
                    </a>
                    <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#createModal"
                            >
                        <i class="fa fa-plus-circle"></i> {{ __('Generate') }}
                    </button>

                </div>
            </div>
        </div>

        <div class="card-body form-body">
            <form action="" method="get" id="search_form"></form>
            <form action="{{route('book_qr_code.print')}}" target="_blank" id="printForm">
                <input type="hidden" name="book_id" value="{{ $request->book_id }}">
                <input type="hidden" name="name" value="{{ $request->name }}">
                <input type="hidden" name="status" value="{{ $request->status }}">
            </form>
            <div class="row mb-3">
                <div class="col-md-3 mb-2">
                    <label>{{ __('Book') }}</label>
                    <select form="search_form" name="book_id" class="form-control">
                        <option value="" disabled selected>Search By Book</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ $request->book_id == $book->id ? 'selected' : '' }}>{{ $book->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label>{{ __('Code Name') }}</label>
                    <input type="text" value="{{ $request->name }}" name="name" class="form-control"
                           placeholder="Search By Name" form="search_form">
                </div>
                <div class="col-md-2 mb-2">
                    <label>{{ __('Status') }}</label>
                    <select form="search_form" name="status" class="form-control">
                        <option value="" disabled selected>Search By Status</option>
                        <option value="Active" {{ $request->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Used" {{ $request->status == 'Used' ? 'selected' : '' }}>Used</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label>{{ __('Action') }}</label>
                    <br>
                    <button class="btn btn-outline-dark" form="search_form" type="submit">
                        <span class="fa fa-search"></span> Search
                    </button>
                    <a href="{{ route('book_qr_code.index') }}" class="btn btn-outline-danger">Reset</a>
                    <button class="btn btn-outline-dark" form="printForm" type="submit">
                        <span class="fa fa-print"></span> Print
                    </button>
                </div>
            </div>
            <table class="table table-bordered table-striped text-center" style="width:100%">
                <thead>
                <tr class="main_title">
                    <th>#</th>
                    <th>{{ __('Book Name') }}</th>
                    <th>{{ __('Code Name') }}</th>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
                </thead>

                <tbody>
                @forelse($book_qr_codes as $book_qr_code)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $book_qr_code->book->name ?? 'N/A' }}</td>
                        <td>{{ $book_qr_code->name ?? 'N/A' }}</td>
                        <td>{{ $book_qr_code->code_id ?? 'N/A' }}</td>

                        <td>
                            <span class="badge bg-{{ $book_qr_code->status === 'Active' ? 'success' : 'danger' }}">
                                {{ $book_qr_code->status }}
                            </span>
                        </td>

                        {{-- Action --}}
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle"
                                        type="button"
                                        data-bs-toggle="dropdown">
                                    Action
                                </button>

                                <div class="dropdown-menu">
                                    <a href="{{route('book_qr_code.print')}}?id={{$book_qr_code->id}}" target="_blank" class="dropdown-item">
                                       <i class="fa fa-print"></i> Print
                                    </a>

                                    <form action="{{ route('book_qr_code.destroy', $book_qr_code->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="dropdown-item text-danger"
                                                onclick="return confirm('Are you sure to delete?')">
                                           <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100">No Data Found!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $book_qr_codes->appends(request()->input())->links() }}
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Generate New QR Code</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('book_qr_code.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="book">Book *</label>
                            <select name="book_id" id="book" class="form-control">
                                <option value="" selected disabled>Select book</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name">Code Name *</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount">Amount *</label>
                            <input type="number" id="amount" name="amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
