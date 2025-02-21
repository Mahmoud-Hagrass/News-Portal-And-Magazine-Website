<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets-front') }}/lib/easing/easing.min.js"></script>
<script src="{{ asset('assets-front') }}/lib/slick/slick.min.js"></script>

<!-- FileInput JS -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.4/js/plugins/piexif.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.4/js/plugins/sortable.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.4/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>

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

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets-front') }}/js/main.js"></script>

<!--Laravel Echo Build Scripts-->
@auth
    <script>
        role="users" ; 
        id = "{{ Auth::user()->id }}";
    </script>    
@endauth
<script src="{{ asset('build/assets/app-C_v0OSa9.js') }}"></script>
@stack('js')
