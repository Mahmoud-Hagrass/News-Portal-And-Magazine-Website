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
                    <a href="{{ route('frontend.dashboard.account.profile') }}" class="nav-item nav-link @yield('user-dashboard-status')">Dashboard</a>
                    <a href="{{ route('frontend.contact-us.index') }}" class="nav-item nav-link @yield('contact-status')">Contact Us</a>
                </div>
                <!-- Social Links and Notification Dropdown -->
                <div class="social ml-auto justify-content-between d-flex align-items-center">
                    <!-- Notification Dropdown -->
                      <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-bell"></i>
                      <span id="count-notification" class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown"
                      style="width: 300px;">
                      <a href="{{ route('frontend.dashboard.notification.mark-all-as-read') }}" style="inline-block; margin-left:30px" class="dropdown-item"><strong>Mark All As Read</strong></a>
                      @forelse (Auth::user()->unreadNotifications as $notify)
                        <div id="push-notification">
                            @php
                                $url = $notify->data['link'] ?? '#'; // Retuen to '#' if link is not available
                                $url .= '?notify=' . $notify->id; // Append the notify ID to the URL
                           @endphp
                            <div class="dropdown-item d-flex justify-content-between align-items-center">
                                <a href="{{ $url }}" class="dropdown-item"><i class="fa fa-eye"></i>New Post Comment :{{ substr($notify->data['post_title'] , 0 , 14) }}</a>
                            </div>
                        </div>
                      @empty
                          
                      @endforelse
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
