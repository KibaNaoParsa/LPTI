<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Coord extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			if(!$this->session->userdata('login')){
					$this->load->view('login');
			}
		}	
		
		public function parametros(){
			$data['url'] = base_url();
			$tipo = $this->session->userdata('tipo');
			$this->db->select('*');
			$this->db->from('PARAMETRO_DE_RISCO');
			if($tipo == 6){
				$this->db->where('PARAMETRO_DE_RISCO.idTURMA <' ,40);
				$data['parametro'] = $this->db->get()->result();
				$this->db->select('*');
				$this->db->from('PARAMETRO_DE_RISCO');
				$this->db->where('PARAMETRO_DE_RISCO.idTURMA <' ,0);
				$data['parametros'] = $this->db->get()->result();
			}
			else{
				$this->db->where('PARAMETRO_DE_RISCO.idTURMA', $tipo . '1');
				$this->db->or_where('PARAMETRO_DE_RISCO.idTURMA', $tipo . '2');
				$this->db->or_where('PARAMETRO_DE_RISCO.idTURMA', $tipo . '3');
				$data['parametro'] = $this->db->get()->result();
				$tipo+=3;
				$this->db->select('*');
				$this->db->from('PARAMETRO_DE_RISCO');
				$this->db->where('PARAMETRO_DE_RISCO.idTURMA', $tipo . '1');
				$this->db->or_where('PARAMETRO_DE_RISCO.idTURMA', $tipo . '2');
				$this->db->or_where('PARAMETRO_DE_RISCO.idTURMA', $tipo . '3');
				$data['parametros'] = $this->db->get()->result();
			}
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('Coordenador/addParametro', $data);
		}
		
		public function parametro(){
			
		}
		
		public function criarParametro($tipo){
			$data['url'] = base_url();
			
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('Coordenador/insereParametro', $data);
		}
		
		public function insereParametro(){
			$data['NOTA'] = $this->input->post('txt_nota');
			$data['FREQUENCIA'] = $this->input->post('txt_freq');
			$data['MATERIAS'] = $this->input->post('txt_materias');
			$turmas = $this->input->post('txt_mod');
			
			$this->db->select('*');
			$this->db->from('PARAMETRO_DE_RISCO');
			if($turmas == 1){
				$data['idTURMA'] = $this->session->userdata('tipo') . '1';
				$this->db->insert('PARAMETRO_DE_RISCO', $data);
				$data['idTURMA'] = $this->session->userdata('tipo') . '2';
				$this->db->insert('PARAMETRO_DE_RISCO', $data);
				$data['idTURMA'] = $this->session->userdata('tipo') . '3';
				$this->db->insert('PARAMETRO_DE_RISCO', $data);
			}
			else{
				$data['idTURMA'] = 3+$this->session->userdata('tipo') . '1';
				$this->db->insert('PARAMETRO_DE_RISCO', $data);
				$data['idTURMA'] = 3+$this->session->userdata('tipo') . '2';
				$this->db->insert('PARAMETRO_DE_RISCO', $data);
			}
			
			redirect(base_url('coord/parametros'));
		}
		
		public function editarParametro($id){
			$data['url'] = base_url();
			
			$this->db->select('*');
			$this->db->from('PARAMETRO_DE_RISCO');
			$this->db->where('PARAMETRO_DE_RISCO.idPARAMETRO_DE_RISCO', $id);
			$data['PARAMETRO'] = $this->db->get()->result();
			
			$this->parser->parse('ajaxCoord', $data);
			$this->parser->parse('Coordenador/editarParametro', $data);
		}
		
		public function editaParametro(){
			$data['idPARAMETRO_DE_RISCO'] = $this->input->post('txt_id');
			$data['NOTA'] = $this->input->post('txt_nota');
			$data['FREQUENCIA'] = $this->input->post('txt_freq');
			$data['MATERIAS'] = $this->input->post('txt_materias');
			$this->db->select('*');
			$this->db->from('PARAMETRO_DE_RISCO');
			$this->db->where('PARAMETRO_DE_RISCO.idPARAMETRO_DE_RISCO', $data['idPARAMETRO_DE_RISCO']);
			if($this->db->update('PARAMETRO_DE_RISCO', $data)){
				echo '<script type="text/javascript">alert("Atualização concluída");
						location.href = "http://localhost/LPTI/login/telaInicial/";</script>';
			}
			else{
				echo '<script type="text/javascript">alert("Algo deu errado");
						location.href = "http://localhost/LPTI/login/telaInicial";</script>';
			}
			$data['url'] = base_url();
		}
		
		public function apagarParametro($id){
			$this->db->where('idPARAMETRO_DE_RISCO', $id);
			$this->db->delete('PARAMETRO_DE_RISCO');
			
			redirect(base_url('Login/telaInicial'));
		}	
	}
