									<?php

									$i = 0;
									echo '<script>
												window.onload = function () {
	
												var chart = new CanvasJS.Chart("chartContainer", {
													animationEnabled: true,
													exportEnabled: true,
														
													title:{
														text:"Relatório de ocorrências por dimensão"
													},
													axisX:{
														interval: 1
													},
													axisY2:{
														interlacedColor: "rgba(1,77,101,.2)",
														gridColor: "rgba(1,77,101,.1)",
														title: "Dimensão: '.$DIMENSAO[0]->DESCRICAO.'"
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
			
				
				echo br();
				foreach ($RESPOSTA_ABERTA as $r) {
					echo '<h3><b>'.$r->PERGUNTA.' </b></h3>
								<h4><b>'.$r->LOGIN.': </b></h4>'.
									$r->RESPOSTA_ABERTA.br();				
				}
									?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
