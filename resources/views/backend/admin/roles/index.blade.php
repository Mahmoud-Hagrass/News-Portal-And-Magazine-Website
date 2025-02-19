@extends('backend.admin.master')
@section('title', 'Roles')
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
                            <input type="search" name="search" id="search" class="form-control"
                                placeholder="Search Here">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Add New Role</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th style="text-align:center">Permessions</th>
                                <th>Admins Num</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>#</th>
                            <th>Role</th>
                            <th style="text-align:center">Permessions</th>
                            <th>Admins Num</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tfoot>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @forelse ($role->permissions as $permission)
                                          <button type="button" class="btn btn-success btn-sm" style="margin: 2px;">{{ $permission }}</button>
                                        @empty
                                            <strong class="btn btn-danger">No Permessions</strong>
                                        @endforelse
                                    </td>
                                    <th>{{ $role->admins_count ?? 0 }}</th> <!--Eager Loaded In Role Controller-->
                                    <td>{{ $role->created_at->format('d-m-Y: h:m a') }}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#deleteModal_{{ $role->id }}" title="delete role">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                            id="roleEdit_{{ $role->id }}" title="edit role">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                
                                <x-delete-modal title="Delete Role!" message="Are You Sure To Delete This Role?"
                                    id="{{ $role->id }}" formId="deleteForm_">
                                </x-delete-modal>
                                <!--form for delete user-->
                                <form id="deleteForm_{{ $role->id }}"
                                    action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-info">
                                            No Roles Found!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $roles->appends(request()->input())->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script></script>
@endpush
