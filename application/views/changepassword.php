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
    <?php if (isset($notif)){
    ?>
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <?php if($notif=='1'){
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                    <?php
                    }else{
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel">Gagal</h5>
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
    <?php }
    ?>
    
    <div id="main-wrapper">
        
        <?php $this->load->view('template/navbar');?>
        
        <?php $this->load->view('template/menu');?>
        
        <div class="page-wrapper">
            
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Change Password</h4>
                        
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" action="<?php echo base_url(). 'Board/dochangepassword'; ?>" method="POST">
                                <div class="card-body">
                                    <h4 class="card-title">Personal Info</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Password Lama</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="passlama" placeholder="Password Lama" required/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="passbaru" pattern="[A-Za-z0-9]{8,}" placeholder="Password Baru (min.8 digit kombinasi huruf&angka)" required/>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            
            <?php $this->load->view('template/watermark'); ?>
            
        </div>
        
    </div>
    
    <?php $this->load->view('template/footer');?>
    <script>
        $(document).ready(function(){
            $("#Modal1").modal('show');
        });
    </script>

</body>

</html>