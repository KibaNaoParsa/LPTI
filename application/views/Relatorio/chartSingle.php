        <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Criação de Relatórios</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		        	<div class="col-lg-12 col-md-12" id="btn">
									<?php

									echo '<script>
												window.onload = function () {
	
												var chart = new CanvasJS.Chart("chartContainer", {
													animationEnabled: true,
	
													title:{
														text:"Relatório de mamada"
													},
													axisX:{
														interval: 1
													},
													axisY2:{
														interlacedColor: "rgba(1,77,101,.2)",
														gridColor: "rgba(1,77,101,.1)",
														title: "Número de mamadas"
													},
													
													data: [{
														type: "bar",
														name: "companies",
														axisYType: "secondary",
														color: "#014D65",
														dataPoints: [
															{ y: 1, label: "Agnaldo" },
															{ y: 2, label: "Waguin" },
															{ y: 5, label: "Anacio" }
														]
													}]
											});
											chart.render();

											}
										</script>';
				echo '<div id="chartContainer" style="height: 370px; width: 100%;"></div>';

									?>
					</div>
				</div>
          </div>
				</div>
			</div>

		
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <!-- jQuery -->
    <script src="{url}assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{url}assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{url}assets/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{url}assets/js/raphael.min.js"></script>
    <script src="{url}assets/js/morris.min.js"></script>
    <script src="{url}assets/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{url}assets/js/sb-admin-2.js"></script>

		<script>
			{modal}
		</script>

</body>

</html>



