@extends('backend.admin.master')
@section('title', 'Admins')
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
                    <form action="{{ url()->current() }}" method="GET" class="form-inline">
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
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">Add New Admin</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>#</th>
                            <th>Name</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tfoot>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td style="align-content:center;text-align:center;">
                                        @if ($admin->status == 1)
                                            <button class="btn btn-success">Active</button>
                                        @else
                                            <button class="btn btn-danger">InActive</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('changeAdminStatusForm_{{ $admin->id }}').submit();return false;"
                                            title="change status">
                                            @if ($admin->status == 1)
                                                <i class="fa fa-stop" title="inactive"></i>
                                            @else
                                                <i class="fa fa-play" title="activate"></i>
                                            @endif
                                        </a>
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal_{{ $admin->id }}" title="delete admin"><i class="fa fa-trash"></i>
                                        </a>
                                        <a href="{{ route('admin.admins.edit' , $admin->id) }}" id="adminEdit_{{ $admin->id }}" title="edit admin"><i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <x-custom-modal title="Delete Admin!" message="Are You Sure To Delete This Admin?"
                                    id="{{ $admin->id }}"></x-custom-modal>
                                <!--form for delete user-->
                                <form id="deleteAdminForm_{{ $admin->id }}"
                                    action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!--form for change user status-->
                                <form id="changeAdminStatusForm_{{ $admin->id }}"
                                    action="{{ route('admin.admins.change-status') }}" method="POST">
                                    @csrf
                                    <input name="admin_id" type="hidden" value="{{ $admin->id }}">
                                </form>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-info">
                                            No Admins Found!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $admins->appends(request()->input())->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
     
    </script>
@endpush