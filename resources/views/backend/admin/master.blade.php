<!DOCTYPE html>
<html lang="en">

@include('backend.admin.partials.head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
           @include('backend.admin.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                 @include('backend.admin.partials.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                   @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           @include('backend.admin.partials.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('backend.admin.partials.scroll')

    <!-- Logout Modal-->
   @include('backend.admin.partials.logout_modal')

    <!-- Bootstrap core JavaScript-->
    @include('backend.admin.partials.scripts')

</body>

</html>