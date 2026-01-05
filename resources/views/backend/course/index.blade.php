@extends('layouts.app')
@section('page_title')
    Course List
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5>{{ __('Manage Course') }}</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a type="button" href="{{ route('course.create') }}" class="btn btn-outline-info waves-effect waves-light">
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
                    <label>{{ __('Book') }}</label>
                    <select form="search_form" name="book_id" class="form-control">
                        <option value=""  selected>Search By Book</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ $request->book_id == $book->id ? 'selected' : '' }}>
                                {{ $book->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-2">
                    <label>{{ __('Action') }}</label>
                    <br>
                    <button class="btn btn-outline-dark" form="search_form" type="submit">
                        <span class="fa fa-search"></span> Search
                    </button>
                    <a href="{{ route('course.index') }}" class="btn btn-outline-danger">Reset</a>
                </div>
            </div>

            <table class="table text-center" style="width: 100%;">
                <thead>
                <tr class="main_title">
                    <th>#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Book') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ ($items->currentpage() - 1) * $items->perpage() + $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->book->name ?? 'N/A' }}</td>
                        <td>{{ $item->price}}</td>
                        <td>{{ $item->status}}</td>

                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Action</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" data-bs-toggle="modal"
                                       data-bs-target="#editModal{{ $item->id }}">Edit</a>
                                    <form action="{{ route('course.destroy', $item->id) }}" method="POST">
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
            {{ $items->appends(request()->input())->links() }}
        </div>
    </div>

@endsection
