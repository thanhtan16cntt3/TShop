@extends('backend.layouts.master')

@section('title', 'TShop | Post tag')

@push('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home-admin') }}" >Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post tag</li>
@endpush

@section('content-main')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="font-weight-bold text-primary float-left">Post tags</h4>
            <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add post tag"><i class="fas fa-plus"></i> Add Post tag</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($tags) > 0)
                    <table class="table table-border table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $key => $tag)
                                <tr>
                                    <td>{{ $tag->id}}</td>
                                    <td>{{ $tag->title }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>
                                        @if ($tag->status === 'active')
                                            <span class="badge badge-success">active</span>
                                        @else
                                            <span class="badge badge-secondary">inactive</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('tags.destroy', $tag->id) }}">
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
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    <span style="float:right">{{$tags->links()}}</span>
                @else
                    <h6 class="text-center">No post tag found!!! Please create post tag</h6>
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
        swal({postCategories
postCategories
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
