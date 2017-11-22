<style>
	table, tr, td {
		border: 1px solid transparent;
		text-align: left;	
	}
	
</style>
          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Aprovação</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		                <div class="col-lg-12 col-md-6">
												<?php

                                      $ano = date("Y");
                                      $atributos = array('name'=>'formulario_cadastro', 'id'=>'formulario_cadastro');
												  $btn = array('name'=>'btn_cadastrar', 'id'=>'botao1', 'class'=>'btn btn-success');

												echo form_open('Aprovacao/moverAlunos', $atributos).
											     	form_hidden('idTURMA', $idTURMA);

													foreach ($ALUNO as $a) {

														echo
														form_checkbox("aluno[]", $a->idALUNO, TRUE) .
														form_label( $a->NOME, "txt_1i") . br();

													}

                                                echo br()."<b>Mover para: </b>".br();

                                                $i = 0;

                                                echo "<table>
															<tr>";												
												foreach ($TURMA as $t) {
													echo "<td>"; 

                                                    echo form_radio("turma[]", $t->idTURMA, FALSE).
												         form_label($t->SERIE."º ".$t->NOME." ".$t->MODALIDADE, "txt_li").br();
												   echo "</td>";

													if (($i == 2) || ($i == 5) || ($i == 8) || ($i == 10) || ($i == 12) || ($i == 14)) {
														echo "</tr><tr>";													
													}
													$i++;													
												}
												
													echo "<td>";

                                                echo form_radio("turma[]", 99, FALSE).
												     form_label("LIMBO", "txt_li")."</td>".br();

												echo "</tr></table>".br();
												
												echo form_label("Ano: ", "txt_ano").
												form_input(array('name'=>'txt_ano', 'type'=>'number', 'min'=>$ano, 'max'=>1+$ano, 'value'=>$ano)).br();
													 echo br().
													 form_submit("btn_cadastrar", " Salvar ", $btn).
													 form_close();													
										        
									


												?>
											</div>
              </div>
          </div>
        </div>
      </div>


    <!-- jQuery -->
    <script src="{url}assets/js/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(e){
        $("#btn a").click(function(e){
          e.preventDefault();
          var href = $(this).attr('href');
          $("#Main").load(href + " #Main");
        });
      });
    </script>

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

</body>

</html>




