@extends('frontend.master')
@section('title' , 'setting')
@section('setting-status' , 'active')
@section('content')
        <!-- Profile Start -->
        <div class="dashboard container">
            @include('frontend.dashboard.sidebar') 
            <!-- Main Content -->
            <div class="main-content">
                <!-- Profile Section -->
                <section id="profile" class="content-section active">
                    <form action="{{ route('frontend.dashboard.setting.update') }}" method="POST" enctype="multipart/form-data">
                       @csrf
                        <!-- Add Post Section -->
                        <section id="add-post" class="add-post-section mb-5">
                            <h2>Edit User Profile</h2>
                            <div class="post-form p-3 border rounded">
                                <!-- Post Title -->
                              <input name="name" type="text" id="name" class="form-control mb-2"
                                    placeholder="Your Name" value="{{ $user->name }}"/>
                                @error('name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                              <input name="username" type="text" id="username" class="form-control mb-2"
                                placeholder="Your Username" value="{{ $user->username }}"/>
                                @error('username')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                              <input name="email" type="email" id="email" class="form-control mb-2"
                                    placeholder="Your Email" value="{{ $user->email }}"/>
                                @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                              <input name="phone" type="text" id="phone" class="form-control mb-2"
                                placeholder="Your Phone" value="{{ $user->phone }}"/>
                                @error('phone')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                              <input name="country" type="text" id="country" class="form-control mb-2"
                                placeholder="Your Country" value="{{ $user->country }}"/>
                                @error('country')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                             <input name="city" type="text" id="city" class="form-control mb-2"
                                placeholder="Your City" value="{{ $user->city }}"/>
                                @error('city')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                             <input name="street" type="text" id="street" class="form-control mb-2"
                                placeholder="Your Street" value="{{ $user->street }}"/>
                                @error('street')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                                <!-- Image Upload -->
                                <input name="image" type="file" id="image" class="form-control mb-2"/>
                                <div class="tn-slider mb-2">
                                    <div id="imagePreview" class="slick-slider"></div>
                                </div>

                                <!-- Post Button -->
                                <button type="submit" class="btn btn-primary post-btn">Save</button>
                            </div>
                        </section>
                    </form>
                </section>

                <section id="profile" class="content-section active">
                    <form action="{{ route('frontend.dashboard.setting.change-password') }}" method="POST">
                       @csrf
                        <!-- Add Post Section -->
                        <section id="add-post" class="add-post-section mb-5">
                            <h2>Change User Password</h2>
                            <div class="post-form p-3 border rounded">
                                <!-- Post Title -->
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input name="current_password" type="password" id="current_password" class="form-control mb-2"
                                            placeholder="Your Current Password" value="{{ old('current_password') }}"/>
                                        @error('current_password')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                </div>
                                <div class="form-group"> 
                                    <label for="new_password">New Password</label>
                                    <input name="new_password" type="password" id="new_password" class="form-control mb-2"
                                    placeholder="Your New Password" value="{{ old('new_password') }}"/>
                                        @error('new_password')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new_password_confirmation">New Password Confirmation</label>
                                    <input name="new_password_confirmation" type="password" id="new_password_confirmation" class="form-control mb-2"
                                    placeholder="Your New Password Confirmation"/>
                                </div>
                                <!-- Post Button -->
                                <button type="submit" class="btn btn-primary post-btn">Save</button>
                            </div>
                        </section>
                    </form>
                </section>
            </div>
        </div>
        <!-- Profile End -->   
@endsection

@push('js')
    <script>
        $('#image').fileinput({
            theme: 'fa5',
            showUpload:false, 
            allowedFileExtensions: ['jpg', 'png', 'jpeg' , 'webp'],
            maxFileCount: 1,
            maxFileSize: 2048,
        }) ;
    </script>
@endpush