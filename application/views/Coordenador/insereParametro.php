          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Criar Parâmetros de Risco</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		                <div class="col-lg-3 col-md-6">
												<?php
													$atributos = array('name'=>'formulario_cadastro', 'id'=>'formulario_cadastro');
													$btn = array('name'=>'btn_cadastrar', 'id'=>'btn_cadastro', 'class'=>'btn btn-lg btn-primary');
													echo  form_open('coord/insereParametro', $atributos).
																form_label("Nota: ", "txt_nota").br().
																form_input('txt_nota').br().
																form_label("Frequência: ", "txt_freq").br().
																form_input('txt_freq').br().
																form_label("Matérias: ", "txt_materias").br().
																form_input('txt_materias').br().br();
																if($this->session->userdata('tipo') != 6){
																	echo form_radio("txt_mod", '1', false).
																form_label("Integrado", "txt_tipo").br().
																form_radio("txt_mod", '2', false).
																form_label("Subsequente", "txt_tipo").br();
																}
																else{
																	echo form_hidden("txt_mod", '1');
																}
																echo form_submit("btn_cadastrar", "Cadastrar", $btn).
																form_close();
												?>
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

