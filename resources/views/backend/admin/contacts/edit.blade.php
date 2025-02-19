@extends('backend.admin.master')
@section('title', 'Contact Edit')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Show Contact Info</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.contacts.update' , $contact->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{ $contact->name }}">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" value="{{ $contact->email }}">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="subject">Subject</label>
                        <input name="subject" type="text" class="form-control" id="subject" value="{{ $contact->subject }}">
                        @error('subject')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="address">Address</label>
                        <input name="address" type="text" class="form-control" id="address" value="{{ $contact->address }}">
                    </div>
                    @error('address')
                            <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" value="{{ $contact->phone }}">
                        @error('phone')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="is_read">Status</label>
                        <select name="is_read" class="form-control" id="is_read">
                            <option disabled>Select Status</option>
                            <option value="1" @selected($contact->is_read == 1 )>Read</option>
                            <option value="0" @selected($contact->is_read == 0 )>UnRead</option>
                        </select>
                        @error('is_read')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="row mb-6">
                    <div class="col">
                        <label for="message">Message</label>
                        <textarea name="message" type="text" class="form-control" id="message">{{ $contact->message }}</textarea>
                        @error('message')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div><br>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Back</a>  
                <button type="submit" class="btn btn-primary">Submit</button>  
            </form>
        </div>
    </div>
</div>
</body>
</html>
@endsection