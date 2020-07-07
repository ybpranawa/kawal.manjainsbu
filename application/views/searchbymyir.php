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
                        <h4 class="page-title">Search by MYIR</h4>
                        
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" action="dosearchmyir" enctype="multipart/form-data" method="post">
                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <label class="col-md-2">Kode MYIR</label>
                                        <div class="col-md-10">
                                            <input type="text" name="myir" required/>
                                            <!-- <div class="custom-file">
                                                <input type="file" name="datakpro" class="custom-file-input" id="validatedCustomFile" required>
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div> -->
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
                <div class="row">
                    <div class="col-md-12">
                        <p>*)Format MYIR-xxxxxxxxxxxxxx</p>
                    </div>
                </div>
                
                
            </div>
            
            <?php $this->load->view('template/watermark'); ?>
        </div>
       
    </div>
     
    <?php $this->load->view('template/footer');?>

</body>

</html>