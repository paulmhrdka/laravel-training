@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Register Form</h1>
        </div>
        <div class="card-body">
            <form action="{{url('register')}}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="yourname" value="{{ old('name') }}">
                    <label for="name">Name</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" value="{{ old('password') }}">
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="confirm-password" class="form-control @error('confirm-password') is-invalid @enderror" id="confirm-password" placeholder="Password" value="{{ old('confirm-password') }}">
                    <label for="confirm-password">Confirm Password</label>
                    @error('confirm-password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">
                    @error('birthdate')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <span class="form-text">Sudah punya akun? <a class="text-decoration-none" href="{{ url('login')}}">Login Disini</a></span>
                <x-btn-block color='primary' message='Register'/>
            </form>
        </div>
    </div>
@endsection
