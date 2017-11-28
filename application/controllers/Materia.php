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
			$this->parser->parse('ajax', $data);
			$this->parser->parse('telaAdm', $data);
		}

		
		// Início de chamada de view



		public function v_cadastrar_materias(){
			$data['TURMA'] = $this->db->get('TURMA')->result();
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Materia/cadastro_materias', $data);
		}		
		
		public function v_listar_materias(){
			$data['MATERIA'] = $this->db->get('MATERIA')->result();
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Materia/listar_materias', $data);
		}
		
		public function v_editar($ide) {
			$id = base64_decode($ide);

			$this->db->where('idMATERIA', $id);
			$data['MATERIA'] = $this->db->get('MATERIA')->result();
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Materia/editar_materias', $data);
		}
		
		public function v_associar_materias() {
			$data['MATERIA'] = $this->db->get('MATERIA')->result();
			
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Materia/listar_materiasII', $data);
		}
		
		public function v_associar($ide) {
			$id = base64_decode($ide);
						
			$this->db->where('idMATERIA', $id);
			$data['MATERIA'] = $this->db->get('MATERIA')->result();
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
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
			$this->parser->parse('ajax', $data);
			$this->parser->parse('telaAdm', $data);
		}
		
		
		public function associar() {
			
			$data['MATERIA_idMATERIA'] = $this->input->post('idMATERIA');
			$data['ANO'] = $this->input->post('txt_ano');
			$item = $this->input->get_post('turma');
			if(!empty($item)) {
				$qtd = count($item);
			}

			$bool = false;
			
			for ($i = 0; $i < $qtd; $i++) {
					if(!empty($item[$i])) {
						
						$query = $this->db->query('select TURMA_has_MATERIA.MATERIA_idMATERIA from TURMA_has_MATERIA where TURMA_has_MATERIA.MATERIA_idMATERIA = '.$data['MATERIA_idMATERIA'].' 
																						and TURMA_has_MATERIA.TURMA_idTURMA = '.$item[$i].' 
																						and TURMA_has_MATERIA.ANO = '.$data['ANO']);			

						if ($query->num_rows() == 0) {
							$data['TURMA_idTURMA'] = $item[$i];
							$this->db->insert('TURMA_has_MATERIA', $data);
						}	else {
							$bool = true;
						}
						
					}				
			}
		
			if ($bool == true) {
				echo '<script type="text/javascript">confirm("Alguma turma selecionada já foi relacionada à essa matéria.");</script>';
			}
			$this->v_associar_materias();
		}
		
    }
