<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Aprovacao extends CI_Controller {
    
        public function __construct() {
            parent::__construct();
			if(!$this->session->userdata('login')){
				$this->load->view('login');
			}
        }

		public function index() {
			$this->db->select('CURSO.idCURSO, CURSO.NOME, TURMA.SERIE, TURMA.idTURMA, MODALIDADE.MODALIDADE');
			$this->db->from('CURSO');
			$this->db->join('TURMA', 'CURSO.idCURSO=TURMA.idCURSO', 'inner');
			$this->db->join('MODALIDADE', 'CURSO.MODALIDADE = MODALIDADE.idMODALIDADE', 'inner');
			$this->db->where('CURSO.idCURSO !=', 99);
			$this->db->distinct();
			$data['TURMA'] = $this->db->get()->result();
			
			
			$data['url'] = base_url();
			$this->parser->parse('ajaxEst', $data);
			$this->parser->parse('Aprovacao/listar', $data);
		}
		
		public function v_telaAlunos() {
			
			
			$this->db->select('CURSO.NOME, TURMA.SERIE, TURMA.idTURMA, MODALIDADE.MODALIDADE');
			$this->db->from('CURSO');
			$this->db->join('TURMA', 'CURSO.idCURSO=TURMA.idCURSO', 'inner');
			$this->db->join('MODALIDADE', 'CURSO.MODALIDADE = MODALIDADE.idMODALIDADE', 'inner');
			$this->db->where('CURSO.idCURSO !=', 99);
			$this->db->distinct();
			$data['TURMA'] = $this->db->get()->result();

			$item = $this->input->get_post('turma');	
	
			if(!empty($item)) {
				$qtd = count($item);
			}
			
			for ($i = 0; $i < $qtd; $i++) {
				$idTURMA = $item[$i];
			}
			
			$this->db->select("ALUNO.idALUNO, ALUNO.NOME");
			$this->db->from("ALUNO");
			$this->db->join("TURMA_has_ALUNO", "ALUNO.idALUNO = TURMA_has_ALUNO.ALUNO_idALUNO", 'inner');
			$this->db->where('TURMA_has_ALUNO.TURMA_idTURMA', $idTURMA);
			$this->db->where('TURMA_has_ALUNO.ANO', date("Y"));
			$this->db->order_by('ALUNO.NOME', 'asc');
			$data['ALUNO'] = $this->db->get()->result();
			
			$data['idTURMA'] = $idTURMA;
			
			$data['url'] = base_url();
			
			$this->parser->parse('ajaxEst', $data);
			$this->parser->parse('Aprovacao/alunos', $data);
			
			
			
		}
		
		public function moverAlunos() {
			$item = $this->input->get_post('turma');	
	
			if(!empty($item)) {
				$qtd = count($item);
			}
			
			for ($i = 0; $i < $qtd; $i++) {
				$idTURMA = $item[$i];
			}
			
			$dat['TURMA_idTURMA'] = $idTURMA;
			$dat['ANO'] = $this->input->post("txt_ano");
			
			
			$alunos = $this->input->get_post('aluno');
			if(!empty($item)) {
				$qtd = count($alunos);
			}
			
			for ($i = 0; $i < $qtd; $i++) {
					if(!empty($alunos[$i])) {
						$dat['ALUNO_idALUNO'] = $alunos[$i];
						$this->db->insert('TURMA_has_ALUNO', $dat);
						
						
						if ($dat['TURMA_idTURMA'] == 99) {
							$this->db->update('ALUNO.SITUACAO', 1);
							$this->db->from('ALUNO');
							$this->db->where('ALUNO.idALUNO', $dat['ALUNO_idALUNO']);
						}
					}
			}
			
			$this->index();
		}


}

