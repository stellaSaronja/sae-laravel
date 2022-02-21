@extends('layouts.master')

@section('container')

	<h1>{{ $posting->title }}</h1>

	@if($posting->user_id)
		<p>Author: {{ $posting->user->name }}</p>
	@endif

	@if($posting->is_published)
		<p class="text-success">
			<i class="fa fa-check"></i> Published
		</p>
	@else
		<p class="text-danger">
			<i class="fa fa-ban"></i> Not published
		</p>
	@endif

	<p>{{ $posting->content }}</p>

	<p>Created {{ nice_date($posting->created_at) }}</p>
	<p>Updated {{ nice_date($posting->updated_at) }}</p>

	<hr>

	<div class="d-flex flex-row">

		<form method="post" action="{{ route('postings.like', $posting->id) }}" autocomplete="off">
			@csrf
			<button type="submit" class="btn btn-outline-primary me-2">
				<i class="fa fa-thumbs-up"></i> {{ nice_number($posting->like_count) }}
			</button>
		</form>

		<form method="post" action="{{ route('postings.dislike', $posting->id) }}" autocomplete="off">
			@csrf
			<button type="submit" class="btn btn-outline-primary me-2">
				<i class="fa fa-thumbs-down"></i> {{ nice_number($posting->dislike_count) }}
			</button>
		</form>

		<div>

			Ratio: {{ $posting->like_ratio }}

			@if($posting->is_positive)
				:)
			@elseif($posting->is_negative)
				:(
			@endif

		</div>

	</div>

	<hr>

	<a class="btn btn-outline-primary" href="{{ route('postings.index') }}">
		<i class="fa fa-arrow-left"></i> Back
	</a>

	<a class="btn btn-primary" href="{{ route('postings.edit', $posting->id) }}">
		<i class="fa fa-pencil"></i> Edit
	</a>

	<hr>

	<form method="post" action="{{ route('postings.destroy', $posting->id) }}" autocomplete="off" onsubmit="return confirm('We are going to delete {{ $posting->title }}. Are you sure?')">

		@csrf
		@method('delete')

		<button type="submit" class="btn btn-danger me-2">
			<i class="fa fa-trash"></i> Delete
		</button>

	</form>

@endsection
