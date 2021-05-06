@extends('backend.layouts.master')

@section('title', 'TShop | Edit comment')
@push('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('post-comments.index') }}" >Comments</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit comment</li>
@endpush

@section('content-main')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="font-weight-bold text-primary">Edit Banner</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('post-comments.update', $comment->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">By: </label>
                    <input type="text" disabled class="form-control" id="author" value="{{ $comment->author->name}}">
                </div>
                <div class="form-group">
                    <label for="comment">Comment <span class="text-danger">*</span> </label>
                    <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" cols="30" rows="4">{{ $comment->comment }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $comment->status === 'active' ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{ $comment->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
