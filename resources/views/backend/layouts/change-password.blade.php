@extends('backend.layouts.master')

@section('title', 'TShop | Change password')

@push('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('profile') }}" >Profile</a></li>
    <li class="breadcrumb-item active" aria-current="page">Change password</li>
@endpush

@section('content-main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3">
                <h4 class="font-weight-bold text-primary">Change Password</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('change.password', Auth::user()->id) }}">
                    @csrf
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control  @error('current_password') is-invalid @enderror" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                        <div class="col-md-6">
                            <input id="new_confirm_password" type="password" class="form-control @error('new_confirm_password') is-invalid @enderror"" name="new_confirm_password">
                            @error('new_confirm_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
