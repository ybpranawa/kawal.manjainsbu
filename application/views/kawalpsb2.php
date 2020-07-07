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
                                            <th style="font-weight:bold; background:#00964b; color:white">Ket. A2</th>
                                            <th style="font-weight:bold; background:#7400ad; color:white">Action</th>
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
                                            if($_SESSION['role']=='ROLE00004'||$_SESSION['role']=='ROLE00009'){
                                                if($row->vallayananid=='LAY000'||$row->valcustomerid=='CUS000'||$row->channelid==NULL||$row->dataa2_validasideposit=='BELUM'||$row->dataa2_manja==NULL||$row->dataa2_oknok==NULL
                                                ||$row->teknisiid1==NULL||$row->teknisiid2==NULL||$row->datateknis_sektor==NULL||$row->datateknis_tindaklanjut==NULL){
                                            ?>
                                                <div style="display: none;" id="orderid<?php echo $row->datakpro_id;?>"><?php echo ""; ?></div>
                                                <td style="text-align: center"><span class="badge badge-warning">Validasi Belum Lengkap</td>
                                                
                                            <?php  
                                                }else{
                                                ?>
                                                <td style="text-align: center"><input type="text" id="orderid<?php echo $row->datakpro_id;?>" pattern="[0-9]{9}" placeholder="Cth. 50000001 (Tanpa awalan 'SC')" value="<?php echo $row->datakpro_orderid;?>" /><span class="badge badge-success">Validasi Lengkap</td>
                                                
                                                <?php
                                                }
                                            }else{
                                                if($row->datakpro_orderid!=NULL){
                                                    ?>
                                                <td class="badge badge-success"><?php echo $row->datakpro_orderid;?></td>
                                                    <?php
                                                }else{
                                                    ?>
                                                <td class="badge badge-warning"><?php echo "KOSONG"; ?></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                            <?php
                                            if($row->datainputter_drop=='0'){
                                            ?>
                                            <td><?php echo $row->datakpro_myir;?></td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="badge badge-danger"><?php echo $row->datakpro_myir;?></td>
                                            <?php
                                            }
                                            ?>

                                            <td><?php echo $row->datakpro_namacust;?></td>
                                            <td><?php echo $row->datakpro_alamat." - STO ".$row->sto_name;?></td>
                                            <?php
                                            if($_SESSION['role']=='ROLE00002'||$_SESSION['role']=='ROLE00004'||$_SESSION['role']=='ROLE00009'){
                                            ?>
                                                <td>
                                                    <select id="sto<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                        <option value="<?php echo $row->sto_id;?>"><?php echo $row->sto_code;?></option>
                                                        <?php
                                                        foreach($sto as $row7){
                                                            if($row7->sto_id=='STO00000'){
                                                                continue;
                                                            }else{
                                                        ?>
                                                        <option value="<?php echo $row7->sto_id;?>"><?php echo $row7->sto_code;?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            <?php
                                            }else{
                                            ?>
                                                <td id="sto<?php echo $row->datakpro_id;?>"><?php echo $row->sto_code;?></td>
                                            <?php
                                            }
                                            ?>
                                            

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
                                            if($_SESSION['role']=='ROLE00002'){
                                            ?>
                                            <td><select id="teknisi1<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                <option value="<?php echo $row->teknisiid1;?>"><?php echo $row->teknisiname1;?></option>
                                            <?php foreach ($teknisi as $row2){
                                                ?>
                                                <option value="<?php echo $row2->teknisi_id; ?>"><?php echo $row2->teknisi_name;?></option>
                                                <?php
                                                }?>
                                                </select>
                                            </td>

                                            <td><select id="teknisi2<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                <option value="<?php echo $row->teknisiid2;?>"><?php echo $row->teknisiname2;?></option>
                                            <?php foreach ($teknisi as $row2){
                                                ?>
                                                <option value="<?php echo $row2->teknisi_id; ?>"><?php echo $row2->teknisi_name;?></option>
                                                <?php
                                                }?>
                                                </select>
                                            </td>

                                            <td><select id="sektor<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                <option value="<?php echo $row->datateknis_sektor;?>"><?php echo $row->datateknis_sektor;?></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            </td>

                                            <td><select id="statuswo<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                <option value="<?php echo $row->statusorderid;?>"><?php echo $row->statusorder;?></option>
                                                <?php foreach ($statusorder as $row6){
                                                ?>
                                                <option value="<?php echo $row6->statusorder_id;?>"><?php echo $row6->statusorder_name;?></option>
                                                <?php
                                                }
                                                ?>
                                                
                                            </select></td>

                                            <td>
                                                <textarea id="keterangan<?php echo $row->datakpro_id;?>"><?php echo $row->datateknis_keterangan;?></textarea>
                                            </td>
                                            
                                            <?php }else if ($_SESSION['role']=='ROLE00005' || $_SESSION['role']=='ROLE00004'
                                            ||$_SESSION['role']=='ROLE00009'||$_SESSION['role']=='ROLE00006'||$_SESSION['role']=='ROLE00003'||$_SESSION['role']=='ROLE00001'){
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
                                            }    
                                            ?>



                                            <?php
                                            if($_SESSION['role']=='ROLE00002' || $_SESSION['role']=='ROLE00004'
                                            ||$_SESSION['role']=='ROLE00009'||$_SESSION['role']=='ROLE00006'||$_SESSION['role']=='ROLE00003'||$_SESSION['role']=='ROLE00001' ){
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
                                                <?php
                                                }
                                                ?>
                                     
                                            <?php }else if($_SESSION['role']=='ROLE00005'||$_SESSION['role']=='ROLE00009'){?>
                                                <td><select id="layanan<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                    <option value="<?php echo $row->vallayananid;?>"><?php echo $row->vallayanan;?></option>
                                                    <?php foreach($vallayanan as $row3){
                                                    ?>
                                                    <option value="<?php echo $row3->validasilayanan_id;?>"><?php echo $row3->validasilayanan_name;?></option>
                                                    <?php
                                                    } 
                                                    ?>
                                                </select></td>

                                                <td><select id="customer<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                    <option value="<?php echo $row->valcustomerid;?>"><?php echo $row->valcustomer; ?></option>
                                                    <?php foreach($valcustomer as $row4){
                                                    ?>
                                                    <option value="<?php echo $row4->validasicustomer_id;?>"><?php echo $row4->validasicustomer_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select></td>

                                                <td><select id="channel<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                    <option value="<?php echo $row->channelid;?>"><?php echo $row->channel; ?></option>
                                                    <?php foreach($channel as $row5){
                                                    ?>
                                                    <option value="<?php echo $row5->channel_id;?>"><?php echo $row5->channel_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select></td>

                                                <td><select id="deposit<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                    <?php if ($row->dataa2_validasideposit=='SUDAH')
                                                    {
                                                    ?>
                                                        <option value="SUDAH">Sudah Deposit</option>
                                                        <option value="BELUM">Belum Deposit</option>
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <option value="BELUM">Belum Deposit</option>
                                                        <option value="SUDAH">Sudah Deposit</option>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                    
                                                </select></td>
                                                <td>
                                                    <!-- <input type="text" class="form-control date-inputmask"  placeholder="Enter Date"> -->
                                                    <?php
                                                    if($row->dataa2_manja==NULL){
                                                    ?>
                                                    <input type="text" id="manja<?php echo $row->datakpro_id;?>" class="datetime"/>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <input type="text" value="<?php echo $row->dataa2_manja;?>" id="manja<?php echo $row->datakpro_id;?>" class="datetime">
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </td>
                                            <?php } ?>
                                            <?php
                                                if($_SESSION['role']=='ROLE00005'){
                                            ?>
                                            <td><select id="oknok<?php echo $row->datakpro_id;?>" class="select2 form-control custom-select" style="width: 125px; height:36px;">
                                                <option value="<?php echo $row->dataa2_oknok?>"><?php echo $row->dataa2_oknok?></option>
                                                <option value="OK">OK</option>
                                                <option value="NOK">NOK</option>
                                            </select>
                                            </td>
                                            <?php }else{
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
                                            <?php } ?>

                                            <?php
                                            if($_SESSION['role']=='ROLE00005'){
                                            ?>
                                            <td>
                                                <textarea id="keterangana2<?php echo $row->datakpro_id;?>"><?php echo $row->dataa2_keterangan;?></textarea>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td>
                                                <?php echo $row->dataa2_keterangan; ?>
                                            </td>
                                            <?php
                                            }
                                            ?>

                                            <td>
                                                <?php
                                                if($_SESSION['role']=='ROLE00002'){
                                                ?>
                                                <button type="button" id="<?php echo $row->datakpro_id;?>" onClick="updateTL(this.id)" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Save"><span class="mdi mdi-checkbox-marked-outline"></span></button>
                                                <!-- <a href="updateTL" type="button" class="btn btn-success">Save</a> -->
                                                <?php }else if($_SESSION['role']=='ROLE00005'){?>
                                                <button type="button" id="<?php echo $row->datakpro_id;?>" onClick="updateA2(this.id)" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Save"><span class="mdi mdi-checkbox-marked-outline"></span></button>
                                                <?php }else if($_SESSION['role']=='ROLE00004'){
                                                ?>
                                                <button type="button" id="<?php echo $row->datakpro_id;?>" onClick="updateInputter(this.id)" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Save"><span class="mdi mdi-checkbox-marked-outline"></span></button>
                                                <button type="button" id="<?php echo $row->datakpro_id;?>" onClick="dropData(this.id)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Drop"><span class="mdi mdi-delete-forever"></span></button>
                                                <?php
                                                }else if($_SESSION['role']=='ROLE00009'){
                                                ?>
                                                <button type="button" id="<?php echo $row->datakpro_id;?>" onClick="updateA2(this.id)" class="btn btn-success">Save Verifikasi</button>
                                                <button type="button" id="<?php echo $row->datakpro_id;?>" onClick="updateInputter(this.id)" class="btn btn-success">Save SC</button>
                                                <button type="button" id="<?php echo $row->datakpro_id;?>" onClick="dropData(this.id)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Drop"><span class="mdi mdi-delete-forever"></span></button>
                                                <?php
                                                } ?>
                                                <button type="button" id="<?php echo $row->datakpro_id;?>" onClick="editData(this.id)" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit/Undrop"><span class="mdi mdi-pen"></span></button>
                                            </td>
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

                <div class="row">
                    <div class="col-md-12">
                        <p>Keterangan:</p>
                        <p><span class="badge badge-danger">MYIR-XXXXXXX</span> = order sudah di drop/tidak valid. untuk edit gunakan tombol edit/undrop maka akan masuk ke menu kawal order</p>
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

        function editData(id){
            // alert(id);
            var formid=document.getElementById("formid"+id).textContent;
            // var orderid=document.getElementById("orderid"+id).value;

            try{
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('Board/editData')?>",
                    dataType : "text",
                    data : {
                        'form':formid
                        // 'order':orderid 
                    },
                    success: function(d){
                        toastr.success('Data berhasil di edit', 'Sukses');
                        // location.reload();
                        window.location.assign("<?php echo base_url('Board/kawalpsb')?>");
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