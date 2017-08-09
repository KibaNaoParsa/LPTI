<?php

    class Materia extends CI_Controller {


        public function __construct() {
            parent::__construct();
			$this->load->library('session');
			if(!$this->session->userdata('login')){
				$this->load->view('login');
			}
        }

		public function v_cadastrar_materias(){
			$data['TURMA'] = $this->db->get('TURMA')->result();
			$data['url'] = base_url();
			$this->parser->parse('cadastro_materias', $data);
		}

		public function cadastro_materias(){
			$data['NOME'] = $this->input->post('txt_materia');
			$data['QTD_AULAS'] = $this->input->post('txt_qtd');
			$this->db->insert('MATERIA', $data);
			
			$data['url'] = base_url();
			$this->parser->parse('telaAdm', $data);
		}
		
		
		public function v_listar_materias(){
			$data['MATERIA'] = $this->db->get('MATERIA')->result();
			$data['url'] = base_url();
			$this->parser->parse('listar_materias', $data);
		}
		
		public function v_editar($id) {
			$this->db->where('idMATERIA', $id);
			$data['MATERIA'] = $this->db->get('MATERIA')->result();
			$data['url'] = base_url();
			$this->parser->parse('editar_materias', $data);
		}
		

    }
