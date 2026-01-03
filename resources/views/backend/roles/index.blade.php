@extends('layouts.app')
{{--
 @Author: Anwarul
 @Date: 2025-11-17 18:12:54
 @LastEditors: Anwarul
 @LastEditTime: 2025-11-17 18:20:42
 @Description: Innova IT
 --}}

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5>Roles</h5>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('roles.create') }}" class="btn btn-outline-info btn-sm">Add role</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table id="datatable-buttons" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr class="main_title">
                    <th width="1%">No</th>
                    <th>Name</th>
                    <th width="3%" colspan="3">Action</th>
                </tr>
            </thead>

            @foreach ($roles as $key => $role)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $role->name }}</td>

                    <td>
                        <a class="btn btn-outline-info btn-sm" href="{{ route('roles.show', $role->id) }}">
                            Show
                        </a>
                    </td>

                    <td>
                        <a class="btn btn-outline-primary btn-sm ms-1" href="{{ route('roles.edit', $role->id) }}">
                            Edit
                        </a>
                    </td>

                    <td>
                        <form action="{{ route('roles.destroy', $role->id) }}"
                              method="POST"
                              style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger btn-sm ms-1"
                                    onclick="return confirm('Are you sure to delete this role?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>

        <div class="d-flex">
            {!! $roles->links() !!}
        </div>
    </div>
</div>

@endsection
