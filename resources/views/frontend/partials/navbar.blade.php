<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{ route('frontend.index') }}" class="nav-item nav-link @yield('home-status')">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle @yield('category-status')" data-toggle="dropdown">Catgories</a>
                        <div class="dropdown-menu">
                            @foreach($categories as $category)
                                <a href="{{ route('frontend.category-posts' , $category->slug) }}" class="dropdown-item">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="single-page.html" class="nav-item nav-link">Single Page</a>
                    <a href="dashboard.html" class="nav-item nav-link">Dashboard</a>
                    <a href="{{ route('frontend.contact-us.index') }}" class="nav-item nav-link @yield('contact-status')">Contact Us</a>
                </div>
                <div class="social ml-auto">
                    <a href="{{ $site_settings->twitter }}" title="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $site_settings->facebook }}" title="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $site_settings->instagram }}" title="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $site_settings->youtube }}" title="youtube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
