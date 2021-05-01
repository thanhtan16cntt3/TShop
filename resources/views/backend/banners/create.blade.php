@extends('backend.layouts.master')

@section('title', 'TShop | Create Banner')

@section('content-main')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <h5 class="card-header">Add Banner</h5>
        <div class="card-body">
            <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description </label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="4">{{ old('description') }}</textarea>
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
                    <input id="thumbnail" class="form-control @error('photo') is-invalid @enderror"" type="text" name="photo">
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">
                {{-- <div class="form-group mb-3">
                    <img class="image-fluid" id="photo-banner" >
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" onchange="readUrl(this)">

                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
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
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#photo-banner')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
