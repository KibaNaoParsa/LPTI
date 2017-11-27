<?php defined('BASEPATH') or exit('No direct script access allowed.');

    class Materia extends CI_Controller {


        public function __construct() {
            parent::__construct();
			if(!$this->session->userdata('login')){
				$this->load->view('login');
			}
        }

		public function index() {
			$data['url'] = base_url();
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('telaCoord', $data);
		}

		
		// Início de chamada de view



		public function v_cadastrar_materias(){
			$this->db->select('*');
			$this->db->from('TURMA');
			$this->db->where('TURMA.idCURSO', $this->session->userdata('tipo'));
			$data['TURMA'] = $this->db->get()->result();
			$data['url'] = base_url();
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('Materia/cadastro_materias', $data);
		}		
		
		public function v_listar_materias(){
			if($this->session->userdata('tipo') != 6){
				$mod = $this->session->userdata('tipo')+3;
				$sql = "SELECT MATERIA.idMATERIA, MATERIA.NOME, MATERIA.QTD_AULAS, CURSO.idCURSO FROM MATERIA\n"
				. "INNER JOIN TURMA_has_MATERIA ON TURMA_has_MATERIA.MATERIA_idMATERIA = MATERIA.idMATERIA\n"
				. "INNER JOIN TURMA ON TURMA.idTURMA = TURMA_has_MATERIA.TURMA_idTURMA\n"
				. "INNER JOIN CURSO ON CURSO.idCURSO = TURMA.idCURSO\n"
				. "WHERE CURSO.idCURSO = " . $this->session->userdata('tipo')
				. " OR CURSO.idCURSO = " . $mod;
				$data['MATERIA'] = $this->db->query($sql)->result();
				
			}
			else{
				$sql = "SELECT MATERIA.idMATERIA, MATERIA.NOME, MATERIA.QTD_AULAS, CURSO.idCURSO FROM MATERIA\n"
				. "INNER JOIN TURMA_has_MATERIA ON TURMA_has_MATERIA.MATERIA_idMATERIA = MATERIA.idMATERIA\n"
				. "INNER JOIN TURMA ON TURMA.idTURMA = TURMA_has_MATERIA.TURMA_idTURMA\n"
				. "INNER JOIN CURSO ON CURSO.idCURSO = TURMA.idCURSO\n"
				. "WHERE TURMA.MODALIDADE <> 2";
				$data['MATERIA'] = $this->db->query($sql)->result();
			}
			$data['url'] = base_url();
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('Materia/listar_materias', $data);
		}
		
		public function v_editar($id) {
			$this->db->where('idMATERIA', $id);
			$data['MATERIA'] = $this->db->get('MATERIA')->result();
			$data['url'] = base_url();
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('Materia/editar_materias', $data);
		}
		
		public function v_associar_materias() {
			if($this->session->userdata('tipo') != 6){
				$mod = $this->session->userdata('tipo')+3;
				$sql = "SELECT MATERIA.idMATERIA, MATERIA.NOME, MATERIA.QTD_AULAS, CURSO.idCURSO FROM MATERIA\n"
				. "INNER JOIN TURMA_has_MATERIA ON TURMA_has_MATERIA.MATERIA_idMATERIA = MATERIA.idMATERIA\n"
				. "INNER JOIN TURMA ON TURMA.idTURMA = TURMA_has_MATERIA.TURMA_idTURMA\n"
				. "INNER JOIN CURSO ON CURSO.idCURSO = TURMA.idCURSO\n"
				. "WHERE CURSO.idCURSO = " . $this->session->userdata('tipo')
				. " OR CURSO.idCURSO = " . $mod;
				$data['MATERIA'] = $this->db->query($sql)->result();
				
			}
			else{
				$sql = "SELECT MATERIA.idMATERIA, MATERIA.NOME, MATERIA.QTD_AULAS, CURSO.idCURSO FROM MATERIA\n"
				. "INNER JOIN TURMA_has_MATERIA ON TURMA_has_MATERIA.MATERIA_idMATERIA = MATERIA.idMATERIA\n"
				. "INNER JOIN TURMA ON TURMA.idTURMA = TURMA_has_MATERIA.TURMA_idTURMA\n"
				. "INNER JOIN CURSO ON CURSO.idCURSO = TURMA.idCURSO\n"
				. "WHERE TURMA.MODALIDADE <> 2";
				$data['MATERIA'] = $this->db->query($sql)->result();
			}
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Materia/listar_materiasII', $data);
		}
		
		public function v_associar($id) {
			$this->db->where('idMATERIA', $id);
			$data['MATERIA'] = $this->db->get('MATERIA')->result();
			$data['url'] = base_url();
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('Materia/associar_materias', $data);
		}
		
		// Fim de chamada de view
		
		
		public function cadastro_materias(){
			$data['NOME'] = $this->input->post('txt_materia');
			$data['QTD_AULAS'] = $this->input->post('txt_qtd');
			$this->db->insert('MATERIA', $data);
			
			$codigo = $this->db->query("SELECT idMATERIA from MATERIA ORDER BY idMATERIA desc limit 1")->result();
			
			foreach($codigo as $c) {
				$this->v_associar($c->idMATERIA);			
			}
			
		}
		
		public function editar() {

			$data['NOME'] = $this->input->post('txt_nome');
			$data['QTD_AULAS'] = $this->input->post('txt_qtd');

			$this->db->where('idMATERIA', $this->input->post('idMATERIA'));

			$this->db->update('MATERIA', $data);
			$data['url'] = base_url();
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('telaCoord', $data);
		}
		
		
		public function associar() {
			
			$data['MATERIA_idMATERIA'] = $this->input->post('idMATERIA');
			$data['ANO'] = $this->input->post('txt_ano');
			$item = $this->input->get_post('turma');
			if(!empty($item)) {
				$qtd = count($item);
			}
			
			for ($i = 0; $i < $qtd; $i++) {
					if(!empty($item[$i])) {
						$data['TURMA_idTURMA'] = $item[$i];
						$this->db->insert('TURMA_has_MATERIA', $data);
					}
			}
			
			redirect("Materia/v_listar_materias");
			
		}
		
    }
