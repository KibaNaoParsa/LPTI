          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Edição de Questionários</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		        	<div class="col-lg-12 col-md-12" id="btn">
									<?php
									
									   $atributos = array('name'=>'formulario_cadastro', 'id'=>'formulario_cadastro');

										echo "<b><i>Selecione a turma: </i></b>".br().br();									
									
									
										echo form_open('Relatorio/chart', $atributos).
												form_hidden('idQUESTIONARIO', $idQUESTIONARIO);
												
										foreach ($TURMA as $t) {
											echo form_radio("turma[]", $t->TURMA_idTURMA, FALSE).
												  form_label($t->SERIE."º ".$t->NOME." ".$t->MODALIDADE, "txt_li").br();
										}
									
										echo br()."<b><i>Selecione o tipo de relatório: </i></b>".br().br();									
					
										echo form_radio("relatorio[]", 0, FALSE).
											  form_label("Relatório por dimensão", "txt_li2").br();
					

										echo br().form_submit("btn_cadastrar", " Confirmar ", 'class = "btn btn-success"').br().
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



