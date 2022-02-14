@extends('layouts.master')

@section('container')

	<h1>{{ $posting->title }}</h1>

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

	<hr>

	<div class="d-flex flex-row">
		<div class="btn btn-outline-primary me-2">
			<i class="fa fa-thumbs-up"></i> {{ nice_number($posting->like_count) }}
		</div>
		<div class="btn btn-outline-primary">
			<i class="fa fa-thumbs-down"></i> {{ nice_number($posting->dislike_count) }}
		</div>
	</div>

	<hr>

	<a class="btn btn-primary" href="{{ route('postings.index') }}">
		<i class="fa fa-arrow-left"></i> Back
	</a>

@endsection
