<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

</div>
<!-- Sparkline -->
<script src="{{ asset('public/assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('public/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('public/assets/plugins/chart.js/Chart.min.js') }}"></script>

<!-- JQVMap -->
{{-- <script src="{{ asset('public/assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('public/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{ asset('public/assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('public/assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- daterangepicker -->
<script src="{{ asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<!-- Summernote -->
<script src="{{ asset('public/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('public/assets/dist/js/pages/dashboard.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('public/assets/dist/js/demo.js') }}"></script> --}}


<script src="{{ asset('public/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>



<script src="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('public/assets/sweetalert.min.js') }}"></script>

<script src="{{ asset('public/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('public/assets/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('public/assets/plugins/ckeditor/ckeditor.js') }}"></script>

{{-- dropzone --}}
<script src="{{ asset('public/assets/plugins/dropzone/dropzone.min.js') }}"></script>

{{-- filepond --}}
<script src="{{ asset('public/assets/plugins/filepond/filepond.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-file-metadata.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-file-poster.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-image-preview.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-image-transform.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-image-resize.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-image-edit.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-file-validate-type.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-file-validate-size.js') }}"></script>
<script src="{{ asset('public/assets/plugins/filepond/filepond-plugin-image-crop.js') }}"></script>


{{-- date time picker --}}
<script src="{{ asset('public/assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {


        $('.filepond--credits').text('');

        $(".select2_single").select2({
            placeholder: "Select ",
            allowClear: true
        });

        $('.datepicker').datepicker({
            autoclose: true,
            dateFormat: 'dd-mm-yyyy'
        }).val();
        $('#datepicker2').datepicker({
            autoclose: true,
            dateFormat: 'dd-mm-yyyy'
        }).val();

        jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No White space Allowed");

    });
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginImageTransform,
        FilePondPluginImageResize,
        FilePondPluginImageCrop,
        FilePondPluginFileValidateType,
    );
</script>
