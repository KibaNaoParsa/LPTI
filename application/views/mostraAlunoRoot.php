          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Ficha do Aluno</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              
              <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
              <script>
				  {script1}
			  </script>
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
								$this->db->select('TURMA_has_ALUNO.TURMA_idTURMA');
								$this->db->from('TURMA_has_ALUNO');
								$this->db->where('TURMA_has_ALUNO.ALUNO_idALUNO', $id);
								$turma = $this->db->get()->result();
								
								$this->db->select('*');
								$this->db->from('MATERIA');
								$this->db->join('TURMA_has_MATERIA', 'TURMA_has_MATERIA.MATERIA_idMATERIA = MATERIA.idMATERIA', 'inner');
								$this->db->where('TURMA_has_MATERIA.TURMA_idTURMA', $turma[0]->TURMA_idTURMA);
								$materias = $this->db->get()->result();
								
								foreach($materias as $materia){
									
									$bimestre = 1;
									
									for($bimestre = 1; $bimestre <= 4; $bimestre++){
										
										$sql = "SELECT ALUNO.NOME, AVG(NOTA.NOTA) AS NOTA, NOTA.BIMESTRE, MATERIA.NOME AS MATERIA\n"
										. "FROM NOTA\n"
										. "INNER JOIN MATERIA ON MATERIA.idMATERIA = NOTA.idMATERIA\n"
										. "INNER JOIN ALUNO ON ALUNO.idALUNO = NOTA.idALUNO\n"
										. "AND NOTA.idALUNO = " . $id
										. " AND NOTA.BIMESTRE = " . $bimestre
										. " AND MATERIA.idMATERIA = " . $materia->idMATERIA
										. " GROUP BY ALUNO.NOME, NOTA.BIMESTRE";
										
										$nota = $this->db->query($sql)->result();
											
										$sql = "SELECT ALUNO.NOME, AVG(FREQUENCIA.FALTAS) AS FREQUENCIA, FREQUENCIA.BIMESTRE\n"
										. "FROM FREQUENCIA\n"
										. "INNER JOIN MATERIA ON MATERIA.idMATERIA = FREQUENCIA.idMATERIA\n"
										. "INNER JOIN ALUNO ON ALUNO.idALUNO = FREQUENCIA.idALUNO\n"
										. "AND ALUNO.idALUNO = " . $id
										. " AND FREQUENCIA.BIMESTRE = " . $bimestre
										. " GROUP BY ALUNO.NOME, FREQUENCIA.BIMESTRE";
				
										$freq = $this->db->query($sql)->result();
										
										$this->db->select('PARAMETRO_DE_RISCO.NOTA');
										$this->db->from('PARAMETRO_DE_RISCO');
										$this->db->where('PARAMETRO_DE_RISCO.idTURMA', $turma[0]->TURMA_idTURMA);
										$this->db->order_by('PARAMETRO_DE_RISCO.NOTA', 'desc');
										
										$notaParametro = $this->db->get()->result();
																				
										$this->db->select('PARAMETRO_DE_RISCO.FREQUENCIA');
										$this->db->from('PARAMETRO_DE_RISCO');
										$this->db->where('PARAMETRO_DE_RISCO.idTURMA', $turma[0]->TURMA_idTURMA);
										$this->db->order_by('PARAMETRO_DE_RISCO.FREQUENCIA', 'desc');
										
										$frequenciaParametro = $this->db->get()->result();
											
											$situacao = '';
											
										if($bimestre == 1){
											$frequenciaParametro[0]->FREQUENCIA *= 20/100;
											$notaParametro[0]->NOTA *= 20/100;
										}	
										else if($bimestre == 2){
											$frequenciaParametro[0]->FREQUENCIA *= 30/100;
											$notaParametro[0]->NOTA *= 30/100;
										}
										else if($bimestre == 3){
											$frequenciaParametro[0]->FREQUENCIA *= 20/100;
											$notaParametro[0]->NOTA *= 20/100;
										}
										else if($bimestre == 4){
											$frequenciaParametro[0]->FREQUENCIA *= 30/100;
											$notaParametro[0]->NOTA *= 30/100;
										}
											
										if(Empty($nota) and !Empty($freq)){
											
											if($frequenciaParametro[0]->FREQUENCIA > $freq[0]->FREQUENCIA){
												$situacao = 'Abaixo da parâmetro do coordenador';
											}
											else if($frequenciaParametro->FREQUENCIA == $freq->FALTAS){
												if($situacao != 'Abaixo da parâmetro do coordenador')
												$situacao = 'Exatamente no parâmetro do coordenador';
											}
											else{
												$situacao = 'Acima do parâmetro do coordenador';
											}
											
											echo '<tr>
											<td>'. $situacao .'</td>
											<td>'. $materia->NOME .'</td>
											<td>'. 'Sem informação'.'</td>
											<td>'. $freq[0]->FREQUENCIA .'</td>
											<td>'. $bimestre .'</td>
											</tr>';	
										}
										else if(!Empty($nota) and Empty($freq)){
											
											if($notaParametro[0]->NOTA > $nota[0]->NOTA){
												$situacao = 'Abaixo da parâmetro do coordenador';
											}
											else if($notaParametro[0]->NOTA == $nota[0]->NOTA){
												if($situacao != 'Abaixo da parâmetro do coordenador')
												$situacao = 'Exatamente no parâmetro do coordenador';
											}
											else{
												$situacao = 'Acima do parâmetro do coordenador';
											}
											
											echo '<tr>
											<td>'. $situacao .'</td>
											<td>'. $materia->NOME .'</td>
											<td>'. $nota[0]->NOTA. '</td>
											<td>'. 'Sem informação' .'</td>
											<td>'. $bimestre .'</td>
											</tr>';	
										}
										else if(Empty($nota) and Empty($freq)){
											echo '<tr>
											<td>'. 'Sem informação' .'</td>
											<td>'. $materia->NOME .'</td>
											<td>'. 'Sem informação' .'</td>
											<td>'. 'Sem informação' .'</td>
											<td>'. $bimestre .'</td>
											</tr>';	
										}
										else if(Empty($notaParametro) or Empty($frequenciaParametro)){
											echo '<tr>
											<td>'. 'Sem informação' .'</td>
											<td>'. $materia->NOME .'</td>
											<td>'. $nota[0]->NOTA .'</td>
											<td>'. $freq[0]->FALTAS .'</td>
											<td>'. $bimestre .'</td>
											</tr>';	
										}
										else{
											
											if($notaParametro[0]->NOTA > $nota[0]->NOTA){
												$situacao = 'Abaixo da parâmetro do coordenador';
											}
											else if($notaParametro->NOTA > $nota->NOTA){
												if($situacao != 'Abaixo da parâmetro do coordenador')
												$situacao = 'Exatamente no parâmetro do coordenador';
											}
											else{
												$situacao = 'Acima do parâmetro do coordenador';
											}
											
											if($frequenciaParametro[0]->FREQUENCIA > $freq[0]->FREQUENCIA){
												$situacao = 'Abaixo da parâmetro do coordenador';
											}
											else if($frequenciaParametro->FREQUENCIA == $freq->FALTAS){
												if($situacao != 'Abaixo da parâmetro do coordenador')
												$situacao = 'Exatamente no parâmetro do coordenador';
											}
											else{
												$situacao = 'Acima do parâmetro do coordenador';
											}
											
											
											echo '<tr>
											<td>'. $situacao .'</td>
											<td>'. $materia->NOME .'</td>
											<td>'. $nota[0]->NOTA .'</td>
											<td>'. $freq[0]->FREQUENCIA .'</td>
											<td>'. $bimestre .'</td>
											</tr>';	
										}
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div id="Geral" style="width: 100%; height: 300px; "></div>
				</div>
				<div class="col-lg-4">
					<div id="Turma" style="width: 100%; height: 300px; "></div>
				</div>
				<div class="col-lg-4">
					<div id="Pessoal" style="width: 100%; height: 300px; "></div>
				</div>
			</div>
          </div>
		</div>
	</div>
	<script src="{url}assets/js/jquery.min.js"></script>
	
	
	
	<script src="{url}assets/js/bootstrap.min.js"></script>
    <script src="{url}assets/js/metisMenu.min.js"></script>
    <script src="{url}assets/js/raphael.min.js"></script>
    <script src="{url}assets/js/morris.min.js"></script>
    <script src="{url}assets/js/morris-data.js"></script>
    <script src="{url}assets/js/sb-admin-2.js"></script>
    <script>{modal}</script>
	</body>
</html>
