@extends('theme')
@section('title', 'Авторизация')
@section('content')
    <form class="w-25 m-auto" action="{{ route('register', $user) }}" method="post">
        @csrf
        <img class="mb-4" src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <div class="form-floating">
            <input type="text" name="name" class="form-control" id="name">
            <label for="name">Name</label>
        </div>
        <div class="form-floating">
            <input type="text" name="login" class="form-control" id="login">
            <label for="login">Login</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password_confirmation" class="form-control" id="confirm" placeholder="Password">
            <label for="confirm">Confirmation password</label>
        </div>
        <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" name="remember" id="checkDefault">
            <label class="form-check-label" for="checkDefault">Remember me</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    </form>
@endsection
