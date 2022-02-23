@extends('layouts.master')

@section('container')

	<h1>Login</h1>

	<hr>

	<form method="post" action="{{ route('postLogin') }}" autocomplete="on">

		@csrf

		<div class="mb-3">
			<label for="input_email" class="form-label">Email:</label>
			<input id="input_email" type="email" class="form-control" name="email">
		</div>

		<div class="mb-3">
			<label for="input_password" class="form-label">Password:</label>
			<input id="input_password" type="password" class="form-control" name="password">
		</div>

		<div class="form-check mb-3">
			<input class="form-check-input" type="checkbox" id="check_remember_me" name="remember_me">
			<label class="form-check-label" for="check_remember_me">Remember me</label>
		</div>

		<button type="submit" class="btn btn-primary">
			<i class="fa fa-check"></i> Login
		</button>

	</form>

@endsection
