
            <!-- Right side column. Contains the navbar and content of the page              
			<aside class="right-side">-->

                <!-- Content Header (Page header) -->
				 <section class="content">
                   <!-- <img src="style/img/logo_pmi.png"> -->
					<h2 class="page-header">Ayo Donor Darah Rek!</h2>
				</section>

               	<section class="content">
					<div class="row">
					<div class="col-md-8">
						<div class="box box-danger" >
                                <div class="box-header">
                                 
                                    <h3 class="box-title">PMI Malang</h3>

                                </div>
								
								<!-- /.box-header -->
                                <div class="box-body">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <img src="<?php echo base_url();?>style/img/gbr1.png" alt="First slide">
                                            </div>
                                            <div class="item">
                                                <img src="<?php echo base_url();?>style/img/gbr2.png" alt="Second slide">
                                            </div>
                                            <div class="item">
                                                <img src="<?php echo base_url();?>style/img/gbr3.png" alt="Third slide">
                                                
                                            </div>
                                        </div>
                                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                                    </div>
									
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
						</div><!--col-->
						<div class="col-md-4">
						<div class="box box-danger" >
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Jumlah Darah</h3>
                                </div>
								 <div class="box-body">
                                    <div id="bar-chart" style="height: 300px;"></div>
                                </div><!-- /.box-body-->
                            </div><!-- /.box -->
						</div><!--col-->
					</div><!--row-->
				</section>
				
		<!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url();?>style/js/jquery.min.js"></script>
        <!-- FLOT CHARTS -->
        <script src="<?php echo base_url();?>style/js/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="<?php echo base_url();?>style/js/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="<?php echo base_url();?>style/js/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="<?php echo base_url();?>style/js/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>

			<script type="text/javascript">   /*
                 * BAR CHART
                 * ---------
                 */

                var bar_data = {
                    data: [["A", 10000], ["B", 8000], ["O", 4000], ["AB", 13000]],
                    color: "#F54747"
                };
                $.plot("#bar-chart", [bar_data], {
                    grid: {
                        borderWidth: 1,
                        borderColor: "#DF0101",
                        tickColor: "#DF0101"
                    },
                    series: {
                        bars: {
                            show: true,
                            barWidth: 0.5,
                            align: "center"
                        }
                    },
                    xaxis: {
                        mode: "categories",
                        tickLength: 0
                    }
                });
                /* END BAR CHART */
			</script>

        <!-- </aside>	add new calendar event modal -->