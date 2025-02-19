@extends('backend.admin.master')
@section('title', 'Contacts')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contacts Data Table</h6>
            </div>
            <div class="card-body">
                <form action="{{ url()->current() }}" method="GET" class="form-inline mb-4">
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td style="max-width: 330px;">{{ $contact->subject }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td style="align-content:center;text-align:center;">
                                        @if ($contact->is_read == 1)
                                            <a class="btn btn-success btn-sm">Read</a>
                                        @else
                                            <a class="btn btn-danger btn-sm">Unread</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#deleteModal_{{ $contact->id }}" title="delete contact">
                                            <i class="fa fa-trash"></i>
                                            
                                        </a>
                                        <a href="{{ route('admin.contacts.show' , $contact->id) }}" id="contactInfo_{{ $contact->id }}" title="show contact">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.contacts.edit' , $contact->id) }}" id="contactEdit_{{ $contact->id }}" title="edit contact">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <x-delete-modal title="Delete Contact!" message="Are You Sure To Delete This Contact?"
                                    id="{{ $contact->id }}" formId="deleteForm_">
                                </x-delete-modal>
                                <!--form for delete contact-->
                                <form id="deleteForm_{{ $contact->id }}"
                                    action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-info">
                                            No Contacts Found!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $contacts->appends(request()->input())->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection