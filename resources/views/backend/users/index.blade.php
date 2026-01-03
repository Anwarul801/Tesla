@extends('layouts.app')
{{--
 @Author: Anwarul
 @Date: 2025-11-17 18:12:54
 @LastEditors: Anwarul
 @LastEditTime: 2025-11-17 18:28:02
 @Description: Innova IT
--}}

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-0"> Users </h5>
            </div>
            <div class="col-md-6">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
            </div>
        </div>
    </div>

    <div class="card-body">

        <form action="" method="GET" class="pb-5">
            <div class="row form-group">
                <div class="col-sm mb-2">
                    <input type="text" class="form-control" name="name" value="{{ $request->name }}" placeholder="Enter Name">
                </div>

                <div class="col-sm mb-2">
                    <input type="text" class="form-control" name="email" value="{{ $request->email }}" placeholder="Enter Email">
                </div>

                <div class="col-sm mb-2">
                    <input type="text" class="form-control" name="phone" value="{{ $request->phone }}" placeholder="Enter Phone">
                </div>

                <div class="col-sm mb-2">
                    <input type="submit" class="btn btn-dark pull-right" value="Search">
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Roles</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->user_type }}</td>

                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a>
                        </td>

                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                        </td>

                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}"
                                  method="POST"
                                  style="display:inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure to delete this user?')">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex">
            {!! $users->links() !!}
        </div>
    </div>
</div>

@endsection
