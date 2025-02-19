@extends('backend.admin.master')
@section('title', 'Contact Show')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Show Contact Info</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="row mb-3">
                    <div class="col">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{ $contact->name }}" disabled>
                    </div>
                    <div class="col">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" value="{{ $contact->email }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="subject">Subject</label>
                        <input name="subject" type="text" class="form-control" id="subject" value="{{ $contact->subject }}" disabled>
                    </div>
                    <div class="col">
                        <label for="address">Address</label>
                        <input name="address" type="text" class="form-control" id="address" value="{{ $contact->address }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" value="{{ $contact->phone }}" disabled>
                    </div>
                    <div class="col">
                        <label for="is_read">Status</label>
                        <input name="is_read" type="text" class="form-control" id="city" placeholder="Enter User City" value="{{ $contact->is_read  == 1 ? 'Read' : 'UnRead'  }}" disabled>
                    </div>
                </div>
                <div class="row mb-6">
                    <div class="col">
                        <label for="message">Message</label>
                        <textarea name="message" type="text" class="form-control" id="message" disabled>{{ $contact->message }}</textarea>
                    </div>
                </div><br>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Back</a>  
            </form>
        </div>
    </div>
</div>
</body>
</html>
@endsection