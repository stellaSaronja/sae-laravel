@extends('layouts.master')

@section('container')

	<h1>{{ trans_choice('postings.name', $postings->total()) }}</h1>

	<hr>

	<ul>

		@foreach($postings as $posting)

			<li>
				<a href="{{ route('postings.show', $posting->slug) }}">
					{{ $posting->title }}
				</a>
			</li>

		@endforeach

	</ul>

	<hr>

	{{ $postings->links() }}

	<hr>

	<a href="{{ route('postings.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create posting</a>

@endsection
