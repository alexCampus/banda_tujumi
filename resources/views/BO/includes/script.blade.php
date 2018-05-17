<!-- Bootstrap core JavaScript -->

<script src="{{ asset('js/jquery.blueimp-gallery.min.js') }}"></script>
@yield('script')
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
