@extends('backend.admin.master')
@section('title', 'Categories')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories Data Table</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <form action="{{ url()->current() }}" method="GET" class="form-inline">
                        @csrf
                        <div class="form-group mr-3">
                            <select name="sort_by" class="form-control">
                                <option disabled selected>Sort By</option>
                                <option value="id">Id</option>
                                <option value="name">Name</option>
                                <option value="created_at">Created Date</option>
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <select name="order_by" class="form-control">
                                <option disabled selected>Order By</option>
                                <option value="ASC">Asending</option>
                                <option value="DESC">Desending</option>
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
                    <a href="javascript:void(0)" class="btn btn-info" data-target="#createNewCategory" data-toggle="modal">Add Category</a>
                </div>
                <x-custom-create-modal></x-custom-create-modal>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Posts Number</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Posts Number</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td style="text-align:center">{{ $category->posts_count }}</td>
                                    <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                    <td style="align-content:center;text-align:center;">
                                        @if ($category->status == 1)
                                            <button class="btn btn-success">Active</button>
                                        @else
                                            <button class="btn btn-danger">InActive</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('changeCategoryStatusForm_{{ $category->id }}').submit();return false;"
                                            title="change status">
                                            @if ($category->status == 1)
                                                <i class="fa fa-stop" title="inactive"></i>
                                            @else
                                                <i class="fa fa-play" title="activate"></i>
                                            @endif
                                        </a>
                                        <a href="javascript:void(0)" onclick="" data-toggle="modal"
                                            data-target="#exampleModal_{{ $category->id }}" title="delete category"><i
                                                class="fa fa-trash"></i></a>
                                        <a href="javascript:void(0)" 
                                            id="categoryEdit_{{ $category->id }}"
                                            data-target="#categoryEditModal_{{ $category->id }}" data-toggle="modal"
                                            title="show user"><i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <x-custom-edit-modal name="{{ $category->name }}" status="{{ $category->status }}" id="{{ $category->id }}"></x-custom-edit-modal>
                                <x-custom-modal title="Delete Category!" message="Are You Sure To Delete This Category?" id="{{ $category->id }}"></x-custom-modal>
                                <form id="deleteCategoryForm_{{ $category->id }}"
                                    action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                 <!--form for change category status-->
                                 <form id="changeCategoryStatusForm_{{ $category->id }}"
                                    action="{{ route('admin.categories.change-status') }}" method="POST">
                                    @csrf
                                    <input name="category_id" type="hidden" value="{{ $category->id }}">
                                </form>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-info">
                                            No Categories Found!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->appends(request()->input())->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
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