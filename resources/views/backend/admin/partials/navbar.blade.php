@php
    $admin = getCurrectAuthUser('admin');
@endphp
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search (Visible on Desktop) -->
    <form action="{{ route('admin.general.search') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        @csrf
        <div class="input-group">
            <input name="search" type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            @error('search')
                @php
                    display_error_message($message) ; 
                @endphp
            @enderror
            <select name="option" class="form-control">
                <option value="" disabled @selected(old('option') == null)>Select Option</option>
                <option value="posts">Posts</option>
                <option value="users">Users</option>
                <option value="contacts">Contacts</option>
            </select>
            @error('option')
                @php
                    display_error_message($message) ; 
                @endphp
            @enderror
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only on Mobile) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Search -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form action="{{ route('admin.general.search') }}" method="GET" class="form-inline mr-auto w-100 navbar-search">
                    @csrf
                    <div class="input-group">
                        <input name="search" type="text" class="form-control bg-light border-0" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <select name="option" class="form-control">
                            <option value="posts">Posts</option>
                            <option value="users">Users</option>
                            <option value="contacts">Contacts</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" style="height: 40px;">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        @auth('admin')
            @if ($admin->can('notifications_management'))
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span id="notifications_count" class="badge badge-danger badge-counter">{{ Auth::guard('admin')->user()->unreadNotifications->count() }}</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div id="notification_admin_push" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        @forelse (Auth::guard('admin')->user()->unreadNotifications()->take(5)->get() as $notify)
                            <a class="dropdown-item d-flex align-items-center" href="{{ $notify->data['link'] ?? '' }}?notify_admin={{ $notify->id }}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{ $notify->data['contact_created_at'] ?? '' }}</div>
                                    <span class="font-weight-bold">{{ $notify->data['contact_subject'] ?? '' }}</span>
                                </div>
                            </a>
                        @empty
                            <a class="dropdown-item d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">                      
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500"></div>
                                    <span class="font-weight-bold">No Notifications</span>
                                </div>
                            </a>
                        @endforelse
                    </div>
                </li>
            @endif
        @endauth

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @auth('admin')
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        {{ Auth::guard('admin')->user()->name }}
                    </span>
                @endauth
                <img class="img-profile rounded-circle"
                    src="{{ asset('assets-back/admin') }}/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                @if($admin->can('edit_profile'))
                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Edit Profile
                    </a>
                @endif
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>