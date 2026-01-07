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
                <div class="col-md-2 mb-2">
                    <label>{{ __('Status') }}</label>
                    <select form="search_form" name="status" class="form-control">
                        <option value="" disabled selected>Search By Status</option>
                        <option value="Active" {{ $request->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="In-Active" {{ $request->status == 'In-Active' ? 'selected' : '' }}>In-Active</option>
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
            <table class="table table-bordered table-striped text-center" style="width:100%">
                <thead>
                <tr class="main_title">
                    <th>#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Discount') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
                </thead>

                <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>
                            {{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $book->name ?? 'N/A' }}</td>
                        <td>{{ $book->price ?? '-' }}</td>
                        <td>{{ $book->discount ?? '-' }}</td>
                        <td>
                    <span class="badge bg-{{ $book->status === 'Active' ? 'success' : 'danger' }}">
                        {{ $book->status }}
                    </span>
                        </td>
                        <td>
                            @if($book->image)
                                <a target="_blank" href="{{asset($book->image)}}" class="btn btn-sm btn-outline-dark"> <i class="fa fa-image"></i></a>
                            @else
                                N/A
                            @endif
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
                                    <a class="dropdown-item"
                                       href="{{ route('book.show', $book->id) }}">
                                      <i class="fa fa-eye"></i>  View Details
                                    </a>
                                    <a class="dropdown-item"
                                       href="{{ route('book.edit', $book->id) }}">
                                       <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('book.destroy', $book->id) }}"
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

            {{ $books->appends(request()->input())->links() }}
        </div>
    </div>



@endsection
