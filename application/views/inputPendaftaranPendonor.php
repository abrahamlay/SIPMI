<aside class="right-side">
<!-- jQuery 2.0.2 -->
      <!--<script src="<?php echo base_url();?>style/js/jquery.min.js"></script>-->
                <!-- Content Header (Page header) -->
				 <section class="content-header">
                   <!-- <img src="style/img/logo_pmi.png"> -->
					<h2 class="page-header">Ayo Donor Darah Rek!</h2>
					<div class="alert alert-info alert-dismissable" > 
						<div class="form-group">
						<h4>Bersedia menyumbangkan darah secara sukarela kepada PMI Cabang Kota Malang</h4> 
						<?php echo $tanggal_sekarang;
						 							?>


						</div>
					</div>
				</section>
				<section class="content"> 
					<?php //echo validation_errors();?>    
				<div class="row">
					<div class="col-md-12">
						<form method="post" action =<?php echo $action;?>>
						<?php //echo form_open($action);?>
                            <!-- general form elements -->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Form Pendaftaran Donor Darah</h3>
                                   
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                  <div class="box-body">
                                  	
      								 
                                    <div class="form-group">
											  <label>Nama</label>
											  <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?php echo $DaftarDonor['nama']?>"disabled/>
										</div>
										<div class="form-group">
											 <label>No Telp / HP</label> 
											  <input type="text" class="form-control" id="telp" placeholder="No. Telp / HP" name="telp" value="<?php echo $DaftarDonor['no.telp']?>"disabled/>
										</div>
										<div class="form-group">
											  <label>Alamat</label> 
											  <textarea type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" disabled><?php echo $DaftarDonor['alamat']?></textarea>
										</div>

										<div class="form-group">
											 <label>Berat Badan</label> 
											  <input type="number" class="form-control" id="beratbadan" placeholder="...Kg" name="beratbadan" value="<?php echo $DaftarDonor['beratbadan']?>"/>
										
										</div>
											<?php echo form_error('beratbadan');?>
										<div class="form-group">
											<label>Status</label>
											<br/>
											<input type="radio" class"form-control" name="status" id="status" value="Sudah Donor" <?php echo set_radio('status', 'Sudah Donor')?>/>
											 Sudah Donor<br/>
											  <input type="radio" class"form-control" name="status" id="status" value="Belum Donor"<?php echo set_radio('status', 'Belum Donor')?>/>
											    Belum Donor<br/>
											   <?php echo $DaftarDonor['status'];?>	
												<?php echo form_error('status');?>
										</div> 
														
                                  	<div class="form-group">
                                  		<?php echo $DaftarDonor['Tanggal_daftar'];?>	

											<label>Apakah Saudara :</label>
											<table border="0">
											<tr> <th colspan="5" align="left"> <label for="01">01. Sehat pada saat ini</label> </th>
													<td><input type="radio" class"form-control" name="form01" id="form01"  value="1"<?php echo set_radio('form01', '1'); if ($DaftarDonor['form01']=1) {echo "checked";} ?>/>Ya
									                    <input type="radio" class"form-control" name="form01" id="form01" value="2"<?php echo set_radio('form01', '2'); if ($DaftarDonor['form01']=2) {echo "checked";}?>/>Tidak 
									                    </td><td><?php  echo $DaftarDonor['form01']; echo form_error('form01');?></td>
									        </tr>
											<tr> <th colspan="5" align="left"> <label>02. Dalam 3 Bulan Terakhir menjalani Pengobatan/ Sakit Berat /Operasi</label> </th>
												<td><input type="radio" class"form-control" name="form02" id="form02" value="1" <?php echo set_radio('form02', '1'); if ($DaftarDonor['form02']=1) {echo "checked";}?>/>Ya
									                 <input type="radio" class"form-control" name="form02" id="form02" value="2"<?php echo set_radio('form02', '2'); if ($DaftarDonor['form02']=2) {echo "checked";}?>/>Tidak
									                 </td><td><?php echo form_error('form02');?></td>
									        </tr>
											<tr> <th><label>03. Pernah sakit :</label></th>	
											<tr> <td></td><td colspan="4" align="left"> a. Diabetes / Kencing Manis </td>
												<td>
													<input type="radio" class"form-control" name="form3a" id="form3a" value="1"<?php echo set_radio('form3a', '1'); if ($DaftarDonor['form3a']=1) {echo "checked";}?>/>Ya
									                <input type="radio" class"form-control" name="form3a" id="form3a" value="2"<?php echo set_radio('form3a', '2'); if ($DaftarDonor['form3a']=2) {echo "checked";}?>/>Tidak
									                </td><td><?php echo form_error('form3a');?></td>
									            </tr>
											<tr> <td></td><td colspan="4" align="left"> b. Ginjal, Jantung, TBC, Alergi, Asma </td>
												<td><input type="radio" class"form-control" name="form3b" id="form3b" value="1"<?php echo set_radio('form3b', '1');if ($DaftarDonor['form3b']=1) {echo "checked";}?>/>Ya
									                <input type="radio" class"form-control" name="form3b" id="form3b" value="2"<?php echo set_radio('form3b', '2');if ($DaftarDonor['form3b']=2) {echo "checked";}?>/>Tidak
									                </td><td><?php echo form_error('form3b');?></td>
									            </tr>
											<tr> <td></td><td colspan="4" align="left"> c. Radang Lambung / Maag </td>
												<td><input type="radio" class"form-control" name="form3c" id="form3c" value="1"<?php echo set_radio('form3c', '1');if ($DaftarDonor['form3c']=1) {echo "checked";}?>/>Ya
									            	<input type="radio" class"form-control" name="form3c" id="form3c" value="2"<?php echo set_radio('form3c', '2');if ($DaftarDonor['form3c']=2) {echo "checked";}?>/>Tidak
									            	</td><td><?php echo form_error('form3c');?></td>
									            </tr>							
											<tr> <td></td><td colspan="4" align="left"> d. Gangguan darah / Hemofilia </td>
												<td><input type="radio" class"form-control" name="form3d" id="form3d" value="1"<?php echo set_radio('form3d', '1');if ($DaftarDonor['form3d']=1) {echo "checked";}?>/>Ya
									                <input type="radio" class"form-control" name="form3d" id="form3d" value="2"<?php echo set_radio('form3d', '2');if ($DaftarDonor['form3d']=2) {echo "checked";}?>/>Tidak
									                </td><td><?php echo form_error('form3d');?></td>
									            </tr>
											<tr> <td></td><td colspan="4" align="left"> e. Syphillis / Penakit Kelamin </td>
												<td><input type="radio" class"form-control" name="form3e" id="form3e" value="1"<?php echo set_radio('form3e', '1');if ($DaftarDonor['form3e']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form3e" id="form3e" value="2"<?php echo set_radio('form3e', '2');if ($DaftarDonor['form3e']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form3e');?></td>
						                        </tr>							
											<tr> <th colspan="5" align="left"> 04. Sering Pingsan / Kejang Kejang </th>
												<td><input type="radio" class"form-control" name="form04" id="form04" value="1"<?php echo set_radio('form04', '1');if ($DaftarDonor['form04']=1) {echo "checked";}?>/>Ya
								                    <input type="radio" class"form-control" name="form04" id="form04" value="2"<?php echo set_radio('form04', '2');if ($DaftarDonor['form04']=2) {echo "checked";}?>/>Tidak
								                    </td><td><?php echo form_error('form04');?></td>
					                        </tr>
											<tr> <th colspan="5" align="left"> 05. Pernah merasakan tanda-tanda menderita HIV dengan gejala : </th></tr>
											<tr><td></td> <td colspan="4" align="left"> a. Berat badan menurun lebih dari 10% dari berat normal </td>
												<td><input type="radio" class"form-control" name="form5a" id="form5a" value="1"<?php echo set_radio('form5a', '1');if ($DaftarDonor['form5a']=1) {echo "checked";}?>/>Ya
									                <input type="radio" class"form-control" name="form5a" id="form5a" value="2"<?php echo set_radio('form5a', '2');if ($DaftarDonor['form5a']=2) {echo "checked";}?>/>Tidak
									                </td><td><?php echo form_error('form5a');?></td>
									        </tr>
											<tr> <td></td><td colspan="4" align="left"> b. Demam berkepanjangan </td>
												<td><input type="radio" class"form-control" name="form5b" id="form5b" value="1"<?php echo set_radio('form5b', '1');if ($DaftarDonor['form5b']=1) {echo "checked";}?>/>Ya
									                <input type="radio" class"form-control" name="form5b" id="form5b" value="2"<?php echo set_radio('form5b', '2');if ($DaftarDonor['form5b']=2) {echo "checked";}?>/>Tidak
									                </td><td><?php echo form_error('form5b');?></td>
									        </tr>
											<tr> <td></td><td colspan="4" align="left"> c. Terjadi pembesaran kelenjar getah bening </td>
												<td><input type="radio" class"form-control" name="form5c" id="form5c" value="1"<?php echo set_radio('form5c', '1');if ($DaftarDonor['form5c']=1) {echo "checked";}?>/>Ya
									                <input type="radio" class"form-control" name="form5c" id="form5c" value="2"<?php echo set_radio('form5c', '1');if ($DaftarDonor['form5c']=2) {echo "checked";}?>/>Tidak
									                </td><td><?php echo form_error('form5c');?></td>
									        </tr>
											<tr> <td></td><td colspan="4" align="left"> d. Berkeringat pada malam hari </td>
												<td><input type="radio" class"form-control" name="form5d" id="form5d" value="1"<?php echo set_radio('form5d', '1');if ($DaftarDonor['form5d']=1) {echo "checked";}?>/>Ya
					                            	<input type="radio" class"form-control" name="form5d" id="form5d" value="2"<?php echo set_radio('form5d', '2');if ($DaftarDonor['form5d']=2) {echo "checked";}?>/>Tidak
					                            	</td><td><?php echo form_error('form5d');?></td>
					                        </tr>
											<tr> <td></td><td colspan="4" align="left"> e. Diare yang berkepanjangan </td>
												<td><input type="radio" class"form-control" name="form5e" id="form5e" value="1"<?php echo set_radio('form5e', '1');if ($DaftarDonor['form5e']=1) {echo "checked";}?>/>Ya
					                          		<input type="radio" class"form-control" name="form5e" id="form5e" value="2"<?php echo set_radio('form5e', '2');if ($DaftarDonor['form5e']=2) {echo "checked";}?>/>Tidak
					                          		</td><td><?php echo form_error('form5e');?></td>
					                        </tr>
											<tr> <td></td><td colspan="4" align="left"> f. Lesi di kulit dengan warna biru keunguan </td>
												<td><input type="radio" class"form-control" name="form5f" id="form5f" value="1"<?php echo set_radio('form5f', '1');if ($DaftarDonor['form5f']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form5f" id="form5f" value="2"<?php echo set_radio('form5f', '2');if ($DaftarDonor['form5f']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form5f');?></td>
					                        </tr>
											<tr> <th colspan="5" align="left"> 06. pernah merasakan tanda tanda menderita malaria dengan gejala / sebab : </th></tr>
											<tr> <td></td><td colspan="4" align="left"> a. Demam periodik disertai mengigil </td>
												<td><input type="radio" class"form-control" name="form6a" id="form6a" value="1"<?php echo set_radio('form6a', '1');if ($DaftarDonor['form6a']=1) {echo "checked";}?>/>Ya
					                          		<input type="radio" class"form-control" name="form6a" id="form6a" value="2"<?php echo set_radio('form6a', '2');if ($DaftarDonor['form6a']=2) {echo "checked";}?>/>Tidak
					                          		</td><td><?php echo form_error('form6a');?></td>
					                        </tr>		
											<tr> <td></td><td colspan="4" align="left"> b. Berpergian kedaerah endemik 6 bulan yang lalu </td>
												<td><input type="radio" class"form-control" name="form6b" id="form6b" value="1"<?php echo set_radio('form6b', '1');if ($DaftarDonor['form6b']=1) {echo "checked";}?>/>Ya
							                       	<input type="radio" class"form-control" name="form6b" id="form6b" value="2"<?php echo set_radio('form6b', '2');if ($DaftarDonor['form6b']=2) {echo "checked";}?>/>Tidak
							                       	</td><td><?php echo form_error('form6b');?></td>
					                        </tr>
											<tr> <th colspan="5" align="left"> 07. Pernah Merasakan tanda tanda menderita Hepatitis dengan gejala / sebab :</th></tr>
											<tr> <td></td><td colspan="4" align="left"> a. kuning sekujur tubuh </td>
												<td><input type="radio" class"form-control" name="form7a" id="form7a" value="1"<?php echo set_radio('form7a', '1');if ($DaftarDonor['form7a']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form7a" id="form7a" value="2"<?php echo set_radio('form7a', '2');if ($DaftarDonor['form7a']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form7a');?></td>
					                        </tr>
											<tr> <td></td><td colspan="4" align="left"> b. Sakit perut sebelah kanan atas </td>
												<td><input type="radio" class"form-control" name="form7b" id="form7b" value="1"<?php echo set_radio('form7b', '1');if ($DaftarDonor['form7b']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form7b" id="form7b" value="2"<?php echo set_radio('form7b', '2');if ($DaftarDonor['form7b']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form7b');?></td>
					                        </tr>
											<tr> <td></td><td colspan="4" align="left"> c. Demam, nafsu makan berkurang </td>
												<td><input type="radio" class"form-control" name="form7c" id="form7c" value="1"<?php echo set_radio('form7c', '1');if ($DaftarDonor['form7c']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form7c" id="form7c" value="2"<?php echo set_radio('form7c', '2');if ($DaftarDonor['form7c']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form7c');?></td>
					                        </tr>
											<tr> <td></td><td colspan="4" align="left"> d. Mual-mual / muntah </td>
												<td><input type="radio" class"form-control" name="form7d" id="form7d" value="1"<?php echo set_radio('form7d', '1');if ($DaftarDonor['form7c']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form7d" id="form7d" value="2"<?php echo set_radio('form7d', '2');if ($DaftarDonor['form7c']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form7d');?></td>
					                        </tr>
											<tr> <th colspan="5" align="left"> 08. Pernah keluar negeri 6 bulan terakhir </th>
												<td><input type="radio" class"form-control" name="form08" id="form08" value="1"<?php echo set_radio('form08', '1');if ($DaftarDonor['form08']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form08" id="form08" value="2"<?php echo set_radio('form08', '2');if ($DaftarDonor['form08']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form08');?></td>
					                        </tr>
											<tr> <th colspan="5" align="left"> 09. Menyumbangkan darah dengan identitas lain </th>
												<td><input type="radio" class"form-control" name="form09" id="form09" value="1"<?php echo set_radio('form09', '1');if ($DaftarDonor['form09']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form09" id="form09" value="2"<?php echo set_radio('form09', '2');if ($DaftarDonor['form09']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form09');?></td>
					                        </tr>
											<tr> <th colspan="5" align="left"> 10. Meyumbangkan darah kurang dari 3 bulan lalu </th>
												<td><input type="radio" class"form-control" name="form10" id="form10" value="1"<?php echo set_radio('form10', '1');if ($DaftarDonor['form10']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form10" id="form10" value="2"<?php echo set_radio('form10', '2');if ($DaftarDonor['form10']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form10');?></td>
					                        </tr>
											<tr> <th colspan="5" align="left"> 11. Bagi wanita hamil/ menyusui  </th>
												<td><input type="radio" class"form-control" name="form11" id="form11" value="1"<?php echo set_radio('form11', '1');if ($DaftarDonor['form11']=1) {echo "checked";}?>/>Ya
						                            <input type="radio" class"form-control" name="form11" id="form11" value="2"<?php echo set_radio('form11', '2');if ($DaftarDonor['form11']=2) {echo "checked";}?>/>Tidak
						                            </td><td><?php echo form_error('form11');?></td>
					                        </tr>
											
											</table>
										</div>
                                  </div>
	                          <div class="box-footer">
	                                <button type="submit" class="btn bg-red" name="ok">Submit</button>
	                            </div>
	                            </form>
	                        </div>
	                    </div>
                                <?php// echo form_close();?>
					</div>	
	</section>
	
	
	
	    