<!DOCTYPE html>
<html dir="ltr">

<head>
    <?php $this->load->view('template/header');?>
</head>

<body>
    <?php
    $notif=$this->uri->segment(3);
    $pesan=$this->uri->segment(4);
    if(isset($notif)){
    ?>
    
    <div style="display: none;" id="notif"><?php echo $notif;?></div>
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
                    if ($notif==1){
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel">BERHASIL</h5>
                    <?php
                    }else if($notif==0){
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel">GAGAL</h5>
                    <?php
                    }
                    ?>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $pesan;?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <!-- <span class="input-group-text bg-primary text-white">Form Pra Order Sales SBU</span> -->
                        <h3 style="color:white;">Form pra Order Sales SBU</h3>
                    </div>
                    <!-- Form --> 
                    
                    <form class="form-horizontal m-t-20" action="<?php echo base_url(). 'Board/tambah_po_inputan'; ?>" method="post">
                        <div class="row p-b-30">
                            <div class="col-12">
                                
								<div class="input-group mb-3">
                                    <div class="input-group-prepend" style="width:100%;">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                        <select class="select2 form-control custom-select" name="sto" aria-describedby="basic-addon1" required>
                                            <option>PILIH STO</option>
                                            <!-- <option value="STO00009"><?php echo "KBL - KEBALEN";?></option> -->
                                            <?php
                                            foreach ($sto as $row){
                                                if($row->sto_code=='ALL'){
                                                    continue;
                                                }else{
                                            ?>
                                                <option value="<?php echo $row->sto_id;?>"><?php echo $row->sto_code." - ".$row->sto_name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                        </select>
                                    </div>
									
                                </div>
								
								<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input name="myir" type="text" class="form-control form-control-lg" pattern="MYIR?-.+" placeholder="MYIR-10123456789XXX" aria-label="MYIR" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Nama Pelanggan" name = "nama_pelanggan" aria-label="Nama Pelanggan" aria-describedby="basic-addon1" required>
                                </div>
								
								<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input name="hp_pelanggan" type="text" pattern="[0-9]{10,}" class="form-control form-control-lg" placeholder="No HP Pelanggan" aria-label="No HP Pelanggan" aria-describedby="basic-addon1" required>
                                </div>
								
								<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
									<textarea name="alamat_pelanggan" class="form-control form-control-lg" placeholder="Alamat Lengkap Pelanggan" aria-label="Alamat Pelanggan" aria-describedby="basic-addon1" required></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="ODP. Contoh: ODP-KBL-FAS/01" aria-label="ODP Input" name="alpro" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Paket" aria-label="Paket" name="paket" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="number" class="form-control form-control-lg" pattern="[0-9]{5,}" placeholder="Nominal Deposit tanpa titik" aria-label="Deposit" name="deposit" aria-describedby="basic-addon1" required>
                                </div>
                                
								
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" pattern="[A-Z0-9]{7}" placeholder="KContact Huruf Kapital" aria-label="KContact" name="kcontact" aria-describedby="basic-addon1" required>
                                </div>
								<div class="input-group mb-3">
                                    <div class="input-group-prepend" style="width: 100%;">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                        <select  class="select2 form-control custom-select"  name="agency" aria-describedby="basic-addon1" required>
                                            <option>PILIH AGENCY</option>
                                            <?php
                                            foreach ($agency as $row2){
                                                if($row2->loker_akronim=='SKIP'){
                                                    continue;
                                                }else{
                                            ?>
                                                <option value="<?php echo $row2->loker_id;?>"><?php echo $row2->loker_akronim." - ".$row2->loker_name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
									
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon2"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Nama Sales" aria-label="Nama Sales" name="nama_sales" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon2"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" pattern="[0-9]{10,}" placeholder="No HP Sales" name = "hp_sales" aria-label="No HP Sales" aria-describedby="basic-addon1" required>
                                </div>
								<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" pattern="@[A-Za-z0-9_.-]+" placeholder="ID Telegram Sales diawali @" name = "idtele_sales" aria-label="ID Telegram Sales" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <?php $this->load->view('template/footer');?>
    <script>
        $(document).ready(function(){
            var notif=document.getElementById("notif").textContent;
            if (notif != null){
                $("#Modal1").modal('show');
            }
        });
    </script>
</body>

</html>