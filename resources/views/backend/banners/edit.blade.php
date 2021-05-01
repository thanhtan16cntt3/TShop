@extends('backend.layouts.master')

@section('title', 'TShop | Edit Banner')
@push('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('banner.index') }}" >Banners</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit banner</li>
@endpush

@section('content-main')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="font-weight-bold text-primary">Edit Banner</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('banner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title', $banner->title) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description </label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="4">{!! $banner->description !!}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <label for="photo">Photo <span class="text-danger">*</span></label><br>
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                    <input id="thumbnail" class="form-control @error('photo') is-invalid @enderror" type="text" name="photo" value="{{ $banner->photo }}" onchange="readUrl(this)">
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <img id="holder" src="{{ $banner->photo }}" style="margin-top:15px;max-height:500px;">
                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $banner->status === 'active' ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{ $banner->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('assets/backend/admin/summernote/summernote.min.css')}}">
@endpush

@push('scripts')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{asset('assets/backend/admin/summernote/summernote.min.js')}}"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
        $('#description').summernote({
            placeholder: "Write short description.....",
            tabsize: 2,
            height: 150
        });
    });

    function readUrl(input) {
        $('#holder').attr('src', input.value);
    }
</script>
@endpush
