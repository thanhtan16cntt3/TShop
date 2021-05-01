@extends('backend.layouts.master')

@section('title', 'TShop | Media manager')

@section('content-main')
    <div class="container-fluid">
        <iframe src="/laravel-filemanager" style="width: 100%; height: 700px; overflow: hidden; border: none;"></iframe>
    </div>
@endsection
