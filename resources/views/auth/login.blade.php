@extends('layouts.main')

@section('content')
    @if (session('success'))
    <x-flash type='success' :message="session('success')" />
    @elseif (session('error'))
    <x-flash type='danger' :message="session('error')" />
    @endif

    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Login Form</h1>
        </div>
        <div class="card-body">
            <form action="{{url('login')}}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus>
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control @error('email') is-invalid @enderror" id="password" placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mini-note">
                    <p class="text-muted">Belum punya akun? <a class="text-decoration-none" href="{{ url('register')}}">Daftar Disini</a></p class="text-muted">
                </div>
                <x-btn-block color='primary' message='Login'/>
            </form>
            <div class="mt-3 d-grid">
                <a class="btn btn-dark" href="{{ url('/login/github') }}">Login Github</a>
            </div>
        </div>
    </div>
@endsection
