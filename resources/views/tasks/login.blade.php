@extends('layouts.login_app')

@section('content')
    <div class="container">
        <h1>Login</h1>
        <form>
            <label for="login-email">Email:</label>
            <input type="email" id="login-email" name="email" required>
            <label for="login-password">Password:</label>
            <input type="password" id="login-password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <div class="create-account">
            <a href="#">Create account?</a>
        </div>
    </div>
@endsection
