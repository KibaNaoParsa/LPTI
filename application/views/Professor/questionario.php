  		        	<style>
h1{
  font-size: 30px;
  color: #000;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #000;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #000;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:hover{background-color:#f5f5f5;}
	#check {text-align: center;}
	#aluno {text-align: left;}


::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}

</style>
 
 
 <script type="text/javascript">
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize(); 
 </script>
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
								$atributos = array('name'=>'formulario_cadastro', 'id'=>'formulario_cadastro');
								$btn = array('name'=>'btn_cadastrar', 'id'=>'botao1', 'class'=>'btn btn-lg btn-success');
												
								echo form_open('Professor/resposta', $atributos).
									  form_hidden('idUSUARIO', $idUSUARIO).
									  form_hidden('idTURMA', $idTURMA).
									  form_hidden('idMATERIA', $idMATERIA).
									  form_hidden('idQUESTIONARIO', $idQUESTIONARIO);
									  
								foreach ($ALUNOS as $a) {
									echo form_hidden('idTURMA_ALUNO[]', $a->idALUNO);
								}							
							


 echo ' <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0" style="overflow-x:auto">
      <thead>
        <tr>
          <th></th>';
      						foreach ($PERGUNTA_FECHADA as $pf) {
										echo '<th>'.$pf->PERGUNTA.'</th>';
								}
								echo '</tr>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>';
								foreach($ALUNOS as $a) {
									echo '<tr>';
									echo '<td id="aluno">'.$a->NOME.'</td>';
									foreach ($PERGUNTA_FECHADA as $pf) {
										echo '<td id="check">'. form_checkbox("".$a->idALUNO."[]", $a->idALUNO.";".$pf->idPERGUNTA.";1", FALSE) .'</td>';									
									}
									echo '</tr>';
								}
      echo '</tbody>
    </table>
  </div>';
  
  								echo br().br();
								
								foreach($PERGUNTA_ABERTA as $pa) {
									echo form_hidden('idPERGUNTA[]', $pa->idPERGUNTA).
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


