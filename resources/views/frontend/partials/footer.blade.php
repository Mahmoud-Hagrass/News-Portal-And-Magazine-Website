<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Get in Touch</h3>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i>{{ $site_settings->country }} , {{ $site_settings->city }}  , {{ $site_settings->street }} </p>
                        <p><i class="fa fa-envelope"></i>{{ $site_settings->email }}</p>
                        <p><i class="fa fa-phone"></i>{{ $site_settings->phone }}</p>
                        <div class="social">
                            <a href="{{ $site_settings->twitter }}" title="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $site_settings->facebook }}" title="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $site_settings->instagram }}"title="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $site_settings->youtube }}" title="youtube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Useful Links</h3>
                    <ul>
                        @foreach($useful_links as $data)
                            <li><a href="{{ $data->url }}" title="{{ $data->name }}">{{ $data->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Quick Links</h3>
                    <ul>
                        <li><a href="#">Lorem ipsum</a></li>
                        <li><a href="#">Pellentesque</a></li>
                        <li><a href="#">Aenean vulputate</a></li>
                        <li><a href="#">Vestibulum sit amet</a></li>
                        <li><a href="#">Nam dignissim</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Newsletter</h3>
                    <div class="newsletter">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Vivamus sed porta dui. Class aptent taciti sociosqu
                        </p>
                        <form action="{{ route('frontend.news-subscribe') }}" method="POST">
                            @csrf
                            <input class="form-control" type="email" name="email" id="email" placeholder="Your email here" />
                            <button class="btn">Submit</button>
                        </form>
                        @error('email')
                               <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
