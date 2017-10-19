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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>