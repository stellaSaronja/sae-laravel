@extends('layouts.master')

@section('container')

	<h1>Edit posting</h1>

	<hr>

	<form method="post" action="{{ route('postings.update', $posting->id) }}" autocomplete="off">

		@csrf
		@method('put')

		@include('postings._form')

		<div class="d-flex flex-row">
			<button type="submit" class="btn btn-primary me-2">
				<i class="fa fa-check"></i> Save
			</button>
			<a class="btn btn-outline-primary" href="{{ route('postings.show', $posting->slug) }}">
				<i class="fa fa-times"></i> Cancel
			</a>
		</div>

	</form>

@endsection
