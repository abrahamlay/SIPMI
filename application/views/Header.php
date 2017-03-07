<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PMI Malang | <?php echo $title?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url();?>style/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url();?>style/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url();?>style/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url();?>style/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url();?>style/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo base_url();?>style/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url();?>style/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url();?>style/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>style/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url();?>style/js/jquery.min.js"></script>
	  
	 <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url();?>style/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>style/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="<?php echo base_url();?>style/js/raphael-min.js"></script>
        <script src="<?php echo base_url();?>style/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url();?>style/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url();?>style/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>style/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?php echo base_url();?>style/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url();?>style/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url();?>style/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url();?>style/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url();?>style/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo base_url();?>style/js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url();?>style/js/AdminLTE/dashboard.js" type="text/javascript"></script>     
        
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url();?>style/js/AdminLTE/demo.js" type="text/javascript"></script>
  
		<script src="<?php echo base_url();?>style/js/sidebar.js"></script>
		<!-- InputMask -->
        <script src="<?php echo base_url();?>style/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>style/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>style/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
       
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body class="skin-black"> 
        <!-- jQuery 2.0.2 -->
                <!--<script src="<?php echo base_url();?>style/js/jquery.min.js"></script>-->
	<?php if (!isset($_SESSION['username'])) {echo "
        <!-- header logo: style can be found in header.less -->
        <header class=\"header\">
            <a href="; echo base_url(); echo " class=\"logo\">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                PMI Malang
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class=\"navbar navbar-static-top \" role=\"navigation\">
				<div class=\"navbar-right\">
				<ul class=\"nav navbar-nav\">
					<!-- search form -->
					<!--
					<li class=\"user user-menu\">
                    <form action=\"#\" method=\"get\" class=\"sidebar-form\">
                        <div class=\"input-group\" >
                            <input width=\"30%\" type=\"text\" name=\"q\" class=\"form-control\" placeholder=\"Search...\"/>
                            <span class=\"input-group-btn\">
                                <button type='submit' name='search' id='search-btn' class=\"btn btn-flat\"><i class=\"fa fa-search\"></i></button>
                            </span>
                        </div>
                    </form>
					</li>
					--> 
					<!-- /.search form -->		
            					
					<li class=\"user user-menu\">
							<a href=\"#\" class=\"user user-menu\" role=\"button\">
							Informasi Aplikasi
							</a>
					</li>
					<li class=\"user user-menu\">
					<a href="; echo base_url()."index.php/User/daftarmember"; echo " class=\"user user-menu\" role=\"button\"><b>Daftar Member</b></a>
					</li>
					<li class=\"dropdown user user-menu\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                  <span>Login<i class=\"caret\"></i></span>
                            </a>
							<ul class=\"dropdown-menu form-box\" id=\"login-box\">
                             
								<div class=\"header bg-red\">Masuk</div>
										<form action="; echo base_url()."index.php/User/authentifikasiUser"; echo " method=\"post\">
											<div class=\"body bg-gray\">
												<div class=\"form-group\">
													<input type=\"text\" name=\"username\" class=\"form-control\" placeholder=\"Username\"/>
												</div>
												<div class=\"form-group\">
													<input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Password\"/>
												</div>          
												<div class=\"form-group\">
													<input type=\"checkbox\" name=\"remember_me\"/> Ingat Saya
												</div>
											</div>
											<div class=\"footer\">                                                               
												<button type=\"submit\" class=\"btn bg-red btn-block\" name='login'>Masuk</button>  
												
												<p><a href=\"#\">Lupa Sandi</a></p>
												
												<a href="; echo base_url()."index.php/User/register"; echo " class=\"text-center\">Daftar Member</a>
											</div>
										</form>
									
							</ul>	
                        </li>
				</ul>
		
					
				
        		</div>
				<ul class=\"nav navbar-nav\">
				
					
                </ul>    
					
					
					</nav>
					"; }
					else {
						echo "
						
						 <!-- header logo: style can be found in header.less -->
        <header class=\"header\">
            <a href="; echo base_url(); echo " class=\"logo\">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                PMI Malang
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class=\"navbar navbar-static-top\" role=\"navigation\">
                <!-- Sidebar toggle button-->
                <a href=\"#\" class=\"navbar-btn sidebar-toggle\" data-toggle=\"offcanvas\" role=\"button\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </a>
				
				
                <div class=\"navbar-right\">
                    <ul class=\"nav navbar-nav\">
						
				        			
						<!-- User Account: style can be found in dropdown.less -->
                        <li class=\"dropdown user user-menu\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                <i class=\"glyphicon glyphicon-user\"></i>
                                <span>".$profil->nama." <i class=\"caret\"></i></span>
                            </a>
                            <ul class=\"dropdown-menu\">
                                <!-- User image -->
                                <li class=\"user-header bg-red\">
                                    <img src=\"".base_url()."style/img/avatar3.png\" class=\"img-circle\" alt=\"User Image\" />
                                    <p>
                                        ".$profil->nama."
                                        <small>".$title."</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class=\"user-footer\">
                                    <div class=\"pull-left\">
                                        <a href=\"#\" class=\"btn btn-default btn-flat\">Profile</a>
                                    </div>
                                    <div class=\"pull-right\">
                                        <a href="; echo base_url().'/index.php/'.$_SESSION['level'].'/logout'; echo " class=\"btn btn-default btn-flat\">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
						"; }?>  
                      
                       
                    </ul>
                </div>
            </nav>
        </header>
		<body>
		
		