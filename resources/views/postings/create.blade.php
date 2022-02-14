@extends('layouts.master')

@section('container')

	<h1>Create posting</h1>

	<hr>

	<form method="post" action="{{ route('postings.store') }}" autocomplete="off">

		@csrf

		<div class="mb-3">
			<label for="input_title" class="form-label">Title:</label>
			<input id="input_title" type="text" class="form-control" name="title" value="{{ $posting->title }}">
		</div>

		<div class="mb-3">
			<label for="input_content" class="form-label">Content:</label>
			<textarea id="input_content" class="form-control" name="content">{{ $posting->content }}</textarea>
		</div>

		<div class="d-flex flex-row">
			<button type="submit" class="btn btn-primary me-2">
				<i class="fa fa-check"></i> Save
			</button>
			<a class="btn btn-outline-primary" href="{{ route('postings.index') }}">
				<i class="fa fa-times"></i> Cancel
			</a>
		</div>

	</form>

@endsection
