<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon.png');?>">
    <title>Kawal SBU</title>
    <!-- Custom CSS -->
    <!-- <link href="<?php echo base_url('assets/libs/flot/css/float-chart.css');?>" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <link href="<?php echo base_url('dist/css/style.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/select2/dist/css/select2.min.css');?>">
    <script src="<?php echo base_url('assets/libs/jquery/dist/jquery.min.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/jquery-minicolors/jquery.minicolors.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/quill/dist/quill.snow.css');?>"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/extra-libs/multicheck/multicheck.css');?>"> -->
    <!-- <link href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css');?>" rel="stylesheet"> -->
    
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"/> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.bootstrap4.min.css"/>


    <link href="<?php echo base_url('assets/libs/toastr/build/toastr.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');?>">
    <!-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->
    
    <!-- <link href="<?php echo base_url('assets/libs/flot/css/float-chart.css');?>" rel="stylesheet"> -->
    
</head>

<body>
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <div id="main-wrapper">
        
        <?php $this->load->view('template/navbar');?>
        
        <?php $this->load->view('template/menu');?>
        
        <div class="page-wrapper">
            
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">DATA <?php echo $judul; ?></h4> 
                        
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title">Basic Datatable</h5> -->
                            <?php //var_dump($teknisi);?>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="font-weight:bold; background:#4000ff; color:white">No</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">SC</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">MYIR</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Nama</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Alamat</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">STO</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Contact Person</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Paket</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">ODP Input</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Marketing Info</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Agency</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Milestone KPRO</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Status</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Tanggal Order</th>
                                            <th style="font-weight:bold; background:#b00707; color:white">Teknisi1</th>
                                            <th style="font-weight:bold; background:#b00707; color:white">Teknisi2</th>
                                            <th style="font-weight:bold; background:#b00707; color:white">Sektor</th>
                                            <th style="font-weight:bold; background:#b00707; color:white">Update TL</th>
                                            <th style="font-weight:bold; background:#b00707; color:white">Keterangan</th>
                                            <th style="font-weight:bold; background:#00964b; color:white">Validasi Layanan</th>
                                            <th style="font-weight:bold; background:#00964b; color:white">Validasi Customer</th>
                                            <th style="font-weight:bold; background:#00964b; color:white">Channel</th>
                                            <th style="font-weight:bold; background:#00964b; color:white">Status Deposit</th>
                                            <th style="font-weight:bold; background:#00964b; color:white">Manja</th>
                                            <th style="font-weight:bold; background:#00964b; color:white">OK/NOK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        foreach($query as $row){
                                        ?>
                                        <div style="display: none;" id="formid<?php echo $row->datakpro_id;?>"><?php echo $row->datakpro_id; ?></div>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <?php                                             
                                                if($row->datakpro_orderid!=NULL){
                                                    ?>
                                                <td class="badge badge-success"><?php echo $row->datakpro_orderid;?></td>
                                                    <?php
                                                }else{
                                                    ?>
                                                <td class="badge badge-warning"><?php echo "KOSONG"; ?></td>
                                                    <?php
                                                }
                                            ?>
                                            
                                            <td><?php echo $row->datakpro_myir;?></td>
                                            <td><?php echo $row->datakpro_namacust;?></td>
                                            <td><?php echo $row->datakpro_alamat." - STO ".$row->sto_name;?></td>
                                            <td><?php echo $row->sto_name;?></td>                                     
                                            <td><?php echo $row->datakpro_nohp;?></td>
                                            <td><?php echo $row->datakpro_packagename;?></td>                                        

                                            <?php 
                                            if($row->datakpro_alpro!=NULL){
                                                ?>
                                            <td class="badge badge-success"><?php echo $row->datakpro_alpro;?></td>
                                                <?php
                                            }else{
                                                ?>
                                            <td class="badge badge-warning"><?php echo "KOSONG"?></td>
                                                <?php
                                            }
                                            ?>
                                            <td><?php echo $row->datakpro_salesid."-".$row->datakpro_salesname."-".$row->datakpro_saleshp."-".$row->datakpro_salestelegram;?></td>
                                            <td><?php echo $row->lokername;?></td>
                                            <td><?php echo $row->datakpro_statusresume;?></td>
                                            <td><?php echo $row->datakpro_statusmessage;?></td>
                                            <td><?php echo $row->datakpro_tanggalinput;?></td>  
                                                <?php
                                                if($row->teknisiid1==NULL){
                                                    ?>
                                                    <td><span class="badge badge-warning">KOSONG</td>
                                                    <?php }else{    
                                                    ?>
                                                    <td><?php echo $row->teknisiname1;?></td>
                                                    <?php
                                                }
                                                if($row->teknisiid2==NULL){
                                                    ?>
                                                    <td><span class="badge badge-warning">KOSONG</td>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <td><?php echo $row->teknisiname2;?></td>
                                                    <?php
                                                }
                                                if($row->datateknis_sektor==NULL){
                                                    ?>
                                                    <td><span class="badge badge-warning">Belum Mapping Sektor</td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td><?php echo $row->datateknis_sektor;?></td>
                                                    <?php
                                                }
                                                
                                                if ($row->datateknis_tindaklanjut==NULL){
                                                    ?>
                                                    <td><span class="badge badge-warning">Belum ada Update</td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td><?php echo $row->statusorder;?></td>
                                                    <?php
                                                }
                                                
                                                if($row->datateknis_keterangan==NULL){
                                                    ?>
                                                    <td><span class="badge badge-warning">Kosong</td>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <td><?php echo $row->datateknis_keterangan; ?></td>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if($row->vallayananid!='LAY001'){
                                                 ?>
                                                    <td><span class="badge badge-warning"><?php echo $row->vallayanan;?></span></td>
                                                    
                                                <?php
                                                }else{
                                                ?>
                                                    <td><span class="badge badge-success"><?php echo $row->vallayanan;?></span></td>
                                                    
                                                <?php
                                                }
                                                ?>

                                                <?php if($row->valcustomerid!='CUS001'){
                                                ?>
                                                    <td><span class="badge badge-warning"><?php echo $row->valcustomer;?></span></td>
                                                    
                                                <?php
                                                }else{
                                                ?>
                                                    <td><span class="badge badge-success"><?php echo $row->valcustomer;?></span></td> 
                                                <?php
                                                }
                                                ?>

                                                <td><?php echo $row->channel;?></span></td>
                                                <?php if($row->dataa2_validasideposit!='SUDAH'){
                                                ?>
                                                    <td><span class="badge badge-warning"><?php echo $row->dataa2_validasideposit;?></span></td>
                                                <?php
                                                }else{
                                                ?>
                                                    <td><span class="badge badge-success"><?php echo $row->dataa2_validasideposit;?></span></td>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                if($row->dataa2_manja==NULL){
                                                ?>
                                                <td><span class="badge badge-warning">BELUM ASSIGN MANJA</span></td>
                                                <?php
                                                }else{
                                                ?>
                                                <td><span class="badge badge-success"><?php echo $row->dataa2_manja;?></span></td>
                                                <?php
                                                }
                                                if($row->dataa2_oknok=='OK'){
                                                ?>
                                                <td><span class="badge badge-success"><?php echo $row->dataa2_oknok;?></td>
                                                <?php
                                                    }else if($row->dataa2_oknok=='NOK'){
                                                ?>
                                                    <td><span class="badge badge-danger"><?php echo $row->dataa2_oknok;?></td>
                                                <?php } else{
                                                ?>
                                                    <td><span class="badge badge-warning">BELUM VALIDASI</td>
                                                <?php
                                                    }
                                                ?>
                                                <td><?php echo $row->dataa2_keterangan; ?></td>
                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                
            </div>
            
            <?php $this->load->view('template/watermark'); ?>
        </div>
       
    </div>
     
        
    <!-- Bootstrap tether Core JavaScript -->
    <!-- <script src="<?php echo base_url('assets/libs/popper.js/dist/umd/popper.min.js');?>"></script> -->
    <script src="<?php echo base_url('assets/libs/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/extra-libs/sparkline/sparkline.js');?>"></script>
    <!--Wave Effects -->
    <!-- <script src="<?php echo base_url('dist/js/waves.js');?>"></script> -->
    <!--Menu sidebar -->
    <!-- <script src="<?php echo base_url('dist/js/sidebarmenu.js');?>"></script> -->
    <!--Custom JavaScript -->
    <script src="<?php echo base_url('dist/js/custom.min.js');?>"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <!-- <script src="<?php echo base_url('assets/libs/flot/excanvas.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.pie.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.time.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.stack.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.crosshair.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js');?>"></script>
    <script src="<?php echo base_url('dist/js/pages/chart/chart-page-init.js');?>"></script> -->
    <script src="<?php echo base_url('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('dist/js/pages/mask/mask.init.js');?>"></script>
    <!-- <script src="<?php echo base_url('assets/libs/select2/dist/js/select2.full.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/select2/dist/js/select2.min.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/jquery-asColor/dist/jquery-asColor.min.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/jquery-asGradient/dist/jquery-asGradient.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/jquery-minicolors/jquery.minicolors.min.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script> -->
    <script type="text/javascript" src="<?php echo base_url('assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js');?>" charset="UTF-8"></script>
    <!-- <script src="<?php echo base_url('assets/libs/quill/dist/quill.min.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/extra-libs/multicheck/datatable-checkbox-init.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/extra-libs/multicheck/jquery.multicheck.js');?>"></script> -->
    <script src="<?php echo base_url('assets/extra-libs/DataTables/datatables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/toastr/build/toastr.min.js');?>"></script>

    

    <!-- <script src="<?php echo base_url('assets/libs/chart/matrix.interface.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/chart/excanvas.min.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/flot/jquery.flot.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.pie.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.time.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.stack.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/flot/jquery.flot.crosshair.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/chart/jquery.peity.min.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/chart/matrix.charts.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/libs/chart/jquery.flot.pie.min.js');?>"></script> -->
    <script src="<?php echo base_url('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/chart/turning-series.js');?>"></script>
    <!-- <script src="<?php echo base_url('dist/js/pages/chart/chart-page-init.js');?>"></script> -->
    

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script> -->

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
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('.datetime').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose:true
        });
        var datepick=function(){
            $('.datetime').datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                autoclose:true
            });
        }
        var table=$('#zero_config').DataTable({
            "pageLength": 3,
            scrollY:        "50vh",
            scrollX:        true,
            scrollCollapse: true,
            paging:         true,
            fixedColumns:   {
                // leftColumns: 4,
                rightColumns: 1
            }
        });

        $('#zero_config').on('draw.dt', function () {
            datepick();
            $('[data-toggle="tooltip"]').tooltip();
        });

        
    </script>
    <!-- HAPUS 
    <script>
        function updateTL(id){
            // alert(id);
            var formid=document.getElementById("formid"+id).textContent;
            var teknisi1=document.getElementById("teknisi1"+id).value;
            var teknisi2=document.getElementById("teknisi2"+id).value;
            var sektor=document.getElementById("sektor"+id).value;
            var statuswo=document.getElementById("statuswo"+id).value;
            var keterangan=document.getElementById("keterangan"+id).value;
            var sto=document.getElementById("sto"+id).value;

            try{
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('Board/updateTL')?>",
                    dataType : "text",
                    data : {
                        'form':formid,
                        'tek1':teknisi1, 
                        'tek2':teknisi2, 
                        'sek':sektor,
                        'statwo':statuswo,
                        'ket':keterangan,
                        'sto':sto
                    },
                    success: function(d){
                        toastr.success('Data berhasil di update', 'Sukses');
                        //alert('bisa');
                    }
                });
            }catch (e){
                console.log(e);
            }
            

        }

        function updateA2(id){
            // alert(id);
            var formid=document.getElementById("formid"+id).textContent;
            var lay=document.getElementById("layanan"+id).value;
            var cust=document.getElementById("customer"+id).value;
            var chn=document.getElementById("channel"+id).value;
            var dep=document.getElementById("deposit"+id).value;
            var man=document.getElementById("manja"+id).value;
            // var sto=document.getElementById("sto"+id).value;
            // var sto=$("#sto"+id).text();
            var ok=document.getElementById("oknok"+id).value;
            // alert(sto);
            try{
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('Board/updateA2')?>",
                    dataType : "text",
                    data : {
                        'form':formid,
                        'vallayanan':lay, 
                        'valcustomer':cust,
                        'channel':chn,
                        'deposit':dep,
                        'manja':man,
                        // 'sto':sto,
                        'oknok':ok
                    },
                    success: function(d){
                        toastr.success('Data berhasil di update', 'Sukses');
                        //alert('bisa');
                    }
                });
            }catch (e){
                console.log(e);
            }
            

        }

        function updateInputter(id){
            // alert(id);
            var formid=document.getElementById("formid"+id).textContent;
            var orderid=document.getElementById("orderid"+id).value;
            if (orderid==''){
                orderid='0';
            }

            var sto=document.getElementById("sto"+id).value;

            alert(orderid);

            // try{
            //     $.ajax({
            //         type : "POST",
            //         url  : "<?php echo base_url('Board/updateInputter')?>",
            //         dataType : "text",
            //         data : {
            //             'form':formid,
            //             'order':orderid,
            //             'sto':sto
            //         },
            //         success: function(d){
            //             toastr.success('Data berhasil di update', 'Sukses');
            //             //alert('bisa');
            //         }
            //     });
            // }catch (e){
            //     console.log(e);
            // }
            

        }

        function dropData(id){
            // alert(id);
            var formid=document.getElementById("formid"+id).textContent;
            // var orderid=document.getElementById("orderid"+id).value;

            try{
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('Board/dropData')?>",
                    dataType : "text",
                    data : {
                        'form':formid
                        // 'order':orderid 
                    },
                    success: function(d){
                        toastr.success('Data berhasil di update', 'Sukses');
                        location.reload();
                        //alert('bisa');
                    }
                });
            }catch (e){
                console.log(e);
            }
            

        }
        
        

    </script>
    
    -->

</body>

</html>