@extends('backend.layouts.master')

@section('title', 'TShop | Profile')

@push('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profile Page</li>
@endpush

@section('content-main')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class=" font-weight-bold text-primary">Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="image">
                            @if($profile->photo)
                                <img class="card-img-top img-fluid roundend-circle mt-4" style="border-radius:50%;height:80px;width:80px;margin:auto;" id="photo-profile" src="{{$profile->photo}}" alt="profile picture">
                            @else
                                <img class="card-img-top img-fluid roundend-circle mt-4" style="border-radius:50%;height:80px;width:80px;margin:auto;" id="photo-profile" src="{{asset('assets/backend/admin/img/avatar.png')}}" alt="profile picture">
                            @endif
                        </div>
                        <div class="card-body mt-4 ml-2">
                            <h5 class="card-title text-left"><small><i class="fas fa-user"></i> {{$profile->name}}</small></h5>
                            <p class="card-text text-left"><small><i class="fas fa-envelope"></i> {{$profile->email}}</small></p>
                            <p class="card-text text-left"><small class="text-muted"><i class="fas fa-hammer"></i> {{$profile->role}}</small></p>
                        </div>
                        </div>
                </div>
                <div class="col-md-8">
                    <form class="border px-4 pt-2 pb-3" method="POST" action="{{route('profile-update',$profile->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="name" placeholder="Enter name"  value="{{$profile->name}}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-form-label">Email <span class="text-danger">*</span></label>
                            <input id="inputEmail" readonly type="email" name="email" placeholder="Enter email"  value="{{$profile->email}}" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">Photo</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control @error('photo') is-invalid @enderror" type="text" name="photo" value="{{$profile->photo}}" onchange="readUrl(this)">
                            </div>
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="">-----Select Role-----</option>
                                    <option value="admin" {{(($profile->role=='admin')? 'selected' : '')}}>Admin</option>
                                    <option value="user" {{(($profile->role=='user')? 'selected' : '')}}>User</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .breadcrumbs{
            list-style: none;
        }
        .breadcrumbs li{
            float:left;
            margin-right:10px;
        }
        .breadcrumbs li a:hover{
            text-decoration: none;
        }
        .breadcrumbs li .active{
            color:red;
        }
        .breadcrumbs li+li:before{
        content:"/\00a0";
        }
        .image{
            background:url('{{asset('assets/backend/admin/img/background.jpg')}}');
            height:150px;
            background-position:center;
            background-attachment:cover;
            position: relative;
        }
        .image img{
            position: absolute;
            top:55%;
            left:35%;
            margin-top:30%;
        }
        i{
            font-size: 14px;
            padding-right:8px;
        }
    </style>
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');

        function readUrl(input){
            $('#photo-profile').attr('src', input.value);
        }
    </script>
@endpush
