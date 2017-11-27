<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Listar extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            if(!$this->session->userdata('login')){
                    $this->load->view('login');
            }
        }

        public function listar($id, $curso, $mod){
			//Encontra os parâmetros de risco para aquela turma
			$this->db->select('*');
			$this->db->from('PARAMETRO_DE_RISCO');
			if($id != 0)
				$this->db->where('PARAMETRO_DE_RISCO.idTURMA', $id);
			else if(($mod != 0) and ($curso == 0)){
				$x = $this->db->like('PARAMETRO_DE_RISCO.idTURMA', $this->session->userdata('tipo'), 'after');
				if($mod ==1)
					$this->db->like('PARAMETRO_DE_RISCO.idTURMA', $x, 'after');
				else{
					$x += 3;
					$this->db->like('PARAMETRO_DE_RISCO.idTURMA', $x, 'after');
				}
			}
			else if($curso!= 0){
				$this->db->like('PARAMETRO_DE_RISCO.idTURMA', $curso, 'before');
			}
			$this->db->order_by('PARAMETRO_DE_RISCO.NOTA', 'ASC');
			$nota = $this->db->get()->result();
			
			$this->db->select('*');
			$this->db->from('PARAMETRO_DE_RISCO');
			if($id != 0)
				$this->db->where('PARAMETRO_DE_RISCO.idTURMA', $id);
			else if(($mod != 0) and ($curso == 0)){
				$x = $this->db->like('PARAMETRO_DE_RISCO.idTURMA', $this->session->userdata('tipo'), 'after');
				if($mod ==1)
					$this->db->like('PARAMETRO_DE_RISCO.idTURMA', $x, 'after');
				else{
					$x += 3;
					$this->db->like('PARAMETRO_DE_RISCO.idTURMA', $x, 'after');
				}
			}
			else if($curso!= 0){
				$this->db->like('PARAMETRO_DE_RISCO.idTURMA', $curso, 'before');
			}
			$this->db->order_by('PARAMETRO_DE_RISCO.NOTA', 'ASC');
			$freq = $this->db->get()->result();
			
			$parametros['NOTA'] = $nota[0];
			$parametros['FREQUENCIA'] = $freq[0];
			
			//Parâmetros de risco encontrados
			
			//Encontra os alunos para aquela turma
			$this->db->select('ALUNO.NOME AS NOME_ALUNO, ALUNO.idALUNO, TURMA_has_ALUNO.ANO, TURMA.idCURSO, CURSO.idCURSO, TURMA.SERIE, TURMA.MODALIDADE, MODALIDADE.idMODALIDADE, MODALIDADE.MODALIDADE, CURSO.NOME AS NOME_CURSO');
			$this->db->from('ALUNO');
			$this->db->join('TURMA_has_ALUNO', 'TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO', 'inner');
			$this->db->join('TURMA', 'TURMA.idTURMA = TURMA_has_ALUNO.TURMA_idTURMA', 'inner');
			$this->db->join('CURSO', 'CURSO.idCURSO = TURMA.idCURSO', 'inner');
			$this->db->join('MODALIDADE', 'CURSO.MODALIDADE = MODALIDADE.idMODALIDADE', 'inner');
						
			$ano = date("Y");
			if($id !=0)
				$this->db->where('TURMA.idTURMA', $id);
			else if($mod !=0 && $curso == 0)
				$this->db->where('CURSO.MODALIDADE', $mod);
			else if($curso != 0){
				$this->db->where('CURSO.MODALIDADE', $mod);
				$this->db->like('TURMA.idTURMA', $curso, 'after');
			}
			$this->db->where('TURMA_has_ALUNO.ANO', $ano);
			$data['TURMA_has_ALUNO'] = $this->db->get()->result();
			//Alunos encontrados
			
			foreach($data['TURMA_has_ALUNO'] as &$turma_has_aluno){
				//print_r($turma_has_aluno);
				//echo br();
				$turma_has_aluno->SITUACAO = 0;
				
				//Encontra todas as notas para aquele aluno
				$this->db->select('
									NOTA.NOTA, NOTA.idALUNO, TURMA_has_ALUNO.TURMA_idTURMA, 
									ALUNO.idALUNO, MATERIA.idMATERIA, NOTA.idNOTA, NOTA.BIMESTRE
								 ');
				$this->db->from('NOTA');
				$this->db->join('TURMA_has_ALUNO', 'NOTA.idALUNO = TURMA_has_ALUNO.ALUNO_idALUNO', 'inner');
				$this->db->join('ALUNO', 'TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO', 'inner');
				$this->db->join('MATERIA', 'MATERIA.idMATERIA = NOTA.idMATERIA', 'inner');
				$this->db->where('NOTA.idALUNO', $turma_has_aluno->idALUNO);
				$data['TURMA_has_NOTA'] = $this->db->get()->result();
				//Notas encontradas
				
				//Encontrar todas as frequencias para aquele aluno
				$this->db->select('
									FREQUENCIA.FALTAS, FREQUENCIA.idALUNO, TURMA_has_ALUNO.TURMA_idTURMA, 
									ALUNO.idALUNO, MATERIA.idMATERIA, FREQUENCIA.idFREQUENCIA, FREQUENCIA.BIMESTRE
								 ');
				$this->db->from('FREQUENCIA');
				$this->db->join('TURMA_has_ALUNO', 'FREQUENCIA.idALUNO = TURMA_has_ALUNO.ALUNO_idALUNO', 'inner');
				$this->db->join('ALUNO', 'TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO', 'inner');
				$this->db->join('MATERIA', 'MATERIA.idMATERIA = FREQUENCIA.idMATERIA', 'inner');
				$this->db->where('FREQUENCIA.idALUNO', $turma_has_aluno->idALUNO);
				$data['TURMA_has_FREQUENCIA'] = $this->db->get()->result();
				//Frequencias encontrados
				
				//Zerar o contador da soma
				foreach($data['TURMA_has_NOTA'] as $turma_has_nota){
					$soma[$turma_has_nota->idMATERIA][1] = 0;
					$media[$turma_has_nota->idMATERIA][1] = 0;
					$soma[$turma_has_nota->idMATERIA][2] = 0;
					$media[$turma_has_nota->idMATERIA][2] = 0;
					$soma[$turma_has_nota->idMATERIA][3] = 0;
					$media[$turma_has_nota->idMATERIA][3] = 0;
					$soma[$turma_has_nota->idMATERIA][4] = 0;
					$media[$turma_has_nota->idMATERIA][4] = 0;
				}
				
				foreach($data['TURMA_has_FREQUENCIA'] as $turma_has_frequencia){
					$somaFreq[$turma_has_frequencia->idMATERIA][1] = 0;
					$mediaFreq[$turma_has_frequencia->idMATERIA][1] = 0;
					$somaFreq[$turma_has_frequencia->idMATERIA][2] = 0;
					$mediaFreq[$turma_has_frequencia->idMATERIA][2] = 0;
					$somaFreq[$turma_has_frequencia->idMATERIA][3] = 0;
					$mediaFreq[$turma_has_frequencia->idMATERIA][3] = 0;
					$somaFreq[$turma_has_frequencia->idMATERIA][4] = 0;
					$mediaFreq[$turma_has_frequencia->idMATERIA][4] = 0;
				}
				//Contador zerado
				
				$bimestre = 0;
				
				//Soma as notas de mesma matéria
				foreach($data['TURMA_has_NOTA'] as &$turma_has_nota){
					$soma[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE] += $turma_has_nota->NOTA;
					$media[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE]++;
				}
				//Notas somadas
				
				//Soma as frequencias de mesma materia
				foreach($data['TURMA_has_FREQUENCIA'] as &$turma_has_frequencia){
					$somaFreq[$turma_has_frequencia->idMATERIA][$turma_has_frequencia->BIMESTRE] += $turma_has_frequencia->FALTAS;
					$mediaFreq[$turma_has_frequencia->idMATERIA][$turma_has_frequencia->BIMESTRE]++;
				}
				//Frequencias somadas
				
				//Média das notas
				foreach($data['TURMA_has_NOTA'] as &$turma_has_nota){
					//echo "Soma:" . $soma[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE] .br();
					$soma[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE] /= $media[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE];
					//echo "Média: " . $media[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE] . br();
					$media[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE] = 1;
				}
				
				//Média feita
				
				//Média das frequencias
				foreach($data['TURMA_has_FREQUENCIA'] as &$turma_has_frequencia){
					//echo "Soma:" . $soma[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE] .br();
					$somaFreq[$turma_has_frequencia->idMATERIA][$turma_has_frequencia->BIMESTRE] /= $mediaFreq[$turma_has_frequencia->idMATERIA][$turma_has_frequencia->BIMESTRE];
					//echo "Média: " . $media[$turma_has_nota->idMATERIA][$turma_has_nota->BIMESTRE] . br();
					$mediaFreq[$turma_has_frequencia->idMATERIA][$turma_has_frequencia->BIMESTRE] = 1;
				}
				//Média feita
				//echo "Soma/Média: ".br();
				//print_r($soma);
				//echo br();
				
				foreach($parametros as &$parametro){
					$CONTADOR[1] = 0;
					$CONTADOR[2] = 0;
					$CONTADOR[3] = 0;
					$CONTADOR[4] = 0;
					
					//Checar se a soma é menor do que a nota mínima
					foreach($soma as &$somas){
						//echo "Somas: ".br();
						//print_r($somas);
						//echo br()."NOTA: ".$parametro->NOTA.br();
						if(($somas[4] != 0)and($somas[4] <= ($parametro->NOTA*30/100)))
							$CONTADOR[4]++;
						else if(($somas[3] != 0)and($somas[3] <= ($parametro->NOTA*20/100)))
							$CONTADOR[3]++;
						else if(($somas[2] != 0)and($somas[2] <= ($parametro->NOTA*30/100)))
							$CONTADOR[2]++;
						else if(($somas[1] != 0)and($somas[1] <= ($parametro->NOTA*20/100))){
							$CONTADOR[1]++;
							//echo 'Add nota'.br();
						}
					}
					//Soma checada
					
					//Checar se a frequencia é menor do que a frequencia mínima
					foreach($somaFreq as &$somas){
						//echo "Somas: ".br();
						//print_r($somas);
						//echo br()."NOTA: ".$parametro->NOTA.br();
						if(($somas[4] != 0)and($somas[4] <= ($parametro->FREQUENCIA)))
							$CONTADOR[4]++;
						else if(($somas[3] != 0)and($somas[3] <= ($parametro->FREQUENCIA)))
							$CONTADOR[3]++;
						else if(($somas[2] != 0)and($somas[2] <= ($parametro->FREQUENCIA)))
							$CONTADOR[2]++;
						else if(($somas[1] != 0)and($somas[1] <= ($parametro->FREQUENCIA))){
							$CONTADOR[1]++;
							//echo 'Add freq'.br();
						}
					}
					//echo "Soma notas: ".br();
					//print_r($soma);
					//echo br();
					//echo "Parametro Nota: " . $parametro->NOTA .br();
					//echo "Soma freq: ".br();
					//print_r($soma);
					//echo br();
					//echo "Parametro Freq: " . $parametro->NOTA .br();
					//echo br().'CONTADOR: ';
					//print_r($CONTADOR);
					//echo br();
					//Frequencia checada
					
				}
				
				//Checar se as matérias com nota vermelha estão no limite
				//print_r($CONTADOR);
				//echo br();
				
				if($CONTADOR[4] >= $parametro->MATERIAS){
					if($turma_has_aluno->SITUACAO == 0){
						$turma_has_aluno->SITUACAO = 'danger 4B';
					}    
				}
				else if($CONTADOR[3] >= $parametro->MATERIAS){
					if($turma_has_aluno->SITUACAO == 0){
						$turma_has_aluno->SITUACAO = 'danger 3B';
					}    
				}
				else if($CONTADOR[2] >= $parametro->MATERIAS){
					if($turma_has_aluno->SITUACAO == 0){
						$turma_has_aluno->SITUACAO = 'danger 2B';
					}    
				}
				else if($CONTADOR[1] >= $parametro->MATERIAS){
					if($turma_has_aluno->SITUACAO == 0){
						$turma_has_aluno->SITUACAO = 'danger 1B';
					}    
				}
				else
					$turma_has_aluno->SITUACAO = 'all-right';
					
				//echo "SITUACAO: " . $turma_has_aluno->SITUACAO .br();
				//Matérias checadas
			}
			$dat['Tipo'] = $this->session->userdata('tipo');
			if($this->session->userdata('tipo') == 0)
				$this->parser->parse('ajax', $data);
			else
				$this->parser->parse('ajaxCoord', $dat);
            $this->parser->parse("listar", $data);
        }
        
        public function alunoChamada($id){
			
			$data['id'] = $id;
			
			$data['url'] = base_url();
			
			$sql = "SELECT ALUNO.idALUNO AS MATRICULA, ALUNO.NOME AS NOME, TURMA.SERIE, CURSO.NOME AS CURSO, CURSO.MODALIDADE\n"
			. "FROM ALUNO\n"
			. "INNER JOIN TURMA_has_ALUNO ON TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO\n"
			. "INNER JOIN TURMA ON TURMA.idTURMA = TURMA_has_ALUNO.TURMA_idTURMA\n"
			. "INNER JOIN CURSO ON CURSO.idCURSO = TURMA.idCURSO\n"
			. "WHERE ALUNO.idALUNO = 201518110110";
			$data['DADOS'] = $this->db->query($sql)->result();
			
			if($data['DADOS'][0]->MODALIDADE == 1)
				$data['DADOS'][0]->MODALIDADE = "Integrado";
			else
				$data['DADOS'][0]->MODALIDADE = "Subsequente";
			
			$sql = "SELECT MATERIA.NOME,
				AVG(NOTA.NOTA) AS 'SOMA'
				FROM NOTA
				INNER JOIN MATERIA ON MATERIA.idMATERIA = NOTA.idMATERIA
				GROUP BY MATERIA.NOME";
			$valor = $this->db->query($sql)->result();
					
			$data['script1'] = 'window.onload = function () {
							var chart = new CanvasJS.Chart("Geral", {
								height: 300,
								animationEnabled: true,
								exportEnabled: true,
								zoomEnabled: true,
								
								title:{
									text:"Média Geral da Escola"
								},
								axisX:{
									interval: 1
								},
								axisY2:{
									interlacedColor: "rgba(1,77,101,.2)",
									gridColor: "rgba(1,77,101,.1)",
									title: "Nota Média"
								},
								data: [{
									type: "bar",
									name: "notas",
									axisYType: "secondary",
									color: "#014D65",
									dataPoints: [ ';
									foreach($valor as $medias)
										$data['script1'] .= '{ y: '. $medias->SOMA . ', label: "'. $medias->NOME .'"},';
									$data['script1'] = substr($data['script1'], 0, -1);
									$data['script1'] .= ']
								}]
							});';
							
							$this->db->select('TURMA_has_ALUNO.TURMA_idTURMA');
								$this->db->from('TURMA_has_ALUNO');
								$this->db->where('TURMA_has_ALUNO.ALUNO_idALUNO', $id);
								$turma = $this->db->get()->result();
							
				$sql = "SELECT MATERIA.NOME,
				AVG(NOTA.NOTA) AS 'SOMA'
				FROM NOTA
				INNER JOIN MATERIA ON MATERIA.idMATERIA = NOTA.idMATERIA
				INNER JOIN TURMA_has_ALUNO ON TURMA_has_ALUNO.ALUNO_idALUNO = NOTA.idALUNO
				WHERE TURMA_has_ALUNO.TURMA_idTURMA = " . $turma[0]->TURMA_idTURMA . "
				GROUP BY MATERIA.NOME";
			$valor = $this->db->query($sql)->result();
			
			$data['script1'] .= '
							var chart1 = new CanvasJS.Chart("Turma", {
								height: 300,
								animationEnabled: true,
								exportEnabled: true,
								zoomEnabled: true,
								
								title:{
									text:"Média da Turma"
								},
								axisX:{
									interval: 1
								},
								axisY2:{
									interlacedColor: "rgba(1,77,101,.2)",
									gridColor: "rgba(1,77,101,.1)",
									title: "Nota Média"
								},
								data: [{
									type: "bar",
									name: "notas",
									axisYType: "secondary",
									color: "#014D65",
									dataPoints: [ ';
									foreach($valor as $medias)
										$data['script1'] .= '{ y: '. $medias->SOMA . ', label: "'. $medias->NOME .'"},';
									$data['script1'] = substr($data['script1'], 0, -1);
									$data['script1'] .= ']
								}]
							});';
								
							$sql = "SELECT MATERIA.NOME,
				AVG(NOTA.NOTA) AS 'SOMA'
				FROM NOTA
				INNER JOIN MATERIA ON MATERIA.idMATERIA = NOTA.idMATERIA
				INNER JOIN TURMA_has_ALUNO ON TURMA_has_ALUNO.ALUNO_idALUNO = NOTA.idALUNO
				WHERE NOTA.idALUNO = " . $id . "
				GROUP BY MATERIA.NOME";
			$valor = $this->db->query($sql)->result();
			
			$data['script1'] .= '
							var chart2 = new CanvasJS.Chart("Pessoal", {
								height: 300,
								animationEnabled: true,
								exportEnabled: true,
								zoomEnabled: true,
								
								title:{
									text:"Média do Aluno"
								},
								axisX:{
									interval: 1
								},
								axisY2:{
									interlacedColor: "rgba(1,77,101,.2)",
									gridColor: "rgba(1,77,101,.1)",
									title: "Nota Média"
								},
								data: [{
									type: "bar",
									name: "notas",
									axisYType: "secondary",
									color: "#014D65",
									dataPoints: [ ';
									foreach($valor as $medias)
										$data['script1'] .= '{ y: '. $medias->SOMA . ', label: "'. $medias->NOME .'"},';
									$data['script1'] = substr($data['script1'], 0, -1);
									$data['script1'] .= ']
								}]
							});	
							chart.render();
							chart1.render();
							chart2.render();
							}';
							
			if($this->session->userdata('tipo') == 0){
				$this->parser->parse('ajax', $data);
				$this->parser->parse('mostraAlunoRoot', $data);
			}
			else{
				$data['tipo'] = $this->session->userdata('tipo');
				$this->parser->parse('ajaxCoord', $data);
				$this->parser->parse('mostraAlunoRoot', $data);
			}
		}

    }
