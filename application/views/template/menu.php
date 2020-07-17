<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url();?>Board/dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url();?>Board/visualboard" aria-expanded="false"><i class="mdi mdi-bell font-24"></i><span class="hide-menu">Visual Board</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url();?>Board/searchbymyir" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Search by MYIR</span></a></li>
                        <?php
                        if ($_SESSION['role']=='ROLE00006'){
                        ?>
                        <!-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-network-upload"></i><span class="hide-menu">Upload WO </span></a> -->
                            <ul aria-expanded="false" class="collapse  first-level"> 
                                <li class="sidebar-item"><a href="<?php echo base_url();?>Board/uploadpsb" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i><span class="hide-menu"> Pasang Baru </span></a></li>
                                <li class="sidebar-item"><a href="<?php echo base_url();?>Board/uploadggn" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i><span class="hide-menu"> Gangguan </span></a></li>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Kawal WO </span></a>
                            <ul aria-expanded="false" class="collapse  first-level"> 
                                <li class="sidebar-item"><a href="<?php echo base_url();?>Board/kawalpsb" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i><span class="hide-menu"> Pasang Baru </span></a></li>
                                <li class="sidebar-item"><a href="<?php echo base_url();?>Board/kawalggn" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i><span class="hide-menu"> Gangguan </span></a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Report </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo base_url();?>Board/reportpsb" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i><span class="hide-menu"> Pasang Baru </span></a></li>
                                <li class="sidebar-item"><a href="<?php echo base_url();?>Board/reportggn" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i><span class="hide-menu"> Gangguan </span></a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>