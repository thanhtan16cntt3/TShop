@extends('backend.layouts.master')

@section('title', 'TShop | Create post tag')
@push('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('post-tags.index') }}" >Post tags</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit post tag</li>
@endpush
@section('content-main')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="font-weight-bold text-primary">Edit post tag</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('post-tags.update', $postTag->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title', $postTag->title) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $postTag->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $postTag->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
