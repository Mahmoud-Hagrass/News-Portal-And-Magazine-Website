@extends('backend.admin.master')
@section('title', 'Role Edit')
@section('content')
<br>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Centered Card with Wider Width -->
    <div class="row justify-content-center">
        <div class="col-md-12"> <!-- Adjust this value to control the width -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Edit Role</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Name Field -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Name<strong class="text-danger"> *</strong></label>
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="Enter Role Name" value="{{ $role->name }}">
                            </div>
                        </div>

                        <!-- Permissions Field -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="permissions" class="form-label">Permissions<strong class="text-danger"> *</strong></label>
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            All Permissions
                                        </h6>
                                        <div class="form-check">
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach (config('roles.permissions') as $key => $permission)
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" id="permission_{{ $key }}" value="{{ $key }}" @checked(in_array($key, $role->permissions))>
                                                        <label class="form-check-label" for="permission_{{ $key }}">
                                                            {{ $permission }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Back Buttons -->
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-between">
                                <!-- Create Admin Button -->
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Edit Role
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection