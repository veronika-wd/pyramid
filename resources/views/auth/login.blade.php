@extends('theme')
@section('title', 'Авторизация')
@section('content')
    <form class="w-25 m-auto" action="{{ route('login') }}" method="post">
        @csrf
        <img class="mb-4" src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72"
             height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="text" name="login" id="login" class="form-control rounded-bottom-0" placeholder="Login"
                   value="{{ old('login') }}">
            <label for="login">Login</label>
        </div>

        <div class="form-floating">
            <input type="password" name="password" id="password" class="form-control rounded-top-0"
                   placeholder="Password">
            <label for="password">Password</label>
        </div>

        <div class="form-check text-start my-3">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Remember me</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>

        @error('auth')
        <div class="mt-2 alert alert-danger">{{ $message }}</div> @enderror
    </form>
@endsection
