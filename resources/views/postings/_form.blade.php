
<div class="mb-3">
	<label for="input_title" class="form-label">Title:</label>
	<input id="input_title" type="text" class="form-control" name="title" value="{{ $posting->title }}">
</div>

<div class="mb-3">
	<label for="input_content" class="form-label">Content:</label>
	<textarea id="input_content" class="form-control" name="content">{{ $posting->content }}</textarea>
</div>

<div class="form-check mb-3">
	<input class="form-check-input" type="checkbox" value="1" id="check_is_published" name="is_published" {{ $posting->is_published ? 'checked' : '' }}>
	<label class="form-check-label" for="check_is_published">Is published</label>
</div>
