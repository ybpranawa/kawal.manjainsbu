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
                        <h4 class="page-title">Kawal Pasang Baru</h4>                        
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <!-- <marquee><h4>Jadwals maintenance: Sabtu s/d Minggu 29 Feb-1 Mar (all day). Agenda: instalasi container dan management console pada server kawal.manjainsbu.com</h4></marquee> -->
                    </div>
                </div>
                
                <?php if ($_SESSION['role'] == 'ROLE00002')
                    {
                ?>
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <form class="form-horizontal m-t-20" action="<?php echo base_url(). 'Board/downloaddata_inbox'; ?>" method="post">                
                             <button class="btn btn-outline-secondary" align="right" type="submit">DOWNLOAD</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
                     
            </div>
            
            
            <div class="container-fluid">
                <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Popup Header</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Here is the text coming you can put also image if you want…
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ModalTanggal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Assign Manja</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Manja</label>
                                    <div class="col-sm-9">
                                        <p class="idform"></p>
                                        <input type="text" id="tgl" class="datetime"/>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ModalTeknisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Assign Teknisi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Teknisi 1</label>
                                    <div class="col-sm-9">
                                        <select id="tek1" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                        <?php foreach ($teknisi as $row){
                                        ?>
                                        <option value="<?php echo $row->teknisi_id;?>"><?php echo $row->teknisi_name;?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Teknisi 2</label>
                                    <div class="col-sm-9">
                                        <select id="tek2" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                        <?php foreach ($teknisi as $row){
                                        ?>
                                        <option value="<?php echo $row->teknisi_id;?>"><?php echo $row->teknisi_name;?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ModalStatuswo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select id="statusorder" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                        <?php foreach ($statusorder as $row){
                                        ?>
                                        <option value="<?php echo $row->statusorder_id;?>"><?php echo $row->statusorder_name;?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ModalChannel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Assign Channel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Channel</label>
                                    <div class="col-sm-9">
                                        <p class="idform"></p>
                                        <select id="channel<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                            <?php foreach($channel as $row5){
                                            ?>
                                            <option value="<?php echo $row5->channel_id;?>"><?php echo $row5->channel_name; ?></option>
                                            <?php
                                            }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Filter A2</h5>
                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15">Filter By STO</label>
                                    <div class="col-md-4">
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="stoid">
                                            <?php foreach($sto as $row){
                                            ?>
                                            <option value="<?php echo $row->sto_id;?>"><?php echo $row->sto_code;?></option>
                                            <?php   
                                            }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" id="filtera2submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> -->

                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title">Basic Datatable</h5> -->
                            <?php //var_dump($teknisi);?>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="font-weight:bold; background:#4000ff; color:white">Form ID</th>
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
                                            <th style="font-weight:bold; background:#00964b; color:white">Ket. A2</th>
                                            <th style="font-weight:bold; background:#7400ad; color:white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
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

        var table = $('#zero_config').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "ordering": true,
            
            "ajax": {
                "url": "<?php echo base_url('Board/serverside')?>",
                "type": "POST"
            },
            // "info":true,
            // "paging":true,
            "pageLength": 5,
            scrollY:        "500px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         true,

            columnDefs: [
                { width: 150, targets: 2 },
                { width: 200, targets: 3 },
                { width: 200, targets: 4 },
                { width: 400, targets: 5 },
                { width: 350, targets: 10 },
                { width: 150, targets: 11 },
                { width: 150, targets: 14 },
                
                { width: 200, targets: 15 },
                { width: 200, targets: 16 },
                { width: 100, targets: 17 },
                { width: 200, targets: 18 },

                { width: 200, targets: 19 },
                { width: 100, targets: 20 },
                { width: 100, targets: 21 },
                { width: 200, targets: 22 },
                { width: 200, targets: 24 },
                { width: 100, targets: 25 },
                { width: 250, targets: 26 },

                {
                    targets:0,
                    visible: false
                    // searchable: false
                }

            ],
            
            fixedColumns:   {
                rightColumns: 1
            },

            createdRow: function (row, data, index) {
                $(row).addClass('datetime');
                $('td', row).eq(2).css('font-weight', 'bold');
            }

        });

        $("#filtera2submit").click(function(){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Board/serverside')?>",
                data: { 
                    stoid: $("#stoid").val()
                },
                success: function(result) {
                    alert(result);
                },
                error: function(result) {
                    alert('error');
                }
            });
        });

        $(function(){
            
            
            $('#ModalTanggal').on('show.bs.modal', function (event) {
                var idform=null;
                var button = $(event.relatedTarget);
                idform = button.data('formid');
                // $('.idform').html(null);
                // $('.idform').append(idform);
                $('#ModalTanggal').on('click', '.btn-primary', function(){
                    var manja=$('#tgl').val();
                    $("#tanggal"+idform).val(manja);
                    $('#ModalTanggal').modal('hide');
                    manja=null;
                });
                $('#ModalTanggal').on('hidden.bs.modal', function(){
                    button=null;
                    idform=null;
                });
            });
           
        });

        $(function(){
            $('#ModalTeknisi').on('show.bs.modal', function (event) {
                $('#tek1').select2({
                    dropdownParent: $('#ModalTeknisi')
                });
                $('#tek2').select2({
                    dropdownParent: $('#ModalTeknisi')
                });
                var idform=null;
                var button = $(event.relatedTarget);
                idform = button.data('formid');
                // $('.idform').html(null);
                // $('.idform').append(idform);
                $('#ModalTeknisi').on('click', '.btn-primary', function(){
                    var tn1 = document.getElementById('tek1');
                    var tn2 = document.getElementById('tek2');
                    var teknisi1=$('#tek1').val();
                    var teknisi2=$('#tek2').val();
                    var teknisiname1=tn1.options[tn1.selectedIndex].text;
                    var teknisiname2=tn2.options[tn2.selectedIndex].text;
                    $("#teknisi1"+idform).val(teknisi1);
                    $('#teknisiname1'+idform).val(teknisiname1);

                    $("#teknisi2"+idform).val(teknisi2);
                    $('#teknisiname2'+idform).val(teknisiname2);
                    $('#ModalTeknisi').modal('hide');
                    teknisi1=null;
                    teknisi2=null;
                    // alert(teknisiname1);
                });
                $('#ModalTeknisi').on('hidden.bs.modal', function(){
                    button=null;
                    idform=null;
                });
            });
        });

        $(function(){
            $('#ModalStatuswo').on('show.bs.modal', function (event) {
                $('#statusorder').select2({
                    dropdownParent: $('#ModalStatuswo')
                });
                
                var idform=null; 
                var button = $(event.relatedTarget);
                idform = button.data('formid');
                // $('.idform').html(null);
                // $('.idform').append(idform);
                $('#ModalStatuswo').on('click', '.btn-primary', function(){
                    var statwo = document.getElementById('statusorder');
                    var stat=$('#statusorder').val();
                    var statname=statwo.options[statwo.selectedIndex].text;
                    
                    $("#statuswo"+idform).val(stat);
                    $('#statuswoname'+idform).val(statname);

                    
                    $('#ModalStatuswo').modal('hide');
                    stat=null;
                    statname=null;
                    // alert(teknisiname1);
                });
                $('#ModalStatuswo').on('hidden.bs.modal', function(){
                    button=null;
                    idform=null;
                });
            });
        });


        $(function(){
            
            
            $('#ModalChannel').on('show.bs.modal', function (event) {
                var idform=null;
                var button = $(event.relatedTarget);
                idform = button.data('formid');
                // $('.idform').html(null);
                // $('.idform').append(idform);
                $('#ModalChannel').on('click', '.btn-primary', function(){
                    var manja=$('#tgl').val();
                    $("#channel"+idform).val(manja);
                    $('#ModalChannel').modal('hide');
                    manja=null;
                });
                $('#ModalChannel').on('hidden.bs.modal', function(){
                    button=null;
                    idform=null;
                });
            });
           
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
            var man=document.getElementById("tanggal"+id).value;
            // var sto=document.getElementById("sto"+id).value;
            // var sto=$("#sto"+id).text();
            var ok=document.getElementById("oknok"+id).value;
            var keta2=document.getElementById("keterangana2"+id).value;
            // alert(sto);
            if(formid==''||lay==''||cust==''||chn==''||dep==''||man==''||ok==''||keta2==''){
                toastr.error('Lengkapi data validasi', 'Error');
            }else{
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
                // alert('ok');
            }
        }

        function updateInputter(id){
            // alert(id);
            var formid=document.getElementById("formid"+id).textContent;
            var orderid=document.getElementById("orderid"+id).value;
            // alert(orderid);
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
                        location.reload();
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
    
    

</body>

</html>