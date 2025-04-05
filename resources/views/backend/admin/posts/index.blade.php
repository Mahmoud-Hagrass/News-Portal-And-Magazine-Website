@extends('backend.admin.master')
@section('title', 'Posts')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">Posts Data Table</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <form action="{{ route('admin.posts.index') }}" method="GET" class="form-inline">
                        @csrf
                        <div class="form-group mr-3">
                            <select name="sort_by" class="form-control">
                                <option disabled selected>Sort By</option>
                                <option value="id">Id</option>
                                <option value="name">Name</option>
                                <option value="email">Email</option>
                                <option value="created_at">Created Date</option>
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <select name="order_by" class="form-control">
                                <option disabled selected>Order By</option>
                                <option value="ASC">asc</option>
                                <option value="DESC">desc</option>
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <select name="limit_by" class="form-control">
                                <option disabled selected>Limit By</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <select name="status" class="form-control">
                                <option disabled selected>Status</option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <input type="search" name="search" id="search" class="form-control" placeholder="Search Here">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add New Post</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Views</th>
                                <th>User</th>
                                <th>Comment Ability</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>#</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th>User</th>
                            <th>Comment Ability</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tfoot>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->number_of_views }}</td>
                                    <th>{{ $post->user->name ?? $post->admin->name}}</th>
                                    <td style="align-content:center;text-align:center;">
                                        @if ($post->comment_able == 1)
                                        <button class="btn btn-success">Active</button>
                                        @else
                                        <button class="btn btn-danger">InActive</button>
                                        @endif
                                    </td>
                                    <td style="align-content:center;text-align:center;">
                                        @if ($post->status == 1)
                                        <a href="" class="btn btn-success">Active</a>
                                        @else
                                        <a href="" class="btn btn-danger">InActive</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('changePostStatusForm_{{ $post->id }}').submit();return false;"
                                            title="change status">
                                            @if ($post->status == 1)
                                                <i class="fa fa-stop" title="inactive"></i>
                                            @else
                                                <i class="fa fa-play" title="activate"></i>
                                            @endif
                                        </a>
                                        <a href="" data-toggle="modal"
                                            data-target="#deleteModal_{{ $post->id }}" title="delete post"><i
                                                class="fa fa-trash"></i>
                                        </a>
                                        <a href="{{ route('admin.posts.edit' , $post->id) }}" id="postEdit_{{ $post->id }}" title="edit post"><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.posts.show' , $post->id) }}" id="postShow_{{ $post->id }}" title="show post"><i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <x-delete-modal title="Delete Post!" message="Are You Sure To Delete This Post?"
                                    id="{{ $post->id }}" formId="deletePostForm_"></x-delete-modal>
                                <!--form for delete user-->
                                <form id="deletePostForm_{{ $post->id }}"
                                    action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!--form for change user status-->
                                <form id="changePostStatusForm_{{ $post->id }}"
                                    action="{{ route('admin.posts.change-status') }}" method="POST">
                                    @csrf
                                    <input name="post_id" type="hidden" value="{{ $post->id }}">
                                </form>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-info">
                                            No Users Found!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $posts->appends(request()->input())->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
     
    </script>
@endpush