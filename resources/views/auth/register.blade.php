@extends('theme')
@section('title', 'Регистрация')
@section('content')
    <form class="w-25 m-auto" action="{{ route('register', $user) }}" method="post">
        @csrf
        <img class="mb-4" src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72"
             height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

        <div class="form-floating">
            <input type="text" name="name" id="name" class="form-control rounded-bottom-0" placeholder="Name"
                   value="{{ old('name') }}">
            <label for="name">Name</label>
            @error('name') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="form-floating">
            <input type="text" name="login" id="login" class="form-control rounded-top-0 rounded-bottom-0"
                   placeholder="Login" value="{{ old('login') }}">
            <label for="login">Login</label>
            @error('login') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="form-floating">
            <input type="password" name="password" id="password" class="form-control rounded-top-0 rounded-bottom-0"
                   placeholder="Password">
            <label for="password">Password</label>
            @error('password') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="form-floating">
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control rounded-top-0" placeholder="Password confirmation">
            <label for="password_confirmation">Password confirmation</label>
        </div>

        <div class="form-check text-start my-3">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Remember me</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>

        @error('slot')
        <div class="mt-2 alert alert-danger">{{ $message }}</div>
        @enderror
    </form>
@endsection
