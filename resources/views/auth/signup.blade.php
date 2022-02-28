@extends('layouts.master')

@section('container')

	<h1>Signup</h1>

	<hr>

	<form method="post" action="{{ route('postSignup') }}" autocomplete="on">

		@csrf

		<div class="mb-3">
			<label for="input_email" class="form-label">Name:</label>
			<input id="input_email" type="text" class="form-control" name="name">
		</div>

		<div class="mb-3">
			<label for="input_email" class="form-label">Email:</label>
			<input id="input_email" type="email" class="form-control" name="email">
		</div>

		<div class="mb-3">
			<label for="input_password" class="form-label">Password:</label>
			<input id="input_password" type="password" class="form-control" name="password">
		</div>

		<div class="mb-3">
			<label for="input_password" class="form-label">Password confirmation:</label>
			<input id="input_password" type="password" class="form-control" name="password_confirmation">
		</div>

		<button type="submit" class="btn btn-primary">
			<i class="fa fa-check"></i> Signup
		</button>

	</form>

@endsection
