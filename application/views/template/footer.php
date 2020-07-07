    
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url('assets/libs/popper.js/dist/umd/popper.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/extra-libs/sparkline/sparkline.js');?>"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url('dist/js/waves.js');?>"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url('dist/js/sidebarmenu.js');?>"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url('dist/js/custom.min.js');?>"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="<?php echo base_url('assets/libs/flot/excanvas.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.pie.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.time.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.stack.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.crosshair.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js');?>"></script>
    <script src="<?php echo base_url('dist/js/pages/chart/chart-page-init.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('dist/js/pages/mask/mask.init.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/select2/dist/js/select2.full.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/select2/dist/js/select2.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/jquery-asColor/dist/jquery-asColor.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/jquery-asGradient/dist/jquery-asGradient.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/jquery-minicolors/jquery.minicolors.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js');?>" charset="UTF-8"></script>
    <script src="<?php echo base_url('assets/libs/quill/dist/quill.min.js');?>"></script>
    <!-- <script src="<?php echo base_url('assets/extra-libs/multicheck/datatable-checkbox-init.js');?>"></script> -->
    <script src="<?php echo base_url('assets/extra-libs/multicheck/jquery.multicheck.js');?>"></script>
    <script src="<?php echo base_url('assets/extra-libs/DataTables/datatables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/toastr/build/toastr.min.js');?>"></script>

    

    <script src="<?php echo base_url('assets/libs/chart/matrix.interface.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/chart/excanvas.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.pie.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.time.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.stack.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.crosshair.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/chart/jquery.peity.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/chart/matrix.charts.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/chart/jquery.flot.pie.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/chart/turning-series.js');?>"></script>
    <script src="<?php echo base_url('dist/js/pages/chart/chart-page-init.js');?>"></script>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
     
    
    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function(value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        // var quill = new Quill('#editor', {
        //     theme: 'snow'
        // });

    </script>