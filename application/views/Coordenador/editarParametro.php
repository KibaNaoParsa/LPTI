          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Editar Parâmetro</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
					<div class="col-lg-6">
						<?php
													$atributos = array('name'=>'formulario_cadastro', 'id'=>'formulario_cadastro');
													$btn = array('name'=>'btn_cadastrar', 'id'=>'btn_cadastro', 'class'=>'btn btn-primary');
													if($PARAMETRO[0]->idTURMA == 11)
														$turma = '1º Informática integrado';
													else if($PARAMETRO[0]->idTURMA == 12)
														$turma = '2º Informática integrado';
													else if($PARAMETRO[0]->idTURMA == 13)
														$turma = '3º Informática integrado';
													else if($PARAMETRO[0]->idTURMA == 21)
														$turma = '1º Mecatrônica integrado';
													else if($PARAMETRO[0]->idTURMA == 22)
														$turma = '2º Mecatrônica integrado';
													else if($PARAMETRO[0]->idTURMA == 23)
														$turma = '3º Mecatrônica integrado';
													else if($PARAMETRO[0]->idTURMA == 31)
														$turma = '1º Edificações integrado';
													else if($PARAMETRO[0]->idTURMA == 32)
														$turma = '2º Edificações integrado';
													else if($PARAMETRO[0]->idTURMA == 33)
														$turma = '3º Edificações integrado';
													else if($PARAMETRO[0]->idTURMA == 41)
														$turma = '1º Informática subsequente';
													else if($PARAMETRO[0]->idTURMA == 42)
														$turma = '2º Informática subsequente';
													else if($PARAMETRO[0]->idTURMA == 51)
														$turma = '1º Mecatrônica subsequente';
													else if($PARAMETRO[0]->idTURMA == 52)
														$turma = '2º Mecatrônica subsequente';
													else if($PARAMETRO[0]->idTURMA == 61)
														$turma = '1º Edificações subsequente';
													else if($PARAMETRO[0]->idTURMA == 62)
														$turma = '2º Edificações subsequente';
													echo  		form_open('coord/editaParametro', $atributos).
																$turma.br().
																form_hidden("txt_id", $PARAMETRO[0]->idPARAMETRO_DE_RISCO).
																form_label("Nota: ", "txt_nota").br().
																form_input('txt_nota', $PARAMETRO[0]->NOTA).br().
																form_label("Frequência: ", "txt_freq").br().
																form_input('txt_freq', $PARAMETRO[0]->FREQUENCIA).br().
																form_label("Matérias: ", "txt_materias").br().
																form_input('txt_materias', $PARAMETRO[0]->MATERIAS).br().br();
																echo form_submit("btn_cadastrar", "Editar", $btn).
																form_close();
																$btn = array('name'=>'btn_cadastrar', 'id'=>'btn_cadastro', 'class'=>'btn btn-danger');
																echo anchor(base_url('coord/parametros'), 'Cancelar', $btn);
												?>
					</div>
              </div>
          </div>
		</div>
	</div>
	<script src="{url}assets/js/jquery.min.js"></script>
	    <script src="{url}assets/DataTables/media/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
      $(document).ready(function(e){
        $("#btn a").click(function(e){
          e.preventDefault();
          var href = $(this).attr('href');
          $("#Main").load(href + " #Main", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
            $('#myTable').DataTable({
                "bRetrieve": true,
                "bPaginate": true,
                "bJQueryUI": false,
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "sUrl": "{url}assets/language/ptbr.txt"
                }
            });
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
        });
      });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{url}assets/js/bootstrap.min.js"></script>


    <!-- Metis Menu Plugin JavaScript -->
    <script src="{url}assets/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript
    <script src="{url}assets/js/raphael.min.js"></script>
    <script src="{url}assets/js/morris.min.js"></script>
    <script src="{url}assets/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->

    <script>
        {modal}
    </script>
    <script src="{url}assets/js/sb-admin-2.js"></script>

</body>

</html>

