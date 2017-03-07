<aside class="right-side">

                <!-- Content Header (Page header) -->
				 <section class="content-header">
                   <!-- <img src="style/img/logo_pmi.png"> -->
					<h2 class="page-header">Ayo Donor Darah Rek!</h2>
				</section>
				<section class="content">
					<div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Form Pemesanan Darah</h3>
                                    
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                  <div class="box-body">
                                  	<?php echo form_open($action);?>
      								  <?php //echo validation_errors();?>    
                                    
										<div class="form-group">
											 <label> Nama</label>
											  <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?php echo $PesanDarah['nama']?>"disabled/>
										</div>
										<div class="form-group">
											<label> No Telp / HP </label>
											  <input type="text" class="form-control" id="telp" placeholder="No. Telp / HP" name="telp" value="<?php echo $PesanDarah['no.telp']?>"disabled/>
										</div>
										<div class="form-group">
											<label>  Alamat </label>
											  <textarea type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" disabled><?php echo $PesanDarah['alamat']?></textarea>
										</div>
										<div class="form-group">
											<label>	Jumlah*</label>
											  <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Paket per 500 ml" value="<?php echo $PesanDarah['jumlah']?>"/>
										<?php echo form_error('jumlah');?>
										</div>

										<div class="form-group">
											<label>Golongan Darah * </label> 
											<!-- <select name="gol" >
											<option value="A" selected="selected">A</option>
											<option value="B">B</option>
											<option value="AB" >AB</option>
											<option value="O">O</option>
											</select> -->
											<!-- <input type="hidden" value="true" name="fix_radio_required"> -->
											<br/>
											<input type="radio" class"form-control" name="goldar" id="goldar" value="A" <?php echo set_radio('goldar', 'A')?> />
											 A<br/>
											  <input type="radio" class"form-control" name="goldar" id="goldar" value="B"<?php echo set_radio('goldar', 'B')?>/>
											    B<br/>
											  <input type="radio" class"form-control" name="goldar" id="goldar" value="AB"<?php echo set_radio('goldar', 'AB')?>/>
											    AB<br/>
											  <input type="radio" class"form-control" name="goldar" id="goldar" value="O"<?php echo set_radio('goldar', 'O')?> />
											    O<br/>
												<?php echo $PesanDarah['goldar'];?>	
												<?php echo form_error('goldar');?>
										</div>
										<div class="form-group">
										<label>	Status</label>
											<br/>
											<input type="radio" class"form-control" name="status" id="status" value="Lunas" <?php echo set_radio('status', 'Lunas')?>/>
											 Lunas<br/>
											  <input type="radio" class"form-control" name="status" id="status" value="Belum Lunas"<?php echo set_radio('status', 'Belum Lunas')?>/>
											    Belum Lunas<br/>
											   <?php echo $PesanDarah['status'];?>	
												<?php echo form_error('status');?>
										</div> 
										<div class="form-group">
											<label>Total Pembayaran</label>
											<div class="alert alert-info alert-dismissable" id="tagihan">Rp.<?php echo 0;?> 
											</div>
										</div> 
							
                                    </div><!-- /.box-body -->
							<div class="box-footer">
                                        <button type="submit" class="btn bg-red" name="ok">Submit</button>
                                    </div>
                                <?php echo form_close();?>
                            </div><!-- /.box -->
							
	</section>
	<script type="text/javascript">
	
	$('input#jumlah').bind('input', function() { 
    //var MataUang="Rp.";
	var Tagihan=$(this).val()*200000;
	//var TagihanFix=MataUang +Tagihan;
	 $('div#tagihan').html("Rp."+Tagihan);
	
			});
	
	
	</script>
	
	
	    