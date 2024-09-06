 <!-- jQuery -->
 <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
 <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <!-- jQuery UI 1.11.4 -->

 <script src="{{ asset('assets/jszip/jszip.min.js') }}"></script>
 <script src="{{ asset('assets/pdfmake/pdfmake.min.js') }}"></script>
 <script src="{{ asset('assets/pdfmake/vfs_fonts.js') }}"></script>

 <!-- JQVMap -->
 <script src="{{ asset('assets/jqvmap/jquery.vmap.min.js') }}"></script>
 <script src="{{ asset('assets/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
 <!-- daterangepicker -->
 <script src="{{ asset('assets/moment/moment.min.js') }}"></script>
 <script src="{{ asset('assets/daterangepicker/daterangepicker.js') }}"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="{{ asset('assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
 <!-- Summernote -->
 <!-- overlayScrollbars -->
 <script src="{{ asset('assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
 <!-- AdminLTE App -->
 <script src="{{ asset('dist/js/adminlte.js') }}"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="{{ asset('dist/jquery/jquery-3.6.0.min.js') }}"></script>
 <script src="{{ asset('assets/jquery-ui/jquery-ui.min.js') }}"></script>
 <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
 <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/plugins/rangePlugin.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>




 <script>

    function hideDiv(e) {
    var divID = $(e).data("dismiss");
    $("#" + divID).toggle();
    table.ajax.reload();
}
 </script>