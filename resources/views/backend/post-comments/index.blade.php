@extends('backend.layouts.master')

@section('title', 'TShop | Post')

@push('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post</li>
@endpush

@section('content-main')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="font-weight-bold text-primary float-left">Posts</h4>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add post tag"><i class="fas fa-plus"></i> Add Post</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($posts) > 0)
                    <table class="table table-border table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Author</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key => $post)
                                <tr>
                                    <td>{{ $post->id}}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->postCategory->title }}</td>
                                    <td>
                                            @foreach ($post->tags as $tag)
                                            <span class="badge badge-secondary">{{ $tag->title }}</span><br>
                                            @endforeach
                                    </td>
                                    <td>{{ $post->author->name }}</td>
                                    <td>
                                        <img src="{{ $post->photo }}" class="img-fluid zoom" style="max-width: 80px">
                                    </td>
                                    <td>
                                        @if ($post->status === 'active')
                                            <span class="badge badge-success">active</span>
                                        @else
                                            <span class="badge badge-secondary">inactive</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id=1 style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Author</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- <span style="float:right">{{$posts->links()}}</span> --}}
                @else
                    <h6 class="text-center">No posts found!!! Please create posts</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush

@push('scripts')
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.dltBtn').click(function(e){
    var form=$(this).closest('form');
        var dataID=$(this).data('id');
        // alert(dataID);
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("Your data is safe!");
            }
        });
    })
})
</script>
@endpush
