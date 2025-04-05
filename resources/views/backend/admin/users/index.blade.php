@extends('backend.admin.master')
@section('title', 'Users')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users Data Table</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.index') }}" method="GET" class="form-inline mb-4">
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td style="align-content:center;text-align:center;">
                                        @if ($user->status == 1)
                                            <a href="" class="btn btn-success">Active</a>
                                        @else
                                            <a href="" class="btn btn-danger">InActive</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('changeUserStatusForm_{{ $user->id }}').submit();return false;"
                                            title="change status">
                                            @if ($user->status == 1)
                                                <i class="fa fa-stop" title="inactive"></i>
                                            @else
                                                <i class="fa fa-play" title="activate"></i>
                                            @endif
                                        </a>
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#deleteModal_{{ $user->id }}" title="delete user">
                                            <i class="fa fa-trash"></i>
                                            
                                        </a>
                                        <a href="javascript:void(0)" onclick="showUserInfo('{{ $user->id }}')"
                                            id="userInfo_{{ $user->id }}"
                                            data-target="#showUserInfoModal_{{ $user->id }}" data-toggle="modal"
                                            title="show user"><i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <x-delete-modal title="Delete User!" message="Are You Sure To Delete This User?"
                                    id="{{ $user->id }}" formId="formDelete_">
                                </x-delete-modal>
                                <x-show-users-info-modal id="{{ $user->id }}"></x-show-users-info-modal>
                                <!--form for delete user-->
                                <form id="formDelete_{{ $user->id }}"
                                    action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!--form for change user status-->
                                <form id="changeUserStatusForm_{{ $user->id }}"
                                    action="{{ route('admin.users.change-status') }}" method="POST">
                                    @csrf
                                    <input name="user_id" type="hidden" value="{{ $user->id }}">
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
                    {{ $users->appends(request()->input())->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@push('js')
    <script>
        function showUserInfo(id) {
            $(document).off('click', '#userInfo_' + id).on('click', '#userInfo_' + id, function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.users.show', ':id') }}".replace(":id", id),
                    type: "GET",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            const user = response.data;
                            const imageUrlBasePath = 'http://news-portal.test/storage/uploads/';
                            $('#showUserInfoModal_' + id + ' .modal-title').text("Info About User : " +
                                user.name);
                            $('#insert_user_info_' + id).empty();
                            $('#insert_user_info_' + id).append(`
                                <div class="user-info">
                                    <p><strong>Name:</strong> <span class="text-primary">${user.name}</span></p>
                                    <p><strong>Email:</strong> <span class="text-info">${user.email}</span></p>
                                    <p><strong>Phone:</strong> <span class="text-success">${user.phone}</span></p>
                                    <p><strong>Country:</strong> <span class="text-warning">${user.country}</span></p>
                                    <p><strong>City:</strong> <span class="text-danger">${user.city}</span></p>
                                    <p><strong>Street:</strong> <span class="text-muted">${user.street}</span></p>
                                    <p><strong>Status:</strong> <span class="${user.status == 1 ? 'btn btn-success' : 'btn btn-danger'}">${user.status == 1 ? 'Active' : 'Inactive'}</span></p>
                                    <p><strong>Image:<br><br></strong>${user.image ? `<img src="${imageUrlBasePath}${user.image.replace(/\\/g, '')}" alt="User  Image" class="profile-img rounded-circle" style="width: 100px; height: 100px;" />` : `<img src="${imageUrlBasePath}users/default.png" alt="Default Image" class="profile-img rounded-circle" style="width: 100px; height: 100px;" />`}<strong></p>
                                </div>
                            `);
                            $('#showUserInfoModal_' + id).modal('show');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        }
    </script>
@endpush
