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
                        <h4 class="page-title">Dashboard</h4>
                        
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">  
                    <!-- inputan HI--> 
                    <div class="col-md-6 col-lg-12 col-xlg-3">
                        <div class="card card-hover">
                            <a href="viewdata/1">
                                <div class="box bg-info text-center">
                                    <h1 class="text-white"><?php echo count($jumlah_wo); ?></h1>
                                    <h4 class="text-white">Inputan <?php echo $today; ?></h4></a>
                                </div>
                            </a>
                        </div>
                    </div>                 
                    <div class="col-md-6 col-lg-6 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h4 class="text-white">OK</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h4 class="text-white">NOK</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <a href="viewdata/2">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><?php echo count($ok_sc); ?></h1>
                                    <h5 class="text-white">KELUAR SC</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <a href="viewdata/3">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><?php echo count($ok_blmsc); ?></h1>
                                    <h5 class="text-white">BELUM KELUAR SC</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <a href="viewdata/4">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><?php echo count($nok_depo); ?></h1>
                                    <h5 class="text-white">SUDAH DEPOSIT</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <a href="viewdata/5">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><?php echo count($nok_blmdepo); ?></h1>
                                    <h5 class="text-white">BELUM DEPOSIT</h5>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- TEKNISI -->
                    <div class="col-md-6 col-lg-6 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h3 class="text-white">UBIS</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h3 class="text-white">A2</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <a href="viewdata/6">
                                <div class="box bg-danger text-center">
                                    <h1 class="font-light text-white"><?php echo count($so_ok); ?></h1>
                                    <h6 class="text-white">OK</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <a href="viewdata/7">
                                <div class="box bg-danger text-center">
                                    <h1 class="font-light text-white"><?php echo count($so_nok); ?></h1>
                                    <h6 class="text-white">NOK</h6>
                                </div>
                            </a>
                        </div>
                    </div> 
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                        <a href="viewdata/8">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><?php echo count($so_blm_update); ?></h1>
                                <h6 class="text-white">BELUM UPDATE</h6>
                            </div>
                        </a>
                        </div>
                    </div>                   
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                        <a href="viewdata/9">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><?php echo count($a2_ok); ?></h1>
                                <h6 class="text-white">OK</h6>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                        <a href="viewdata/10">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><?php echo count($a2_nok); ?></h1>
                                <h6 class="text-white">NOK</h6>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                        <a href="viewdata/11">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><?php echo count($a2_blmdivalidasi); ?></h1>
                                <h6 class="text-white">BELUM VALIDASI</h6>
                            </div>
                        </a>
                        </div>
                    </div>


                    <!--div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><?php echo $teknisi_null; ?></h1>
                                <h6 class="text-white">Belum Assign Teknisi</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><?php echo $tek_not_update; ?></h1>
                                <h6 class="text-white">Teknisi BLM Update</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
                                <h6 class="text-white">Elements</h6>
                            </div>
                        </div>
                    </div-->
                </div>
                    
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Grafik Input HI</h4>
                                        <h5 class="card-subtitle">By Witel</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- column -->
                                    <div class="col-md-12">
                                    
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Input vs Valid</h5>
                                                <!-- <div id="flot-placeholder" style="width:700px;height:400px;"></div> -->
                                                <!-- <canvas id="myChart" width="400" height="400"></canvas> -->
                                                <canvas id="bar-chart-grouped" width="800" height="450"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- column -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Rekap WO Teknisi</h5>
                            </div>
                            <table class="table">
                                  <thead>
                                    <tr>
                                      <th bgcolor = "#966C63" scope="col">#</th>
                                      <th bgcolor = "#76D7C4" scope="col">UBIS</th>
                                      <th bgcolor = "#76D7C4" scope="col">Nama Teknisi 1</th>
                                      <th bgcolor = "#76D7C4" scope="col">Nama Teknisi 2</th>
                                      <th bgcolor = "#76D7C4" scope="col">Order</th>
                                      <th bgcolor = "#76D7C4" scope="col">Kendala</th>
                                      <th bgcolor = "#76D7C4" scope="col">Belum Update</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                    <?php
                                        $i = 1;
                                        foreach($vb_teknisi as $vb)
                                        {
                                            $teknisi1 = $vb->tek1_name;
                                            $teknisi2 = $vb->tek2_name;
                                            if($teknisi1 == NULL AND $teknisi2 == NULL)
                                            {
                                                $teknisi1 = "KOSONG";$teknisi2 = "KOSONG";
                                            }
                                            echo"<tr>
                                            <th scope='row'>$i</th>
                                            <td>$vb->ubis</td>
                                            <td>$teknisi1</td>
                                            <td>$teknisi2</td>
                                            <td>$vb->jumlah_wo</td>
                                            <td>BELUM</td>
                                            <td>BELUM</td>
                                            </tr>";
                                            $i++;
                                        }
                                    ?>
                                  </tbody>
                            </table>
                        </div>
                
            </div-->
            
            <?php $this->load->view('template/watermark'); ?>
            
        </div>
        
    </div>
    
    <?php $this->load->view('template/footer');?>
    <script>
		new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
            labels: ["BBE", "KRP", "LKI", "KNN", "TNS", "KLN", "KBL", "MGO", "KPS", "KJR"],
            datasets: [
                {
                label: "Input",
                backgroundColor: "blue",
                data: [<?php echo $bbe . ',' . $krp . ',' . $lki . ',' . $knn . ',' . $tns . ',' . $kln . ',' . $kbl . ',' . $mgo . ',' . $kps . ',' . $kjr ; ?>]
                }, {
                label: "Valid Ubis",
                backgroundColor: "red",
                data: [<?php echo $bbe_valid . ',' . $krp_valid . ',' . $lki_valid . ',' . $knn_valid . ',' . $tns_valid . ',' . $kln_valid . ',' . $kbl_valid . ',' . $mgo_valid . ',' . $kps_valid . ',' . $kjr_valid ; ?>]
                }, {
                label: "Valid A2",
                backgroundColor: "green",
                data: [<?php echo $bbe_valid_a2 . ',' . $krp_valid_a2 . ',' . $lki_valid_a2 . ',' . $knn_valid_a2 . ',' . $tns_valid_a2 . ',' . $kln_valid_a2 . ',' . $kbl_valid_a2 . ',' . $mgo_valid_a2 . ',' . $kps_valid_a2 . ',' . $kjr_valid_a2 ; ?>]
                }
            ]
            },
            options: {
            title: {
                display: true,
                text: 'Group by SO'
            }
            }
        });
	</script>
    

</body>

</html>