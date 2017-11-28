<style>
	table, tr, td {
		border: 1px solid transparent;
		text-align: left;	
	}
	
</style>


          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Associação Disciplina-Classe</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		                <div class="col-lg-6 col-md-6">
												<?php
												
												$i = 0;
												echo "Identificação: ".$USUARIO[0]->LOGIN.br();
												
												echo "<table>
															<tr>";												
												foreach ($TURMA as $t) {
													echo "<td>". anchor("Permissao/v_selecaoII/".base64_encode($USUARIO[0]->idUSUARIO)."/".base64_encode($t->idTURMA), 
																				$t->SERIE."° ".$t->NOME." ".$t->MODALIDADE, 'class="btn btn-info"')."</td>";
													if (($i == 2) || ($i == 5) || ($i == 8) || ($i == 10) || ($i == 12) || ($i == 14)) {
														echo "</tr><tr>";													
													}
													$i++;													
												}
												
												echo "</tr></table>";
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


