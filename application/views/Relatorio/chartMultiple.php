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

									$i = 0;
									echo '<script>
												window.onload = function () {
	
												var chart = new CanvasJS.Chart("chartContainer", {
													animationEnabled: true,
													exportEnabled: true,
														
													title:{
														text:"Relatório de ocorrências por turma"
													},
													axisX:{
														interval: 1
													},
													axisY2:{
														interlacedColor: "rgba(1,77,101,.2)",
														gridColor: "rgba(1,77,101,.1)",
													},
													
													data: [{
														type: "bar",
														name: "companies",
														axisYType: "secondary",
														color: "#014D65",
														dataPoints: [
														';
														
									foreach ($RESPOSTA['NOME'] as $r) {
										echo	'{ y: '.$RESPOSTA['TOTAL'][$i].', label: "'.$r.'" },';
										$i++;
									}
									echo '			]
													}]
											});
											chart.render();

											}
										</script>';
				echo '<div id="chartContainer" style="height: 370px; width: 100%;"></div>';
			
				


									?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
