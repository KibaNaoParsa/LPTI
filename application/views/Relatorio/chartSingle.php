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
														title: "Dimensão: '.$NOME[0]->DESCRICAO.'"
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

$j = 0;
echo '
<div class="container">';
	
  foreach ($PERGUNTA_ABERTA as $p) {
	echo '	
	  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#'.$p->idPERGUNTA.'">'.$p->PERGUNTA.'</button>


  		<div class="modal fade" id="'.$p->idPERGUNTA.'" role="dialog">
    		<div class="modal-dialog">
    
   		<!-- Modal content-->
      		<div class="modal-content">
        		<div class="modal-header">
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
          				<h4 class="modal-title">'.$p->PERGUNTA.'</h4>
        		</div>
        		<div class="modal-body">
          			<p>';
				foreach ($RESPOSTA_ABERTA[$j] as $r) {
								
					echo '<h4><b>'.$r->LOGIN.': </b></h4>'.
						$r->RESPOSTA_ABERTA.br();		
				     }	
				     $j++;
				echo '</p>
        		</div>
        		<div class="modal-footer">
          			<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        		</div>
      		</div>
      
    		</div>
  	</div>';
	echo br();

  }
  echo '
</div>';

									?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
