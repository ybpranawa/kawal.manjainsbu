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
                        <h4 class="page-title">Visual Board</h4>
                        
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">

                <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Rekap WO PS PER Teknisi</h5>
                            </div>
                            <table class="table">
                                  <thead>
                                    <tr>
                                      <th bgcolor = "#966C63" scope="col">#</th>
                                      <?php
                                      
                                        $todate = date('d');
                                        $bulan = date('m');
                                        for($x = 1; $x<=$todate; $x++)
                                        {
                                            if($x<10)
                                                $tgl = date('Y-m'). "-0".$x;
                                            else $tgl = date('Y-m'). "-0".$x;

                                            echo "<th bgcolor = '#76D7C4' scope='col'>".$x."</th>";
                                        }
                                        ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                    <?php
                                        
                                        /*$i = 1;
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
                                        } */
                                        //var_dump($count);
                                        $count_array = count($count);
                                        var_dump($count_array);
                                        for($y = 0; $y<$count_array;$y++)
                                        {
                                            echo"<tr>";
                                            echo "<td>".$tek[$y]."</td>";
                                            for($x = 1; $x<=$todate; $x++)
                                            {
                                                if($x<10)
                                                    $tgl = date('Y-m'). "-0".$x;
                                                else $tgl = date('Y-m'). "-".$x;
                                                $ok_ps = 'x';
                                                foreach($count[$y] as $in)
                                                {
                                                    if($in->tanngal == $tgl)
                                                    {
                                                        $ok_ps = $in->jum;
                                                    }
                                                    //else echo "<td>x</td>";
                                                }
                                                if( $ok_ps != 'x')
                                                echo "<td bgcolor = 'yellow'>".$ok_ps."</td>";
                                                else echo "<td>".$ok_ps."</td>";
                                        }
                                        
                                        echo"</tr>";
                                        }
                                    ?>
                                  </tbody>
                            </table>
                        </div>
                
            </div>
            
            <?php $this->load->view('template/watermark'); ?>
            
        </div>
        
    </div>
    
    <?php $this->load->view('template/footer');?>
    
</body>

</html>