@extends('layouts.app')

@section('content')
    <style>
        div.dataTables_wrapper div.dataTables_processing {
            display: none!important;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0"> Users </h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('users.create') }}" class="btn btn-outline-info btn-sm">Add new user</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <table class="table " id="data-table">
                <thead>
                <tr class="main_title">
                    <th scope="col" >#</th>
                    <th scope="col" >Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col" >Roles</th>
                    <th scope="col" class="text-center"  colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
        $(function () {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'role', name: 'role.name'}, // Updated to use the role relation
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>

@endsection
