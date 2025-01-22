@extends('frontend.master')
@section('title' , 'contact-us') 
@section('contact-status' , 'active')
@section('content')
 <!-- Contact Start -->
     <div class="contact">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-8">
              <div class="contact-form">
                <form action="{{ route('frontend.contact-us.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}"/>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}"/>
                              @error('email')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="phone" class="form-control" placeholder="Your Pohne" value="{{ old('phone') }}"/>
                             @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="address" class="form-control" placeholder="Your Address" value="{{ old('address') }}"/>
                             @error('address')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}"/>
                          @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="5" placeholder="Message">{{ old('message') }}</textarea>
                    </div>
                  <div>
                    <button class="btn" type="submit">Send Message</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-md-4">
              <div class="contact-info">
                <h3>Get in Touch</h3>
                <p class="mb-4">
                  The contact form is currently inactive. Get a functional and
                  working contact form with Ajax & PHP in a few minutes. Just copy
                  and paste the files, add a little code and you're done.                
                </p>
                <h4><i class="fa fa-map-marker"></i>{{ $site_settings->street }}, {{ $site_settings->city }} , {{ $site_settings->country }}</h4>
                <h4><i class="fa fa-envelope"></i>{{ $site_settings->email }}</h4>
                <h4><i class="fa fa-phone"></i>{{ $site_settings->phone }}</h4>
                <div class="social">
                  <a href="{{ $site_settings->twitter }}"><i class="fab fa-twitter"></i></a>
                  <a href="{{ $site_settings->facebook }}"><i class="fab fa-facebook-f"></i></a>
                  <a href="{{ $site_settings->instagram }}"><i class="fab fa-instagram"></i></a>
                  <a href="{{ $site_settings->youtube }}"><i class="fab fa-youtube"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Contact End -->
@endsection