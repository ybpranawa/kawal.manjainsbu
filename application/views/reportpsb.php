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
                        <h4 class="page-title">Report Pasang Baru </h4>
                    </div>
                    <div class="col-12 d-flex no-block align-items-center">
                        <p><?php setlocale (LC_TIME, "id_ID");
                        echo strftime( "%A, %d %B %Y %H:%M", time());?></p>
                    </div>
                    
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6>Search Report by Tanggal Order</h6>
                            </div>
                            <div class="card-body">
                                <form action="searchreportpsb" method="post">
                                    From : <input id="startDate" width="276" name="startdate"/>
                                    To: <input id="endDate" width="276" name="enddate" />
                                    <button type="submit"  class="btn btn-success">Cari</button>
                                    <button type="submit" formaction="downloaddata" class="btn btn-success">Download Excel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title">Basic Datatable</h5> -->
                            <?php //var_dump($teknisi);?>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">No</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">SC</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">MYIR</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Nama</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Alamat</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">STO</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Contact Person</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Paket</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">ODP Input</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Marketing Info</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Agency</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Milestone KPRO</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Status</th>
                                            <th style="font-weight:bold; background:#4000ff; color:white; text-align: center">Tanggal Order</th>
                                            <th style="font-weight:bold; background:#b00707; color:white; text-align: center">Teknisi1</th>
                                            <th style="font-weight:bold; background:#b00707; color:white; text-align: center">Teknisi2</th>
                                            <th style="font-weight:bold; background:#b00707; color:white; text-align: center">Sektor</th>
                                            <th style="font-weight:bold; background:#b00707; color:white; text-align: center">Update TL</th>
                                            <th style="font-weight:bold; background:#b00707; color:white; text-align: center">Keterangan</th>
                                            <th style="font-weight:bold; background:#00964b; color:white; text-align: center">Validasi Layanan</th>
                                            <th style="font-weight:bold; background:#00964b; color:white; text-align: center">Validasi Customer</th>
                                            <th style="font-weight:bold; background:#00964b; color:white; text-align: center">Channel</th>
                                            <th style="font-weight:bold; background:#00964b; color:white; text-align: center">Status Deposit</th>
                                            <th style="font-weight:bold; background:#00964b; color:white; text-align: center">Manja</th>
                                            <th style="font-weight:bold; background:#00964b; color:white; text-align: center">OK/NOK</th>
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
                                            if($row->datakpro_orderid!=NULL){
                                                ?>
                                            <td class="badge badge-success"><?php echo $row->datakpro_orderid;?></td>
                                                <?php
                                            }else{
                                                ?>
                                            <td class="badge badge-warning"><?php echo "KOSONG";?></td>
                                                <?php
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
                                            <td><?php echo $row->sto_code;?></td>
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
                                                <td><span class="badge badge-warning">BELUM MAPPING SEKTOR</td>
                                                <?php }else{
                                                ?>
                                                <td><?php echo $row->datateknis_sektor;?></td>
                                                <?php
                                                }
                                                
                                                if ($row->datateknis_tindaklanjut==NULL){
                                                ?>
                                                <td><span class="badge badge-warning">BELUM ADA UPDATE</td>
                                                <?php
                                                }else{
                                                ?>
                                                <td><?php echo $row->statusorder;?></td>
                                                <?php
                                                }
                                                
                                                if($row->datateknis_keterangan==NULL){
                                                ?>
                                                <td><span class="badge badge-warning">KOSONG</td>
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
                                                <?php
                                                }
                                                ?>
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
                                                <td><?php echo $row->dataa2_keterangan; ?></td>
                                                <td><button type="button" id="<?php echo $row->datakpro_id;?>" onClick="editData(this.id)" class="btn btn-success"><span class="mdi mdi-pen"></span></button></td>
                                            

                                            
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
                        'ket':keterangan
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
                        'deposit':dep
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
    <script>
            var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
            
            $('#startDate').datepicker({
                uiLibrary: 'bootstrap4',
                iconsLibrary: 'fontawesome',
                minDate: today,
                autoclose:true,
                format:'yyyy-mm-dd',
                maxDate: function () {
                    return $('#endDate').val();
                }
            });
            $('#endDate').datepicker({
                uiLibrary: 'bootstrap4',
                iconsLibrary: 'fontawesome',
                autoclose:true,
                format:'yyyy-mm-dd',
                minDate: function () {
                    return $('#startDate').val();
                }
            });
                
       
    </script>

</body>

</html>