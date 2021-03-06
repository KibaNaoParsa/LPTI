<?php defined('BASEPATH') or exit('No direct script access allowed');

    class Relatorio extends CI_Controller {

        public function __construct() {
            parent::__construct();
			if(!$this->session->userdata('login')){
				$this->load->view('login');
			}

        }
        
        public function index($ano) {
			
				$this->db->select('QUESTIONARIO.ANO');
				$this->db->from('QUESTIONARIO');
				$this->db->distinct();
				$data['ANO'] = $this->db->get()->result();			
			
				$data['url'] = base_url();
				
				if($ano == 0) {			
					
					$this->db->select('QUESTIONARIO.NOME, QUESTIONARIO.idQUESTIONARIO, QUESTIONARIO.ANO');
					$this->db->from('QUESTIONARIO');
					$data['QUESTIONARIO'] = $this->db->get()->result();					
					
					
					$this->parser->parse('ajax', $data);
					$this->parser->parse('Relatorio/relatorios', $data);
			        
         	} else {
					$this->db->select('QUESTIONARIO.NOME, QUESTIONARIO.idQUESTIONARIO, QUESTIONARIO.ANO');
					$this->db->from('QUESTIONARIO');
					$this->db->where('QUESTIONARIO.ANO', $ano);
					$data['QUESTIONARIO'] = $this->db->get()->result();					
					
					
					$this->parser->parse('ajax', $data);
					$this->parser->parse('Relatorio/relatorios', $data);         	
         	}
        }
        
        // Início de chamada de view

			public function v_turmas($idQe) { 
				$idQ = base64_decode($idQe);
    
    			$this->db->select('QUESTIONARIO_has_TURMA.TURMA_idTURMA, TURMA.SERIE, CURSO.NOME, MODALIDADE.MODALIDADE');
    			$this->db->from('QUESTIONARIO_has_TURMA');
    			$this->db->join('TURMA', 'QUESTIONARIO_has_TURMA.TURMA_idTURMA = TURMA.idTURMA', 'inner');				
    			$this->db->join('CURSO', 'CURSO.idCURSO = TURMA.idCURSO', 'inner');
    			$this->db->join('MODALIDADE', 'MODALIDADE.idMODALIDADE = CURSO.MODALIDADE', 'inner');				
				$this->db->where('QUESTIONARIO_has_TURMA.QUESTIONARIO_idQUESTIONARIO', $idQ);
				$data['TURMA'] = $this->db->get()->result();
				
				$this->db->select('QUESTIONARIO.NOME');
				$this->db->from('QUESTIONARIO');
				$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
				$data['NOME'] = $this->db->get()->result();
				
				$data['idQUESTIONARIO'] = $idQ;
				
				$data['url'] = base_url();
				$this->parser->parse('ajax', $data);
				$this->parser->parse('Relatorio/tipo', $data);
				
							
			}    
			
			public function v_chartSingle($idQe, $idTe, $idDe) {
				$idQ = base64_decode($idQe);
				$idT = base64_decode($idTe);
				$idD = base64_decode($idDe); 			
			
			
				$data['url'] = base_url();		
				$data['idQUESTIONARIO'] = $idQ;
				$data['idTURMA'] = $idT;
				
    			$this->db->select('DIMENSAO.idDIMENSAO, DIMENSAO.DESCRICAO');
    			$this->db->from('DIMENSAO');
    			$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = DIMENSAO.idQUESTIONARIO', 'inner');
    			$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
    			$data['DIMENSAO'] = $this->db->get()->result();
    							
				if ($idD == 0) {
					$this->parser->parse('ajax', $data);
					$this->parser->parse('Relatorio/boot', $data);	
					$this->parser->parse('Relatorio/fechamento', $data);	
				} else {


					$this->db->select('ALUNO.idALUNO, ALUNO.NOME');
					$this->db->from('ALUNO');
					$this->db->join('TURMA_has_ALUNO', 'TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO', 'inner');
					$this->db->join('TURMA', 'TURMA.idTURMA = TURMA_has_ALUNO.TURMA_idTURMA', 'inner');
					$this->db->join('QUESTIONARIO', 'QUESTIONARIO.ANO = TURMA_has_ALUNO.ANO', 'inner');
					$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
					$this->db->where('TURMA.idTURMA', $idT);   				
					$this->db->order_by('ALUNO.NOME', 'desc');					
   				$vetor['RESPOSTA_MATRICULA'] = $this->db->get()->result();
   			
   				$i = 0;
   				
    				foreach ($vetor['RESPOSTA_MATRICULA'] as $r) {

						$query= $this->db->query('SELECT RESPOSTA.RESPOSTA FROM RESPOSTA 
															INNER JOIN ALUNO ON RESPOSTA.idALUNO = ALUNO.idALUNO
    														INNER JOIN PERGUNTA ON PERGUNTA.idPERGUNTA = RESPOSTA.idPERGUNTA
   														INNER JOIN DIMENSAO ON DIMENSAO.idDIMENSAO = PERGUNTA.idDIMENSAO
    														INNER JOIN QUESTIONARIO ON QUESTIONARIO.idQUESTIONARIO = DIMENSAO.idQUESTIONARIO
    														WHERE QUESTIONARIO.idQUESTIONARIO = '.$idQ.' 
    															AND DIMENSAO.idDIMENSAO = '.$idD.' 
    															AND RESPOSTA.RESPOSTA_ABERTA is null 
													    		AND ALUNO.idALUNO = '.$r->idALUNO.'');
   		
  						$vetor['RESPOSTA_TOTAL'][$i] = $query->num_rows();
  						$i++;
					}
				
					$i = 0;
				
					foreach($vetor['RESPOSTA_MATRICULA'] as $r) {
						$data['RESPOSTA']['NOME'][$i] = $r->NOME;
						$data['RESPOSTA']['TOTAL'][$i] = $vetor['RESPOSTA_TOTAL'][$i];
						$i++;				
					}
					

					$this->db->select('PERGUNTA.idPERGUNTA, PERGUNTA.PERGUNTA');
					$this->db->from('PERGUNTA');
					$this->db->join('DIMENSAO', 'DIMENSAO.idDIMENSAO = PERGUNTA.idDIMENSAO', 'inner');
					$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = DIMENSAO.idQUESTIONARIO', 'inner');
					$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
					$this->db->where('DIMENSAO.idDIMENSAO', $idD);
					$this->db->where('PERGUNTA.TIPO', 1);
					$data['PERGUNTA_ABERTA'] = $this->db->get()->result();
					
					$i = 0;
					
					foreach ($data['PERGUNTA_ABERTA'] as $p) {
						
						foreach ($vetor['RESPOSTA_MATRICULA'] as $r) {				

							$this->db->select('PERGUNTA.idPERGUNTA, PERGUNTA.PERGUNTA, RESPOSTA.RESPOSTA_ABERTA, USUARIO.LOGIN');
							$this->db->from('RESPOSTA');
							$this->db->join('USUARIO', 'RESPOSTA.idUSUARIO = USUARIO.idUSUARIO', 'inner');
							$this->db->join('PERGUNTA', 'PERGUNTA.idPERGUNTA = RESPOSTA.idPERGUNTA', 'inner');
							$this->db->join('DIMENSAO', 'DIMENSAO.idDIMENSAO = PERGUNTA.idDIMENSAO', 'inner');
							$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = DIMENSAO.idQUESTIONARIO', 'inner');
							$this->db->join('ALUNO', 'ALUNO.idALUNO = RESPOSTA.idALUNO', 'inner');						
							$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
							$this->db->where('DIMENSAO.idDIMENSAO', $idD);
							$this->db->where('ALUNO.idALUNO', $r->idALUNO);
							$this->db->where('RESPOSTA.RESPOSTA', null);
							$this->db->where('PERGUNTA.idPERGUNTA', $p->idPERGUNTA);							
							$this->db->order_by('PERGUNTA.idPERGUNTA', 'asc');
							$data['RESPOSTA_ABERTA'][$i] = $this->db->get()->result();	
						
						}
						
						$i++;
					}
					
					$this->db->select('DIMENSAO.DESCRICAO');
					$this->db->from('DIMENSAO');
					$this->db->where('DIMENSAO.idDIMENSAO', $idD);
					$data['NOME'] = $this->db->get()->result();						
						
					$this->parser->parse('ajax', $data);
					$this->parser->parse('Relatorio/boot', $data);				
					$this->parser->parse('Relatorio/chartSingle', $data);

					$this->parser->parse('Relatorio/fechamento', $data); 
		
				}
		
			
			}
			
			public function v_chartMultiple($idQ, $idT) {
						
				$data['url'] = base_url();		
				$data['idQUESTIONARIO'] = $idQ;
				$data['idTURMA'] = $idT;
				
    			$this->db->select('DIMENSAO.idDIMENSAO, DIMENSAO.DESCRICAO');
    			$this->db->from('DIMENSAO');
    			$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = DIMENSAO.idQUESTIONARIO', 'inner');
    			$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
    			$data['DIMENSAO'] = $this->db->get()->result();

					$this->db->select('ALUNO.idALUNO, ALUNO.NOME');
					$this->db->from('ALUNO');
					$this->db->join('TURMA_has_ALUNO', 'TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO', 'inner');
					$this->db->join('TURMA', 'TURMA.idTURMA = TURMA_has_ALUNO.TURMA_idTURMA', 'inner');
					$this->db->join('QUESTIONARIO', 'QUESTIONARIO.ANO = TURMA_has_ALUNO.ANO', 'inner');
					$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
					$this->db->where('TURMA.idTURMA', $idT);   				
					$this->db->order_by('ALUNO.NOME', 'desc');					
   				$vetor['RESPOSTA_MATRICULA'] = $this->db->get()->result();
   			
   				$i = 0;
   				
    				foreach ($vetor['RESPOSTA_MATRICULA'] as $r) {

						$query= $this->db->query('SELECT RESPOSTA.RESPOSTA FROM RESPOSTA 
															INNER JOIN ALUNO ON RESPOSTA.idALUNO = ALUNO.idALUNO
    														INNER JOIN PERGUNTA ON PERGUNTA.idPERGUNTA = RESPOSTA.idPERGUNTA
   														INNER JOIN DIMENSAO ON DIMENSAO.idDIMENSAO = PERGUNTA.idDIMENSAO
    														INNER JOIN QUESTIONARIO ON QUESTIONARIO.idQUESTIONARIO = DIMENSAO.idQUESTIONARIO
    														WHERE QUESTIONARIO.idQUESTIONARIO = '.$idQ.'  
    															AND RESPOSTA.RESPOSTA_ABERTA is null 
													    		AND ALUNO.idALUNO = '.$r->idALUNO.'');
   		
  						$vetor['RESPOSTA_TOTAL'][$i] = $query->num_rows();
  						$i++;
					}
				
					$i = 0;
				
					foreach($vetor['RESPOSTA_MATRICULA'] as $r) {
						$data['RESPOSTA']['NOME'][$i] = $r->NOME;
						$data['RESPOSTA']['TOTAL'][$i] = $vetor['RESPOSTA_TOTAL'][$i];
						$i++;				
					}

					$this->db->select('PERGUNTA.idPERGUNTA, PERGUNTA.PERGUNTA');
					$this->db->from('PERGUNTA');
					$this->db->join('DIMENSAO', 'DIMENSAO.idDIMENSAO = PERGUNTA.idDIMENSAO', 'inner');
					$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = DIMENSAO.idQUESTIONARIO', 'inner');
					$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
					$this->db->where('PERGUNTA.TIPO', 1);
					$data['PERGUNTA_ABERTA'] = $this->db->get()->result();
					
					$i = 0;
					
					foreach ($data['PERGUNTA_ABERTA'] as $p) {
						
						foreach ($vetor['RESPOSTA_MATRICULA'] as $r) {				

							$this->db->select('PERGUNTA.idPERGUNTA, PERGUNTA.PERGUNTA, RESPOSTA.RESPOSTA_ABERTA, USUARIO.LOGIN');
							$this->db->from('RESPOSTA');
							$this->db->join('USUARIO', 'RESPOSTA.idUSUARIO = USUARIO.idUSUARIO', 'inner');
							$this->db->join('PERGUNTA', 'PERGUNTA.idPERGUNTA = RESPOSTA.idPERGUNTA', 'inner');
							$this->db->join('DIMENSAO', 'DIMENSAO.idDIMENSAO = PERGUNTA.idDIMENSAO', 'inner');
							$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = DIMENSAO.idQUESTIONARIO', 'inner');
							$this->db->join('ALUNO', 'ALUNO.idALUNO = RESPOSTA.idALUNO', 'inner');						
							$this->db->where('QUESTIONARIO.idQUESTIONARIO', $idQ);
							$this->db->where('ALUNO.idALUNO', $r->idALUNO);
							$this->db->where('RESPOSTA.RESPOSTA', null);
							$this->db->where('PERGUNTA.idPERGUNTA', $p->idPERGUNTA);							
							$this->db->order_by('PERGUNTA.idPERGUNTA', 'asc');
							$data['RESPOSTA_ABERTA'][$i] = $this->db->get()->result();	
						
						}
						
						$i++;
					}
					
					$this->parser->parse('ajax', $data);
					$this->parser->parse('Relatorio/chartMultiple', $data);
					$this->parser->parse('Relatorio/fechamento', $data); 
		
			
			}
        
        // Fim de chamada de view  


			public function chart() {
				$idQUESTIONARIO = $this->input->post('idQUESTIONARIO');

				$item = $this->input->get_post('turma');
			
				if(!empty($item)) {
					$qtd = count($item);
				}
			
				for ($i = 0; $i < $qtd; $i++) {
					$idTURMA = $item[$i];
				}
				
				$item2 = $this->input->get_post('relatorio');
			
				if(!empty($item2)) {
					$qtd = count($item2);
				}
			
				for ($i = 0; $i < $qtd; $i++) {
					$relatorio = $item2[$i];
				}
				
				if ($relatorio == 0) {
					$this->v_chartSingle(base64_encode($idQUESTIONARIO), base64_encode($idTURMA), base64_encode(0));				
				}		
			
			}	
	
	
	
	}
