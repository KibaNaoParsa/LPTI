<!DOCTYPE html>
<html lang="en">

<head>

    <title>Editar Usuário</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="elyas" >

    <title>Início</title>

	 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link href="{url}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{url}assets/css/metisMenu.min.css" rel="stylesheet">
    <link href="{url}assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="{url}assets/css/morris.css" rel="stylesheet">
    <link href="{url}assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	 <link href="{url}assets/css/estilo.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">
			<div id="MainProf">
          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Questionários</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		        	<div class="col-lg-12 col-md-12" id="btn">
						<div class="w3-responsive">
							<?php												
									
								$atributos = array('name'=>'formulario_cadastro', 'id'=>'formulario_cadastro');
								$btn = array('name'=>'btn_cadastrar', 'id'=>'botao1', 'class'=>'btn btn-lg btn-success');
												
								echo form_open('Professor/resposta', $atributos).
									  form_hidden('idUSUARIO', $idUSUARIO);												
												
								echo '<table class="w3-table-all">
											<thead>
												<tr>
													<th></th>';
	
								foreach ($PERGUNTA_FECHADA as $pf) {
										echo '<th>'.$pf->PERGUNTA.'</th>';
									}
												
								echo '</tr>
									</thead>
									<tbody>';
								
								foreach($ALUNOS as $a) {
									echo '<tr>';
									echo '<td>'.$a->NOME.'</td>';
									echo '</tr>';
								}
									
										
								echo	'</tbody>
								</table>';
										
								echo br().br();
								
								foreach($PERGUNTA_ABERTA as $pa) {
									echo form_hidden('idPERGUNTA', $pa->idPERGUNTA).
										  '<h2>'.form_label($pa->PERGUNTA, "txt_perguntaaberta").'</h2>'.br().
										  form_textarea('txt_respostaaberta[]').br().br();																	
								}
								
								
								echo form_submit('btn_cadastrar', 'Enviar', $btn).
								form_close();
								
								
		
							?>
					</div>
				</div>
          </div>
          </div>
				</div>
			</div>


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

