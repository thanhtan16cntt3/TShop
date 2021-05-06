@extends('backend.layouts.master')

@section('title', 'TShop | Post')

@push('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Comments</li>
@endpush

@section('content-main')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="font-weight-bold text-primary float-left">Comments</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($comments) > 0)
                    <table class="table table-border table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Post title</th>
                                <th>Author</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $key => $comment)
                                <tr>
                                    <td>{{ $comment->id}}</td>
                                    <td>{{ $comment->post->title }}</td>
                                    <td>{{ $comment->author->name }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>
                                        {{ $comment->updated_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        @if ($comment->status === 'active')
                                            <span class="badge badge-success">active</span>
                                        @else
                                            <span class="badge badge-secondary">inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('post-comments.edit', $comment->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('post-comments.destroy', $comment->id) }}">
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
                                <th>Post title</th>
                                <th>Author</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- <span style="float:right">{{$posts->links()}}</span> --}}
                @else
                    <h6 class="text-center">No comments found!!! Please create comments</h6>
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
