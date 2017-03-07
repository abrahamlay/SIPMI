
		  <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url()?>style/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $profil->nama;?></p>
                            </div>
                    </div>
                   
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo base_url();?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/pemesananDarah/LihatPemesananDarah_member/'.$profil->ID_member;?>">
                                <i class="fa fa-edit"></i> <span>Pemesanan Darah</span>
							</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().'index.php/pendaftaranPendonor/LihatpendaftaranPendonor_member/'.$profil->ID_member;?>">
                                <i class="fa fa-edit"></i> <span>Pendaftaran Pendonor</span>
							</a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>