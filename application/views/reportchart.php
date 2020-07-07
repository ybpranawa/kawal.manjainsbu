<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $this->load->view('template/header');?>
    
</head>

<body>

    <input type="hidden" value="<?php echo $orderprogress;?>" id="orderprogress">
    <input type="hidden" value="<?php echo $kendalateknik;?>" id="kendalateknik">
    <input type="hidden" value="<?php echo $kendalapelanggan;?>" id="kendalapelanggan">
    <input type="hidden" value="<?php echo $belumtl;?>" id="belumtl">
    <input type="hidden" value="<?php echo $inputvalid;?>" id="inputvalid">
    <input type="hidden" value="<?php echo $kendalalayanan;?>" id="kendalalayanan">
    <input type="hidden" value="<?php echo $kendalapela2;?>" id="kendalapela2">
    <input type="hidden" value="<?php echo $kendaladeposit;?>" id="kendaladeposit">
    <input type="hidden" value="<?php echo $belumvalid;?>" id="belumvalid">
    <input type="hidden" value="<?php echo $inputsc;?>" id="inputsc">
    <input type="hidden" value="<?php echo $kendalatl;?>" id="kendalatl">
    <input type="hidden" value="<?php echo $kendalaa2;?>" id="kendalaa2">
    <?php $inpt=$kendalatl+$kendalaa2-$beluminputter; echo $inpt;?>
    <input type="hidden" value="<?php echo $beluminputter;?>" id="beluminputter">
    
    <div class="row">
    
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><h3>Resume Order by TL (Datel SBU Metro)</h3> <?php echo date('Y-m-d H:i:s');?></h5>
                    <!-- <div class="pie" style="height: 400px;"></div> -->
                    <!-- <div id="legendPlaceholder" style="height: 400px;"></div> -->
                    <div id="flottl" style="height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><h3>Resume Order by A2 (Datel SBU Metro)</h3> <?php echo date('Y-m-d H:i:s');?></h5>
                    <!-- <div class="pie" style="height: 400px;"></div> -->
                    <!-- <div id="legendPlaceholder" style="height: 400px;"></div> -->
                    <div id="flota2" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><h3>Resume Order by Inputter (Datel SBU Metro)</h3> <?php echo date('Y-m-d H:i:s');?></h5>
                    <!-- <div class="pie" style="height: 400px;"></div> -->
                    <!-- <div id="legendPlaceholder" style="height: 400px;"></div> -->
                    <div id="flotinputter" style="height: 400px;"></div>
                </div>
            </div>
        </div>

        <!-- <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><h3>Total Order by STO</h3> <?php echo date('Y-m-d H:i:s');?></h5>
                    <!-- <div class="pie" style="height: 400px;"></div> -->
                    <!-- <div id="legendPlaceholder" style="height: 400px;"></div> -->
                    <div id="flotsto" style="height: 400px;"></div>
                </div>
            </div>
        </div> -->
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
    
    <?php $this->load->view('template/footer');?>
    <script type="text/javascript">
        $(function () { 
            var datatl = [
                {label: "Order Terprogress", data:$('#orderprogress').val()},
                {label: "Kendala Teknik", data: $('#kendalateknik').val()},
                {label: "Kendala Pelanggan", data: $('#kendalapelanggan').val()},
                {label: "Belum Update Web", data: $('#belumtl').val()},
            ];

            var dataa2 = [
                {label: "Input Valid", data:$('#inputvalid').val()},
                {label: "Kendala Layanan", data: $('#kendalalayanan').val()},
                {label: "Kendala Pelanggan", data: $('#kendalapela2').val()},
                {label: "Kendala Deposit", data: $('#kendaladeposit').val()},
                {label: "Belum Validasi", data: $('#belumvalid').val()},
            ];

            var datainputter = [
                {label: "Input SC", data:$('#inputsc').val()},
                {label: "Kendala TL", data: $('#kendalatl').val()},
                {label: "Kendala A2", data: $('#kendalaa2').val()},
                {label: "Belum Terprogress", data: $('#beluminputter').val()},
            ];

            var datasto= [
                {label: "BBE", data:10},
                {label: "KRP", data: 20},
                {label: "KBL", data: 30},
                {label: "KNN", data: 40},
            ];
            

            var options = {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 3/4,
                            formatter: function(label,point){
                                return('<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+point.data[0][1]+'</div>');
                                
                            },
                            background: { 
                                opacity: 0.5,
                                color: '#000'
                            }
                        }
                    }
                }
                // legend: {
                //     show: false
                // }

                
            };

            $.plot($("#flottl"), datatl, options);  
            $.plot($("#flota2"), dataa2, options);  
            $.plot($("#flotinputter"), datainputter, options);  
            // $.plot($("#flotsto"), datasto, options);  
             
            
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
