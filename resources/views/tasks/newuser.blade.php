@extends('layouts.newuser_app')

@section('content')
    <div class="container">
        <h1>Create Account</h1>
        <form>
            <label for="signup-email">Email:</label>
            <input type="email" id="signup-email" name="email" required>
            <label for="signup-password">Password:</label>
            <input type="password" id="signup-password" name="password" required>
            <button type="submit">Sign Up</button>
        </form>
        <div class="login">
            <a href="#">Already have an account? Login</a>
        </div>
    </div>
@endsection
