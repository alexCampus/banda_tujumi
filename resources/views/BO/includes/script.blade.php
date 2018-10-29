<!-- Bootstrap core JavaScript -->

<script src="{{ asset('js/jquery.blueimp-gallery.min.js') }}"></script>
@yield('script')
<!-- Menu Toggle Script -->
<script>
    $("#btn-wrapper").click(function(e) {
        e.preventDefault();
        if ($('#wrapper').hasClass('toggled')) {
            $("#wrapper").removeClass('toggled');
        } else {
            $("#wrapper").toggleClass("toggled");
        }
    });
</script>
