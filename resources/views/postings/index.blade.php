@extends('layouts.master')

@section('container')

	<h1>{{ trans_choice('postings.name', $postings->total()) }}</h1>

	<hr>

	<ul>

		@foreach($postings as $posting)

			<li>
				<a href="{{ route('postings.show', $posting->slug) }}">
					{{ $posting->title }}
					@if($posting->user_id)
						({{ $posting->user->name }})
					@endif
				</a>
			</li>

		@endforeach

	</ul>

	<hr>

	{{ $postings->links() }}

	<hr>

	@if(auth()->check())
		<a href="{{ route('postings.create') }}" class="btn btn-primary">
			<i class="fa fa-plus"></i> Create posting
		</a>
	@endif

@endsection
