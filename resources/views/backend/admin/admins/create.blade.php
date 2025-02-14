@extends('backend.admin.master')
@section('title', 'Admin Create')
@section('content')
<br>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Centered Card with Wider Width -->
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Adjust this value to control the width -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">Create New Admin</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.admins.store') }}" method="POST">
                            @csrf

                            <!-- Name Field -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Name<strong class="text-danger"> *</strong></label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Enter Admin Name" value="{{ old('name') }}">
                                    @error('name')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <!-- UserName Field -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="username" class="form-label">UserName<strong class="text-danger"> *</strong></label>
                                    <input name="username" class="form-control" id="username"
                                        placeholder="Enter Admin username" value="{{ old('username') }}">
                                    @error('username')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email<strong class="text-danger"> *</strong></label>
                                    <input name="email" class="form-control" id="email"
                                        placeholder="Enter Admin Email" value="{{ old('email') }}">
                                    @error('email')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                             <!-- Password Field -->
                             <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="password" class="form-label">Password<strong class="text-danger"> *</strong></label>
                                    <input name="password" class="form-control" id="password"
                                        placeholder="Enter Admin password" type="password" value="{{ old('password') }}">
                                    @error('password')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                             <!-- PasswordConfirm Field -->
                             <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="password_confirmation" class="form-label">Password Confirmation<strong class="text-danger"> *</strong></label>
                                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation"
                                        placeholder="Enter Admin Password Confirmation" value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status Field -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="status" class="form-label">Status<strong class="text-danger"> *</strong></label>
                                    <select name="status" class="form-select">
                                        <option value="" {{ old('status') == null ? 'selected' : '' }}>Select Status</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Not Active</option>
                                    </select>
                                    @error('status')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit and Back Buttons -->
                            <div class="row mb-3">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <!-- Create Admin Button -->
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Create Admin
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