
            <!-- Right side column. Contains the navbar and content of the page             <aside class="right-side"> -->

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h2 class="page-header">Ayo Donor Darah Rek!</h2>

                    
                </section>
				<?php
						 //echo validation_errors();
                              
						 
					/* 	if($register){
							echo '<div id="msg_div">'.$register.'</div>';
						} */
						?>
								
                                        
				<section class="bg-grey">

						<div class="form-box" id="login-box">
							<div class="header bg-red">Daftar Member</div>
							<form action="<?php echo base_url();echo $action;?>" method="post">
								<div class="body bg-gray">
									<div class="form-group">
										<input type="text" name="name" class="form-control" placeholder="Nama Lengkap"><?php echo (isset($member['name']))?$member['name']:''; ?></input>
										<?php echo form_error('name'); ?>
									</div>
									<div class="form-group">
											<input type="text"  name="telp" class="form-control" id="telp" placeholder="No. Telp / HP" value=""/>
										</div>
									<div class="form-group">
											<textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat"  ></textarea>
										</div>
									<div class="form-group">
										<input type="text" name="username" class="form-control" placeholder="Username"><?php echo (isset($member['username']))?$member['username']:''; ?></input>
										<?php echo form_error('username'); ?>
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control" placeholder="Password"><?php echo (isset($member['password']))?$member['password']:''; ?></input>
										<?php echo form_error('password'); ?>
									</div>
									<div class="form-group">
										<input type="password" name="password2" class="form-control" placeholder="Ulangi password "><?php echo (isset($member['password2']))?$member['password2']:''; ?></input>
										<?php echo form_error('password2'); ?>
									</div>
									<div class="form-group">
										<input type="text" name="email" class="form-control" placeholder="Email@mail.com"></input>
										<?php echo form_error('email'); ?>
									</div>
									<div class="form-group">
											<label>Golongan Darah </label> 
											<br/>
											<input type="radio" class"form-control" name="goldar" id="goldar" value="A" <?php echo set_radio('goldar', 'A')?> />
											 A<br/>
											  <input type="radio" class"form-control" name="goldar" id="goldar" value="B"<?php echo set_radio('goldar', 'B')?>/>
											    B<br/>
											  <input type="radio" class"form-control" name="goldar" id="goldar" value="AB"<?php echo set_radio('goldar', 'AB')?>/>
											    AB<br/>
											  <input type="radio" class"form-control" name="goldar" id="goldar" value="O"<?php echo set_radio('goldar', 'O')?> />
											    O<br/>
												
												<?php echo form_error('goldar');?>
										</div>
								</div>
								<div class="footer ">                    

									<button type="submit" name="reg" class="btn bg-red btn-block">Sign me up</button>

									<a href="<?php echo base_url();?>" class="text-center">I already have a membership</a>
								</div>
							</form>

							<!--<div class="margin text-center">
								<span>Register using social networks</span>
								<br/>
								<button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
								<button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
								<button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

							</div>-->
						</div>
					</section>

        <!-- add new calendar event modal -->