<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="tb-contact">
                    <p><i class="fas fa-envelope"></i>{{ $site_settings->email }}</p>
                    <p><i class="fas fa-phone-alt"></i>{{ $site_settings->phone }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tb-menu">
                    @guest
                        <a href="{{ route('register') }}">Register</a>
                        <a href="{{ route('login') }}">Login</a>
                    @endguest
                    @auth()
                        <a href="javascript:void(0)" onclick="submitLogoutForm()">Logout</a>
                    @endauth()
                    <form  id="submitLogoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function submitLogoutForm(){
            if(confirm('Are you sure you want to logout?')) {
                document.getElementById('submitLogoutForm').submit() ; 
            }
        }
    </script>
@endpush