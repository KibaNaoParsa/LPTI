<?php defined('BASEPATH') or exit('No direct script access allowed');

    class Relatorio extends CI_Controller {

        public function __construct() {
            parent::__construct();
			$this->load->library('session');
			if(!$this->session->userdata('login')){
//				$this->load->view('login');
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

			public function v_turmas($idQ) { 
    
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
        
        // Fim de chamada de view  

			public function chartSingle($idQ, $idT) {
							
			}


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
			
				if(!empty($item)) {
					$qtd = count($item);
				}
			
				for ($i = 0; $i < $qtd; $i++) {
					$relatorio = $item[$i];
				}
				
				if ($relatorio == 0) {
					$this->chartSingle($idQUESTIONARIO, $idTURMA);				
				}
				if ($relatorio == 1) {
					$this->chartMultiple($idQUESTIONARIO, $idTURMA);				
				}		
			
			}	
	
	
	
	}