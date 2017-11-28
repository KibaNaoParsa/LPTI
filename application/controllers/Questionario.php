<?php defined('BASEPATH') or exit('No direct script access allowed.');

    class Questionario extends CI_Controller {

        public function __construct() {
            parent::__construct();
			if(!$this->session->userdata('login')){
				$this->load->view('login');
			}
        }

		public function index() {
			$data['msg'] = '';
			$data['modal'] = '';
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('telaAdm', $data);
		}

		// Início de chamada de view
		
		
		public function v_cadastro() {
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Questionario/cadastro', $data);
		}
		
		
		public function v_listar() {
			$data['QUESTIONARIO'] = $this->db->get('QUESTIONARIO')->result();
			
			
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Questionario/listar', $data);
		}
		
		public function v_editar($ide) {
			$id = base64_decode($ide);

			$this->db->where('idQUESTIONARIO', $id);
			$data['QUESTIONARIO'] = $this->db->get('QUESTIONARIO')->result();
			
			$this->db->where('idQUESTIONARIO', $id);
			$data['DIMENSAO'] = $this->db->get('DIMENSAO')->result();
			
			
			$data['url'] = base_url();
			
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Questionario/editar', $data);
		}

		public function v_associar($ide) {
			$id = base64_decode($ide);
			
			$this->db->select('CURSO.NOME, TURMA.SERIE, TURMA.idTURMA, MODALIDADE.MODALIDADE');
			$this->db->from('CURSO');
			$this->db->join('TURMA', 'CURSO.idCURSO=TURMA.idCURSO', 'inner');
			$this->db->join('MODALIDADE', 'CURSO.MODALIDADE = MODALIDADE.idMODALIDADE', 'inner');
			$this->db->where('CURSO.idCURSO !=', 99);

			$this->db->distinct();
			$data['TURMA'] = $this->db->get()->result();
			
			$this->db->select('QUESTIONARIO.idQUESTIONARIO, QUESTIONARIO.NOME');
			$this->db->from('QUESTIONARIO');
			$this->db->where('idQUESTIONARIO', $id);
			$data['QUESTIONARIO'] = $this->db->get()->result();
			
			
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Questionario/associar', $data);
			
		}
		
		// Fim de chamada de view
		
		// Funções Frankestein©
		
		public function associacaoMUTQ($data) {

			$mut = $this->db->query("select MUT.USUARIO_idUSUARIO, MUT.MATERIA_idMATERIA from MUT 
												WHERE MUT.TURMA_idTURMA = ".$data['TURMA_idTURMA']." and MUT.ANO = ".$data['ANO'])->result();
												
			foreach($mut as $m) {
				$data['USUARIO_idUSUARIO'] = $m->USUARIO_idUSUARIO;
				$data['MATERIA_idMATERIA'] = $m->MATERIA_idMATERIA;
				$this->db->insert('MUT_has_QUESTIONARIO', $data);			
			}															
		
		}	
		
		
		
		// Fim das funções Frankestein©	
		
		
		
		
		public function criar() {
		
			$data['NOME'] = $this->input->post('txt_nome');
			$data['ANO'] = $this->input->post('txt_ano');
			$this->db->insert('QUESTIONARIO', $data);
			$codigo = $this->db->query("SELECT idQUESTIONARIO from QUESTIONARIO ORDER BY idQUESTIONARIO desc limit 1")->result();
			
			foreach($codigo as $c) {
				$quest = base64_encode($c->idQUESTIONARIO);
				$this->v_editar($quest);			
			}
			
			//$data['url'] = base_url();
			//$this->parser->parse('telaAdm', $data);
			

		}
        
        
        public function editarNome() {
		
			$idusu = $this->input->post('id');
			
			$data['NOME'] = $this->input->post('txt_nome');
			$this->db->where('idQUESTIONARIO', $idusu);
			
			$this->db->update('QUESTIONARIO', $data);

			$idusue = base64_encode($idusu);
			$this->v_editar($idusue);

			
		}
		
		
		public function dimensao() {
		
			$idusu = $this->input->post('id');
			
			$data['idQUESTIONARIO'] = $idusu;
			$data['DESCRICAO'] = $this->input->post('txt_dimensao');
			$this->db->insert('DIMENSAO', $data);
			
			$idusue = base64_encode($idusu);
			$this->v_editar($idusue);
		
			
		}
		
		public function excluir_dimensao($ide, $idQe) {
			$id = base64_decode($ide);
			$idQ = base64_decode($idQe);						
			
			$query = $this->db->query('select PERGUNTA.idPERGUNTA from PERGUNTA where PERGUNTA.idDIMENSAO = '.$id);
			
			if ($query->num_rows() == 0) {
			
				$this->db->select('idDIMENSAO');
				$this->db->from('DIMENSAO');
				$this->db->where('idDIMENSAO', $id);
			
				if($this->db->delete('DIMENSAO')) {
				
					redirect('Questionario/v_editar/'.$idQe);
					
				}
			
			} else {
                echo '<script type="text/javascript">confirm("Há alguma pergunta cadastrada com essa dimensão. Apague a pergunta primeiro.");</script>';
					$this->v_editar($idQe);                
                			
			
			}
			
		}		
		
		
		public function inserirPergunta() {
		
			$idusu = $this->input->post('id');
			
		
			$data['PERGUNTA'] = $this->input->post('txt_pergunta');
		
			$item = $this->input->get_post('tipo');
			
			if(!empty($item)) {
				$qtd = count($item);
			}
			
			for ($i = 0; $i < $qtd; $i++) {
					$data['TIPO'] = $item[$i];
			}
			
			$item1 = $this->input->get_post('dimensao');
			
			if(!empty($item1)) {
				$qtd = count($item1);
			}
			
			for ($i = 0; $i < $qtd; $i++) {
					if(!empty($item1[$i])) {
						$data['idDIMENSAO'] = $item1[$i];
					}
			}
			
			$this->db->insert('PERGUNTA', $data);
			
			$idusue = base64_encode($idusu);
			$this->v_editar($idusue);
		
	
			
		}
        
		public function associar() {
			
			$data['QUESTIONARIO_idQUESTIONARIO'] = $this->input->post('idQUESTIONARIO');
			$ano = $this->db->query("SELECT QUESTIONARIO.ANO FROM QUESTIONARIO 
											WHERE QUESTIONARIO.idQUESTIONARIO = ".$data['QUESTIONARIO_idQUESTIONARIO'])->result();
			foreach($ano as $a) {
				$data['ANO'] = $a->ANO;		
			}								
					
			
			$item = $this->input->get_post('turma');
			if(!empty($item)) {
				$qtd = count($item);
			}
			
			$bool = false;
			
			for ($i = 0; $i < $qtd; $i++) {
					if(!empty($item[$i])) {
						foreach($ano as $a) {
							$data['ANO'] = $a->ANO;		
						}								

						$query = $this->db->query('select QUESTIONARIO_has_TURMA.QUESTIONARIO_idQUESTIONARIO from QUESTIONARIO_has_TURMA 
																										where QUESTIONARIO_has_TURMA.QUESTIONARIO_idQUESTIONARIO = '.$data['QUESTIONARIO_idQUESTIONARIO'].' 
																										and QUESTIONARIO_has_TURMA.TURMA_idTURMA = '.$item[$i].' 
																										and QUESTIONARIO_has_TURMA.ANO = '.$data['ANO']);
						if ($query->num_rows() == 0) {
							$data['TURMA_idTURMA'] = $item[$i];
							$this->db->insert('QUESTIONARIO_has_TURMA', $data);						
							$this->associacaoMUTQ($data);		
						} else {
							$bool = true;						
						}			
					}
			}			
			
			if ($bool == true) {
                echo '<script type="text/javascript">confirm("Alguma turma escolhida já foi relacionada a esse questionário.");</script>';			
			}
			$this->index();

		}

		public function excluirPergunta($idPe) {
			$idP = base64_decode($idPe);			
			
			$this->db->select('idPERGUNTA');
			$this->db->from('PERGUNTA');
			$this->db->where('idPERGUNTA', $idP);
			
			if($this->db->delete('PERGUNTA')) {
				redirect('Questionario/index');
			} else {
				echo "Exclusão impossibilitada";
			}
			
		}


    }
