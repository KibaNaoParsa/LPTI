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
    <link href="{url}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{url}assets/css/metisMenu.min.css" rel="stylesheet">
    <link href="{url}assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="{url}assets/css/morris.css" rel="stylesheet">
    <link href="{url}assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	 <link href="{url}assets/css/estilo.css" rel="stylesheet" type="text/css">
	 <style type="text/css" class="init">
	
		div.dataTables_wrapper {
			width: 800px;
			margin: 0 auto;
		}

	 </style>
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="{url}assets/DataTables/media/js/jquery.dataTables.js">
	</script>
	<script type="text/javascript" language="javascript" src="{url}assets/DataTables/examples/resources/syntax/shCore.js">
	</script>
	<script type="text/javascript" language="javascript" src="{url}assets/DataTables/examples/resources/demo.js">
	</script>
	<script type="text/javascript" language="javascript" class="init">
	
		$(document).ready(function() {
			$('#example').DataTable( {
				"scrollX": true
			} );
		} );

	</script>

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
									<?php												
													
										echo '<table id="example" class="display nowrap" cellspacing="0" width="100%">
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
										
		
									?>
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


