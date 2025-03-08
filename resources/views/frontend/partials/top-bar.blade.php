    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tb-contact">
                        <p><i class="fas fa-envelope"></i><a href="mailto:{{ $site_settings->email }}" style="cursor: pointer; text-decoration: none; color: inherit; cursor: default;">{{ $site_settings->email }}</a></p>
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
                            <a href="#" id="logout">Logout</a>
                        @endauth()
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('js')
  <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    });

        $(document).on('click', '#logout', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You want to logout!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes , Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('logout') }}",
                        type: "POST",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Logged out successfully",
                                    icon: "success",
                                }).then(() => {
                                    // Redirect to login page after logout
                                    window.location.href = "{{ route('login') }}";
                                });
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "An error occurred while trying to logout.",
                                    icon: "error",
                                });
                            }
                        },
                    });
                }
            });

        });

  </script>
@endpush