@extends('backend.layouts.master')
@section('title', 'TShop | Create post')
@push('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('posts.index') }}" >Posts</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit post</li>
@endpush

@section('content-main')

<div class="card">
	<div class="card-header">
		<h4 class="font-weight-bold text-primary">Edit post</h4>
	</div>
	<div class="card-body">
		<form method="post" action="{{route('posts.update', $post->id)}}">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
				<input id="inputTitle"  class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Enter title"  value="{{old('title', $post->id)}}">
				@error('title')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="quote" class="col-form-label">Quote</label>
				<textarea class="form-control @error('quote') is-invalid @enderror" id="quote" name="quote">{!! old('quote', $post->quote) !!}</textarea>
				@error('quote')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
				<textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary">{!! old('summary', $post->summary) !!}</textarea>
				@error('summary')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="description" class="col-form-label">Description</label>
				<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{!! old('description', $post->description) !!}</textarea>
				@error('description')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="category_id">Category <span class="text-danger">*</span></label>
				<select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
					<option value="">--Select any category--</option>
					@foreach($categories as $key=>$category)
						<option value='{{$category->id}}' {{ $category->id == $post->category_id ? 'selected' : '' }}>{{$category->title}}</option>
					@endforeach
				</select>
				@error('category_id')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="tags">Tag</label>
				<select name="tags[]" multiple  data-live-search="true" class="form-control selectpicker @error('tags') is-invalid @enderror">
					<option value="">--Select any tag--</option>
					@foreach($tags->toArray() as $key=>$tag)
						<option value='{{$tag['id']}}' 
							@php
							foreach($post->tags->toArray() as $item){
								if($tag['id'] == $item['id']){
									echo 'selected';
								}
							}
							@endphp
							>{{$tag['title']}}</option>
					@endforeach
				</select>
				@error('tags')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="form-group">
				<label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
				<div class="input-group">
					<span class="input-group-btn">
						<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
						<i class="fa fa-picture-o"></i> Choose
						</a>
					</span>
					<input id="thumbnail" class="form-control  @error('photo') is-invalid @enderror" type="text" name="photo" value="{{ $post->photo }}">
					@error('photo')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
				<br><img src="{{ $post->photo }}" style="max-width: 500px">
				<div id="holder" style="margin-top:15px;max-height:100px;">
				</div>

			</div>

			<div class="form-group">
				<label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
				<select name="status" class="form-control  @error('status') is-invalid @enderror">
					<option value="active" {{ $post->status === 'active' ? 'selected' : '' }} >Active</option>
					<option value="inactive" {{ $post->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
				</select>
				@error('status')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="form-group mb-3">
			<button class="btn btn-success" type="submit">Submit</button>
			</div>
		</form>
	</div>
</div>

@endsection

@push('styles')
	<link rel="stylesheet" href="{{asset('assets/backend/admin/summernote/summernote.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
	<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
	<script src="{{asset('assets/backend/admin/summernote/summernote.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

	<script>
		$('#lfm').filemanager('image');

		$(document).ready(function() {
		$('#summary').summernote({
			placeholder: "Write short description.....",
			tabsize: 2,
			height: 100
		});
		});

		$(document).ready(function() {
		$('#description').summernote({
			placeholder: "Write detail description.....",
			tabsize: 2,
			height: 150
		});
		});

		$(document).ready(function() {
		$('#quote').summernote({
			placeholder: "Write detail Quote.....",
			tabsize: 2,
			height: 100
		});
		});
		// $('select').selectpicker();

	</script>
@endpush
