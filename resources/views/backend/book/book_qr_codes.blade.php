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
                    <a href="{{ route('book.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left"></i> Back To Books
                    </a>
                    <button type="button" class="btn btn-outline-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#createModal"
                            >
                        <i class="fa fa-plus-circle"></i> {{ __('Add New') }}
                    </button>

                </div>
            </div>
        </div>

        <div class="card-body form-body">

            <table class="table table-bordered table-striped text-center" style="width:100%">
                <thead>
                <tr class="main_title">
                    <th>#</th>
                    <th>{{ __('Book ') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('File') }}</th>
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
                        <td>{{ $book_qr_code->name ?? 'N/A' }}</td>
                        <td>
                            @if($book_qr_code->file)
                                <a target="_blank" href="{{asset($book_qr_code->file)}}" class="btn btn-sm btn-outline-dark"> <i class="fa fa-file"></i></a>
                            @else
                                N/A
                            @endif
                        </td>
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
                                    <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $book_qr_code->id }}">
                                       <i class="fa fa-edit"></i> Edit
                                    </button>

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

                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{$book_qr_code->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Book File</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('book_qr_code.update', $book_qr_code->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="book_id" value="{{ request('book_id') }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name{{$book_qr_code->id}}">Name *</label>
                                            <input type="text" id="name{{$book_qr_code->id}}" name="name" class="form-control" required value="{{$book_qr_code->name}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="file{{$book_qr_code->id}}">File / PDF</label>
                                            <input type="file" accept="application/pdf" id="file{{$book_qr_code->id}}" name="file" class="form-control">
                                            @if(!empty($book_qr_code->file))
                                                <div class="mt-2 d-flex gap-3">
                                                    <a target="_blank"
                                                       href="{{ asset($book_qr_code->file) }}"
                                                       class="btn btn-sm btn-outline-dark ms-2">
                                                        <i class="fa fa-eye"></i> View Current File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="order{{$book_qr_code->id}}">Order *</label>
                                            <input type="text" id="order{{$book_qr_code->id}}" name="order" class="form-control" required value="{{$book_qr_code->order}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="file{{$book_qr_code->id}}">Status *</label>
                                            <select name="status" id="status{{$book_qr_code->id}}" class="form-control">
                                                <option value="Active" {{$book_qr_code->status=='Active'?'selected':''}}>Active</option>
                                                <option value="In-Active" {{$book_qr_code->status=='In-Active'?'selected':''}}>In-Active</option>
                                            </select>
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
                @empty
                    <tr>
                        <td colspan="100">No Data Found!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New File</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('book_qr_code.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ request('book_id') }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="file">File / PDF *</label>
                            <input type="file" accept="application/pdf" id="file" name="file" class="form-control" required>
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
