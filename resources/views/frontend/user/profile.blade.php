@extends('layouts.app')
@section('title', 'User Profile')


@section('content')
    <div class="py-5 bg-white">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if ($errors->any())
                <ul  class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger"> {{$error}} </li>
                    @endforeach
                </ul>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>User  Profile
                        <a href="{{ url('change-password') }}"  class="btn btn-warning float-end">Change Password ?</a>
                    </h4>
                    <div class="underline"></div>
                </div>
                <div class="col-md-10">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="mb-0 text-white">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('profile') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Username</label>
                                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Email Address</label>
                                            <input type="text" readonly name="eamil" value="{{ auth()->user()->email }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phone" value="{{ Auth::user()->userDetails->phone ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">ZIP/Pin Code</label>
                                            <input type="text" name="pin_code" value="{{ Auth::user()->userDetails->pin_code??'' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Address</label>
                                            <input type="text" name="address" value="{{ Auth::user()->userDetails->address ??'' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit">Save Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
