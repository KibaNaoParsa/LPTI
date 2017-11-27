          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Ficha do Aluno</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
			<div class="row">
				<div class="col-lg-3" id="data2">
					 <img id="image" src="/LPTI/assets/img/not-found.png"> 
				</div>
				<div class="col-lg-8" id="linha">
					<div class="row">
						<div class="col-lg-5" id="data">
							<?php echo "Matrícula: ". $DADOS[0]->MATRICULA?>
						</div>
						<div class="col-lg-7" id="data">
							<?php echo "Nome: ". $DADOS[0]->NOME?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4" id="data">
							<?php echo "Série: ". $DADOS[0]->SERIE?>
						</div>
						<div class="col-lg-4" id="data">
							<?php echo "Curso: ". $DADOS[0]->CURSO?>
						</div>
						<div class="col-lg-4" id="data">
							<?php echo "Modalidade: ". $DADOS[0]->MODALIDADE?>
						</div>
					</div>
				</div>
			</div>
			<div class = "row">
				<div class="col-lg-12" id="data3">
					<table id='myTable'>
					  <thead>
						<tr>
							<th>Situação</th>
							<th>Materia</th>
							<th>Nota</th>
							<th>Frequencia</th>
							<th>Bimestre</th>
						</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Situação</th>
								<th>Materia</th>
								<th>Nota</th>
								<th>Frequencia</th>
								<th>Bimestre</th>
							</tr>
						</tfoot>
						<tbody>
							<?php
								for($i = 1; $i <= 4; $i++){
									foreach($materias as $materia){
										echo '<tr>
										<td>'.'</td>
										<td>'.'</td>
										<td>'.'</td>
										<td>'.'</td>
										<td>'.'</td>
										</tr>';
									}
								}	
							?>
						</tbody>
					</table>
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


