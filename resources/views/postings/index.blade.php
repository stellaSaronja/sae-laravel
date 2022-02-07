@extends('layouts.master')

@section('container')

	<h1>{{ trans_choice('postings.name', $postings->total()) }}</h1>

	<hr>

	<ul>

		@foreach($postings as $posting)

			<li>{{ $posting->title }}</li>

		@endforeach

	</ul>

	<hr>

	{{ $postings->links() }}

@endsection
