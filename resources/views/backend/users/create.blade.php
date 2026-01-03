@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="">Add new user</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title mb-4">Add new user and assign role.</h5>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}"
                           type="email"
                           class="form-control"
                           name="email"
                           placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input value="{{ old('phone') }}"
                           type="text"
                           class="form-control"
                           name="phone"
                           placeholder="Phone" required>
                    @if ($errors->has('phone'))
                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input value="{{ old('password') }}"
                           type="text"
                           class="form-control"
                           name="password"
                           placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control"
                            name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            @php $role_name = strtolower($role->name) @endphp
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-outline-info">Save user</button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-dark">Back</a>
            </form>
        </div>
    </div>
@endsection
