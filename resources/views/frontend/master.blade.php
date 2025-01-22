<!DOCTYPE html>
<html lang="en">
      @include('frontend.partials.head')
  <body>
    <!-- Top Bar Start -->
      @include('frontend.partials.top-bar')
    <!-- Top Bar Start -->

    <!-- Brand Start -->
      @include('frontend.partials.top-search-bar')
    <!-- Brand End -->

    <!-- Nav Bar Start -->
      @include('frontend.partials.navbar')
    <!-- Nav Bar End -->

     @yield('content')

    <!-- Footer Start -->
    @include('frontend.partials.footer')
    <!-- Footer End -->

    <!-- Footer Menu Start -->
      @include('frontend.partials.footer-menu')
    <!-- Footer Menu End -->

    <!-- Footer Bottom Start -->
     @include('frontend.partials.footer-copyrights')
    <!-- Footer Bottom End -->

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    @include('frontend.partials.scripts')
    @flasher_render
  </body>
</html>
