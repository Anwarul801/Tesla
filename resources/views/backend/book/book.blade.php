@extends('layouts.app')
@section('page_title')
    Books
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
                    <h5>{{ __('Manage Books') }}</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{route('book.create')}}" class="btn btn-outline-info waves-effect waves-light"
                            >
                        <i class="fa fa-plus-circle"></i> {{ __('Add New') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body form-body">
            <form action="" method="get" id="search_form"></form>
            <div class="row mb-3">
                <div class="col-md-3 mb-2">
                    <label>{{ __('Name') }}</label>
                    <input type="text" value="{{ $request->name }}" name="name" class="form-control"
                           placeholder="Search By Name" form="search_form">
                </div>
                <div class="col-md-3 mb-2">
                    <label>{{ __('Bangla Name') }}</label>
                    <input type="text" value="{{ $request->bn_name }}" name="bn_name" class="form-control"
                           placeholder="Search By Bangla Name" form="search_form">
                </div>
                <div class="col-md-2 mb-2">
                    <label>{{ __('Status') }}</label>
                    <select form="search_form" name="status" class="form-control">
                        <option value="" disabled selected>Search By Status</option>
                        <option value="1" {{ $request->status == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $request->status == '0' ? 'selected' : '' }}>In-Active</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label>{{ __('Action') }}</label>
                    <br>
                    <button class="btn btn-outline-dark" form="search_form" type="submit">
                        <span class="fa fa-search"></span> Search
                    </button>
                    <a href="{{ route('book.index') }}" class="btn btn-outline-danger">Reset</a>
                </div>
            </div>

            <table class="table table-bordered text-center" style="width: 100%;">
                <thead >
                <tr class="main_title">
                    <th>#</th>
                    <th>{{ __('Country') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Bangla Name') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ ($books->currentpage() - 1) * $books->perpage() + $loop->iteration }}</td>
                        <td>{{ $book->country->name ?? 'N/A' }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->bn_name }}</td>

                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Action</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" data-bs-toggle="modal"
                                       data-bs-target="#editModal{{ $book->id }}">Edit</a>
                                    <form action="{{ route('book.destroy', $book->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"
                                                onclick="return confirm('Are you sure to Delete?')">Delete</button>
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
            {{ $books->appends(request()->input())->links() }}
        </div>
    </div>



@endsection
