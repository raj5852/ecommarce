@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }} </div>
                    @endforeach
                </div>
            @endif


            <div class="card">
                <div class="card-header">
                    <h3>Edit User
                        <a href="{{ url('admin/users') }}" class="btn btn-danger btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/users/'.$user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="text" name="email" readonly value="{{ $user->email}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Select Role</label>
                                <select name="role_as" id="" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="0" {{ $user->role_as == '0'?'selected':'' }}>Usser</option>
                                    <option value="1" {{ $user->role_as == '1'?'selected':'' }}>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
