<script src="{{ asset('assets-back/admin') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('assets-back/admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets-back/admin') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets-back/admin') }}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{ asset('assets-back/admin') }}/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets-back/admin') }}/js/demo/chart-area-demo.js"></script>
<script src="{{ asset('assets-back/admin') }}/js/demo/chart-pie-demo.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- FileInput JS Dependencies -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.4/js/plugins/piexif.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.4/js/plugins/sortable.min.js"
    type="text/javascript"></script>

<!-- FileInput Main JS -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.4/js/fileinput.min.js"></script>

<!-- Font Awesome 5 Theme JS (required for the focus button) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.4/themes/fas/theme.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<!-- Font Awesome 5 Theme JS (required for the focus button) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.4/themes/fas/theme.min.js"></script>

@auth
    <script>
        role = "admins";
        id = "{{ Auth::guard('admin')->user()->id }}";
    </script>
@endauth
<script src="{{ asset('build/assets/app-C_v0OSa9.js') }}"></script>

@stack('js')
