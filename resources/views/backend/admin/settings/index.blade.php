@extends('backend.admin.master')
@section('title', 'Settings')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0"> Update Site Settings</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Site Name Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="site_name" class="form-label">Site Name<strong class="text-danger"> *</strong></label>
                            <input name="site_name" type="text" class="form-control" id="site_name"
                                placeholder="Enter Site Name" value="{{ $site_settings->site_name }}">
                            @error('site_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone and Email Fields -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone<strong class="text-danger"> *</strong></label>
                            <input name="phone" type="text" class="form-control" id="phone"
                                placeholder="Enter Phone Number" value="{{ $site_settings->phone }}">
                            @error('phone')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email<strong class="text-danger"> *</strong></label>
                            <input name="email" type="email" class="form-control" id="email"
                                placeholder="Enter Email" value="{{ $site_settings->email }}">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <!-- Small Description Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="small_description" class="form-label">Small Description<strong class="text-danger"> *</strong></label>
                            <textarea name="small_description" class="form-control" id="small_description" rows="3"
                                placeholder="Enter Small Description">{{ $site_settings->small_description }}</textarea>
                            @error('small_description')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Country, City, Street Fields -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="country" class="form-label">Country<strong class="text-danger"> *</strong></label>
                            <input name="country" type="text" class="form-control" id="country"
                                placeholder="Enter Country" value="{{ $site_settings->country }}">
                            @error('country')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="form-label">City<strong class="text-danger"> *</strong></label>
                            <input name="city" type="text" class="form-control" id="city"
                                placeholder="Enter City" value="{{ $site_settings->city }}">
                            @error('city')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="street" class="form-label">Street<strong class="text-danger"> *</strong></label>
                            <input name="street" type="text" class="form-control" id="street"
                                placeholder="Enter Street" value="{{ $site_settings->street }}">
                            @error('street')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Facebook and Twitter Fields -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="facebook" class="form-label">Facebook URL<strong class="text-danger"> *</strong></label>
                            <input name="facebook" type="url" class="form-control" id="facebook"
                                placeholder="Enter Facebook URL" value="{{ $site_settings->facebook }}">
                            @error('facebook')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="twitter" class="form-label">Twitter URL<strong class="text-danger"> *</strong></label>
                            <input name="twitter" type="url" class="form-control" id="twitter"
                                placeholder="Enter Twitter URL" value="{{ $site_settings->twitter }}">
                            @error('twitter')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Instagram and YouTube Fields -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="instagram" class="form-label">Instagram URL<strong class="text-danger"> *</strong></label>
                            <input name="instagram" type="url" class="form-control" id="instagram"
                                placeholder="Enter Instagram URL" value="{{ $site_settings->instagram }}">
                            @error('instagram')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="youtube" class="form-label">YouTube URL<strong class="text-danger"> *</strong></label>
                            <input name="youtube" type="url" class="form-control" id="youtube"
                                placeholder="Enter YouTube URL" value="{{ $site_settings->youtube }}">
                            @error('youtube')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Logo and Favicon Fields -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="logo" class="form-label">Logo<strong class="text-danger"> *</strong></label>
                            <input name="logo" type="file" class="form-control" id="logo">
                            @error('logo')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="favicon" class="form-label">Favicon<strong class="text-danger"> *</strong></label>
                            <input name="favicon" type="file" class="form-control" id="favicon">
                            @error('favicon')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">Save Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('#logo').fileinput({
            theme: 'fa5',
            showUpload: false,
            maxFileCount: 1,
            maxFileSize: 2048,
            width: '50%',
            allowedFileExtensions: ['jpg', 'png', 'jpeg', 'webp'],
            initialPreviewAsData: true , 
            initialPreviewFileType: 'image' , 
            initialPreview: [
                @if($site_settings->logo)
                   "{{ asset('storage/uploads/' . $site_settings->logo) }}" , 
                @endif
            ], 
        });
        $('#favicon').fileinput({
            theme: 'fa5',
            showUpload: false,
            maxFileCount: 1,
            maxFileSize: 2048,
            width: '50%',
            allowedFileExtensions: ['jpg', 'png', 'jpeg', 'webp'],
            initialPreviewAsData: true , 
            initialPreviewFileType: 'image' , 
            initialPreview: [
                @if($site_settings->logo)
                   "{{ asset('storage/uploads/' . $site_settings->favicon) }}" , 
                @endif
            ], 
        });
    });
</script>
@endpush