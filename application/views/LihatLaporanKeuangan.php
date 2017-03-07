<aside class="right-side">

            <!-- Right side column. Contains the navbar and content of the page              
			<aside class="right-side">-->

                <!-- Content Header (Page header) -->
				 <section class="content">
                   <!-- <img src="style/img/logo_pmi.png"> -->
					<h2 class="page-header">Ayo Donor Darah Rek!</h2>
				</section>

               	<section class="content">
					<div class="row">
					<div class="col-md-12">
						<div class="box box-danger" >
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Laporan Keuangan</h3>
                                </div>
								 <div class="box-body">
                                    <div id="bar-chart" style="height: 300px;"></div>
                                    </div><!-- /.box-body-->
                            </div><!-- /.box -->
						</div><!--col-->
					</div><!--row-->
				</section>
				
		
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
                    data: [["Januari", <?php echo $JumlahKeuangan['januari']->total;?>], ["Februari", 0], ["Maret", 0], ["April", 0], ["Mei", 0], ["Juni", 0], ["Juli", 0], ["Agustus", 0], ["September", 0], ["Oktober", 0], ["November", 0], ["Desember", 0]],
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
            </aside>
        <!-- </aside>	add new calendar event modal -->