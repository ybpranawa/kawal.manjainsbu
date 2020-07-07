<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $this->load->view('template/header');?>
    
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
                        <h4 class="page-title"><?php echo $kata;?></h4> &nbsp
                        <a href = "../dashboard">                
                        <button type="button" class="btn btn-outline-secondary">Kembali ke Dashboard</button></a>
                        
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
                                            <th style="font-weight:bold; background:#00964b; color:white">A2 OK/NOK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                       
                                        foreach($query as $row)
                                        {
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
                                                <td id="sto<?php echo $row->datakpro_id;?>"><?php echo $row->sto_code;?></td>
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
                                                        }else{
                                                        ?>
                                                        <td><?php echo $row->teknisiname2;?></td>
                                                        <?php
                                                        }
                                                        if($row->datateknis_sektor==NULL){
                                                        ?>
                                                        <td><span class="badge badge-warning">Belum Mapping Sektor</td>
                                                        <?php }else{
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
                                                        }else{
                                                        ?>
                                                        <td><?php echo $row->datateknis_keterangan; ?></td>
                                                        <?php
                                                        }
                                                    ?>
                                                        <?php if($row->vallayananid!='LAY001'){
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
                                                    
                                                   <?php } ?>
                                                    <?php
                                                        
                                                        if($row->dataa2_oknok=='OK'){
                                                    ?>
                                                        <td><span class="badge badge-success"><?php echo $row->dataa2_oknok;?></td>
                                                    <?php
                                                        }else if($row->dataa2_oknok=='NOK'){
                                                    ?>
                                                        <td><span class="badge badge-danger"><?php echo $row->dataa2_oknok;?></td>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td><span class="badge badge-warning">BELUM VALIDASI</td>
                                                    <?php
                                                        }
                                                    ?>
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


    <?php $this->load->view('template/footer');?>
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
            var keta2=document.getElementById("keterangana2"+id).value;
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
                        'oknok':ok,
                        'ket':keta2
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
            if (!orderid){
                orderid='0';
            }
            // var orderid="tes";

            var sto=document.getElementById("sto"+id).value;

            // alert(orderid);

            try{
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('Board/updateInputter')?>",
                    dataType : "text",
                    data : {
                        'form':formid,
                        'order':orderid,
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
    
     
      
    <!-- Bootstrap tether Core JavaScript -->
    <!-- <script src="<?php echo base_url('assets/libs/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/extra-libs/sparkline/sparkline.js');?>"></script>

    <script src="<?php echo base_url('dist/js/custom.min.js');?>"></script>
   
    <script src="<?php echo base_url('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('dist/js/pages/mask/mask.init.js');?>"></script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js');?>" charset="UTF-8"></script>
    
    <script src="<?php echo base_url('assets/extra-libs/DataTables/datatables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/toastr/build/toastr.min.js');?>"></script>

    <script src="<?php echo base_url('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/chart/turning-series.js');?>"></script>

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

        
    </script> -->
    
</body>

</html>