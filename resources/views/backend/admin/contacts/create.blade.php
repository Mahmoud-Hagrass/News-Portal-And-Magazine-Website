@extends('backend.admin.master')
@section('title', 'User Create')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New User</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Enter User Name" value="{{ old('name') }}">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="username">UserName</label>
                        <input name="username" type="text" class="form-control" id="username" placeholder="Enter User UserName" value="{{ old('username') }}">
                        @error('username')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter User Email" value="{{ old('email') }}">
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter User Phone" value="{{ old('phone') }}">
                        @error('phone')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="country">Country</label>
                        <input name="country" type="text" class="form-control" id="country" placeholder="Enter User Country" value="{{ old('country') }}">
                        @error('country')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="city">City</label>
                        <input name="city" type="text" class="form-control" id="city" placeholder="Enter User City" value="{{ old('city') }}">
                        @error('city')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="street">Street</label>
                        <input name="street" type="text" class="form-control" id="street" placeholder="Enter User Street" value="{{ old('street') }}">
                        @error('street')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="email_verified_at">Email Status</label>
                        <select name="email_verified_at" class="form-control" value="{{ old('email_verified_at') }}">
                            <option disabled selected>Select Email Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                        @error('email_verified_at')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="passwpord">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Enter User Password" value="{{ old('password') }}">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Enter User Password Confirmation" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" value="{{ old('status') }}">
                            <option disabled selected>Select User Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                        @error('status')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="image">Image</label>
                        <input name="image" type="file" class="form-control" id="image" placeholder="Enter User Image">
                        @error('image')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
@endsection

@push('js')
    <script>
        $('#image').fileinput({
            'theme': 'fa5',
            'showUpload': false,
            'allowedFileExtensions': ['jpg', 'png', 'jpeg', 'webp'],
            'maxFileCount': 1,
            'maxFileSize': 2048,
        }) ; 
    </script>
@endpush