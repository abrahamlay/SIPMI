			<aside class="right-side">

                <!-- Content Header (Page header) -->
				 <section class="content-header">
                   <!-- <img src="style/img/logo_pmi.png"> -->
					<h2 class="page-header">Ayo Donor Darah Rek!</h2>
				</section>
				<section class="content">
					<div class="row">
					<div class="col-md-8">
						<div class="box box-danger" >
                                <div class="box-header">
                                    <h3 class="box-title">Lihat Detail Pemesanan Darah </h3>
                                </div>
								<!-- /.box-header -->
                                <div class="box-body">
									<div class="pagination"><?php echo $pagination; ?></div>
								
										<div class="table striped">
											<center><?php echo $table; ?></center>
										</div>
										<br>
									
									<div class="pagination"><?php echo $pagination; ?></div>
									<center><a href="<?php echo base_url().'index.php/pemesananDarah/inputPemesananDarah_admin/'.$id;?>" class="btn btn-lg btn-flat bg-red">Input Pemesanan Darah</a></center>
									
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
						<div class="box box-danger" >
                                <div class="box-header">
                                    <h3 class="box-title">Profil</h3>
                                </div>
								<!-- /.box-header -->
                                <div class="box-body">
									<dl class="dl-horizontal">
										<dt>ID_Member</dt>
                                        <dd><?php echo $member->ID_member;?></dd>
                                        <dt>Nama</dt>
                                        <dd><?php echo $member->nama;?></dd>
                                        <dt>Username</dt>
                                        <dd><?php echo $member->username;?></dd>
                                        <dt>Alamat</dt>
                                        <dd><?php echo $member->Alamat;?></dd>
                                        <dt>No. HP / Telp</dt>
                                        <dd><?php echo $member->NoTelp;?></dd>
                                        <dt>Golongan Darah</dt>
                                        <dd><?php echo $member->Golongan_Darah;?></dd>
                                    </dl>
									<?php echo $link_back;?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
					<div class="col-md-12">
						<div class="box box-danger" >
                                <div class="box-header">
                                    <h3 class="box-title">Lihat Detail Pendonoran Darah </h3>
                                </div>
								<!-- /.box-header -->
                                <div class="box-body">
									<div class="pagination"><?php echo $pagination2; ?></div>
								
										<div class="table striped">
											<center><?php echo $table2; ?></center>
										</div>
										<br>
									
									<div class="pagination"><?php echo $pagination2; ?></div>
								<center>
									<a href="<?php echo base_url().'index.php/pendaftaranPendonor/inputPendaftaranPendonor_admin/'.$id;?>" class="btn btn-lg btn-flat bg-red">Input Pendaftaran Pendonor</a></center>
									
								</div>
							</div>
						</div>
					</div>
				</section>
				