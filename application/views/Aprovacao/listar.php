          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Aprovação</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		        	<div class="col-lg-12 col-md-6" id="btn">
									<?php
									
									    $atributos = array('name'=>'formulario_cadastro', 'id'=>'formulario_cadastro');
                                        $i = 0;

										echo "<b><i>Selecione a turma: </i></b>".br().br();									
									
									
										echo form_open('Aprovacao/v_telaAlunos', $atributos);
												

										foreach ($TURMA as $t) {
											echo form_radio("turma[]", $t->idTURMA, FALSE).
												  form_label($t->SERIE."º ".$t->NOME." ".$t->MODALIDADE, "txt_li").br();
                                            if ($i == 2 || $i == 5 || $i == 8) {
                                                echo br();
                                            }
                                            if ($i == 10 || $i == 12 || $i == 14) {
                                                echo br();
                                            }
                                            $i++;

										}
										echo br().form_submit("btn_cadastrar", " Confirmar ", 'class = "btn btn-success"').br();
										echo form_close();	
									?>
					</div>
				</div>
          </div>
				</div>
			</div>


    <!-- jQuery -->
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

