<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $this->load->view('template/header');?>
    
</head>

<body>

    <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">KABAR BAIK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?php echo base_url();?>assets/images/turbo.jpg" width="100% ">
                    <p>Telah dilakukan perubahan kode program untuk load data</p>
                    <p>Semoga tambah cepet</p>
                    <p>Jangan lupa selalu di update agar data tidak nandon dan memberatkan server</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                    <?php
                                            $i = 1;
                                            $ubis = '';
                                            $jum = count($ubs);
                                            $datel_lmg_blm = 0;
                                            $datel_lmg_all = 0;
                                            $datel_lmg_kendala = 0;
                                            $chart_wo = '';
                                            $chart_blm = '';
                                            $chart_kendala = '';


                                            
                                            
                                            for($k=0;$k<$jum;$k++)
                                            {
                                                $ubis = $ubs[$k];
                                                if($id_sto[$k] == 'STO00001' || $id_sto[$k] == 'STO00003' || $id_sto[$k] == 'STO00017' || $id_sto[$k] == 'STO00019')
                                                {
                                                    $datel_lmg_blm = $datel_lmg_blm + $wo_blm[$k];
                                                    $datel_lmg_all = $datel_lmg_all + $wo_total[$k];
                                                    $datel_lmg_kendala = $datel_lmg_kendala + $wo_kendala[$k];

                                                }
                                                else
                                                {
                                                    $chart_wo = $chart_wo . $wo_total[$k] . ',';
                                                    $chart_blm = $chart_blm . $wo_blm[$k] . ',';
                                                    $chart_kendala = $chart_kendala . $wo_kendala[$k] . ',';
                                                }
                                                
                                                $i++;
                                            }    
                                            $chart_wo = $chart_wo . $datel_lmg_all;
                                            $chart_blm = $chart_blm . $datel_lmg_blm;
                                            $chart_kendala = $chart_kendala . $datel_lmg_kendala;
                                        ?>
                                        <h4 class="card-title">Grafik INPUT vs KENDALA vs BELUM UPDATE</h4>
                                        <h5 class="card-subtitle">By Unit Bisnis</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- column -->
                                    <div class="col-md-12">
                                    
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Kendala vs Belum Update vs Total WO</h5>
                                                <!-- <div id="flot-placeholder" style="width:700px;height:400px;"></div> -->
                                                <!-- <canvas id="myChart" width="400" height="400"></canvas> -->
                                                <canvas id="bar-chart-grouped1" width="800" height="450"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- column -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Grafik Input MTD</h4>
                                        <h5 class="card-subtitle">By Witel</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- column -->
                                    <div class="col-md-12">
                                    
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Input </h5>
                                                <!-- <div id="flot-placeholder" style="width:700px;height:400px;"></div> -->
                                                <!-- <canvas id="myChart" width="400" height="400"></canvas> -->
                                                <canvas id="bar-chart-grouped-mtd" width="800" height="450"></canvas>
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
                                      <th bgcolor = "#76D7C4" scope="col">Order</th>
                                      <th bgcolor = "#76D7C4" scope="col">Belum Update</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                    <?php
                                        /*
                                        $i = 1;
                                        $ubis = '';
                                        $jum = count($ubs);
                                        
                                        for($k=0;$k<$jum;$k++)
                                        {
                                            $ubis = $ubs[$k];
                                            
                                            echo"<tr>
                                            <th scope='row'>$i</th>
                                            <td>$ubis</td>
                                            <td>".$wo_total[$k]."</td>
                                            <td>".$wo_blm[$k]."</td>
                                            </tr>";
                                            $i++;
                                        }
                                    */?>
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
            labels: ["BBE", "KRP", "LKI", "KNN", "TNS", "KLN", "KBL", "MGO", "KPS", "KJR", "LMG"],
            datasets: [
                {
                label: "Input",
                backgroundColor: "blue",
                data: [<?php echo $bbe . ',' . $krp . ',' . $lki . ',' . $knn . ',' . $tns . ',' . $kln . ',' . $kbl . ',' . $mgo . ',' . $kps . ',' . $kjr . ',' . $lmg ; ?>]
                }, {
                label: "Valid Ubis",
                backgroundColor: "red",
                data: [<?php echo $bbe_valid . ',' . $krp_valid . ',' . $lki_valid . ',' . $knn_valid . ',' . $tns_valid . ',' . $kln_valid . ',' . $kbl_valid . ',' . $mgo_valid . ',' . $kps_valid . ',' . $kjr_valid . ',' . $lmg_valid ; ?>]
                }, {
                label: "Valid A2",
                backgroundColor: "green",
                data: [<?php echo $bbe_valid_a2 . ',' . $krp_valid_a2 . ',' . $lki_valid_a2 . ',' . $knn_valid_a2 . ',' . $tns_valid_a2 . ',' . $kln_valid_a2 . ',' . $kbl_valid_a2 . ',' . $mgo_valid_a2 . ',' . $kps_valid_a2 . ',' . $kjr_valid_a2 . ',' . $lmg_valid_a2 ; ?>]
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

        $(document).ready(function(){
            $("#Modal3").modal('show');
        });
	</script>

    <script>
		new Chart(document.getElementById("bar-chart-grouped-mtd"), {
            type: 'bar',
            data: {
            labels: ["BBE", "KRP", "LKI", "KNN", "TNS", "KLN", "KBL", "MGO", "KPS", "KJR", "LMG"],
            datasets: [
                {
                label: "Input",
                backgroundColor: "#87CEFA",
                data: [<?php echo $bbe_mtd . ',' . $krp_mtd . ',' . $lki_mtd . ',' . $knn_mtd . ',' . $tns_mtd . ',' . $kln_mtd . ',' . $kbl_mtd . ',' . $mgo_mtd . ',' . $kps_mtd . ',' . $kjr_mtd . ',' . $lmg_mtd ; ?>]
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

        $(document).ready(function(){
            $("#Modal3").modal('show');
        });
	</script>
    
    <script>        
        new Chart(document.getElementById("bar-chart-grouped1"), {
            type: 'bar',
            data: {
            labels: ["BBE", "KBL", "KJR", "KLN", "KNN", "KPS", "KRP", "LKI", "MGO", "TNS", "LMG"],
            datasets: [
                {
                label: "KENDALA TL",
                backgroundColor: "#3e95cd",
                data: [<?php echo $chart_kendala; ?>]                
                }, {
                label: "BELUM UPDATE TL",
                backgroundColor: "#8e5ea2",
                data: [<?php echo $chart_blm; ?>]
                },
                {
                label: "TOTAL WO",
                backgroundColor: "#F08080",
                data: [<?php echo $chart_wo; ?>]
                }
            ]
            },
            options: {
            title: {
                display: true,
                text: 'WORK ORDER (TOTAL MYIR)'
            }
            }
        });
    </script>
</body>

</html>