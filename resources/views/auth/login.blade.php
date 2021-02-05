@extends('layouts.main')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="" class="h1"><b>Final</b> Project</a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Sign in to start!</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            @if(session('status'))
            <div class="bg-red p-4 rounded-lg mb-6 text-white text-center">
                {{ session('status') }}
            </div>
            @endif
            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') border-red @enderror" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" >
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>

            </div>
            @error('email')
            <div class="text-red mt-2 text-sm mb-2">
                {{ $message }}
            </div>
            @enderror
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') border-red @enderror" name="password" id="password" placeholder="Your Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

            </div>
            @error('password')
            <div class="text-red mt-2 text-sm mb-2">
                {{ $message }}
            </div>
            @enderror
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember">Remember Me</label>
                </div>
            </div>
            <div class="social-auth-links text-center mt-2 mb-3">
                <button class="btn btn-block btn-primary"><i class="fab fa-login mr-2"></i> Login </button>
            </div>
        </form>

    </div>
    <!-- /.card-body -->
</div>
@endsection
