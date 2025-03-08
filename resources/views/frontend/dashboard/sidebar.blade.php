<aside class="col-md-3 nav-sticky dashboard-sidebar">
    <!-- User Info Section -->
    <div class="user-info text-center p-3">
        @php
            $auth_user = Auth::guard('web')->user();
        @endphp
        <img src="{{ $auth_user->provider_id ? $auth_user->image : asset('storage/uploads/' . $auth_user->image) }}"
            alt="User Image" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover" />
        <h5 class="mb-0" style="color: #ff6f61"><strong>{{ Auth::guard('web')->user()->name }}</strong></h5>
    </div>

    <br><br>
    <!-- Sidebar Menu -->
    <div class="list-group profile-sidebar-menu">
        <a href="{{ route('frontend.dashboard.account.profile') }}"
            class="list-group-item list-group-item-action menu-item @yield('profile-status')" data-section="profile">
            <i class="fas fa-user"></i> Profile
        </a>
        <a href="{{ route('frontend.dashboard.notification.index') }}"
            class="list-group-item @yield('notification-status') list-group-item-action menu-item" data-section="notifications">
            <i class="fas fa-bell"></i> Notification
        </a>
        <a href="{{ route('frontend.dashboard.setting.index') }}"
            class="list-group-item list-group-item-action menu-item @yield('setting-status')" data-section="settings">
            <i class="fas fa-cog"></i> Settings
        </a>
        <a href="{{ $site_settings->whatsapp_link }}" class="list-group-item list-group-item-action menu-item"
            data-section="settings">
            <i class="fa fa-question" aria-hidden="true"></i> Support
        </a>
        <a href="" id="logout" class="list-group-item list-group-item-action menu-item"
            data-section="settings">
            <i class="fa fa-power-off" aria-hidden="true"></i> Logout
        </a>
    </div>
</aside>
