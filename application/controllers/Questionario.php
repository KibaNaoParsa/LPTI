<?php defined('BASEPATH') or exit('No direct script access allowed.');

    class Questionario extends CI_Controller {

        public function __construct() {
            parent::__construct();
			$this->load->library('session');
			if(!$this->session->userdata('login')){
//				$this->load->view('login');
			}
        }

		public function index() {
			$data['url'] = base_url();
			$this->parser->parse('telaAdm', $data);
		}


		// Início de chamada de view
		
		
		public function v_cadastro() {
			$data['url'] = base_url();
			$this->parser->parse('Questionario/cadastro', $data);
		}
		
		
		public function v_listar() {
			$data['QUESTIONARIO'] = $this->db->get('QUESTIONARIO')->result();
			
			
			$data['url'] = base_url();
			$this->parser->parse('Questionario/listar', $data);
		}
		
		public function v_editar($id) {
			$this->db->where('idQUESTIONARIO', $id);
			$data['QUESTIONARIO'] = $this->db->get('QUESTIONARIO')->result();
			
			$this->db->where('idQUESTIONARIO', $id);
			$data['DIMENSAO'] = $this->db->get('DIMENSAO')->result();
			
			
			$data['url'] = base_url();
			
			$this->parser->parse('Questionario/editar', $data);
		}
		
		
		
		// Fim de chamada de view
		
		public function criar() {
		
			$data['NOME'] = $this->input->post('txt_nome');
			$this->db->insert('QUESTIONARIO', $data);
			
			$data['url'] = base_url();
			$this->parser->parse('telaAdm', $data);
		}
        
        
        public function editarNome() {
		
			$idusu = $this->input->post('id');
			
			$data['NOME'] = $this->input->post('txt_nome');
			$this->db->where('idQUESTIONARIO', $idusu);
			
			$this->db->update('QUESTIONARIO', $data);

			$this->v_editar($idusu);

			
		}
		
		
		public function dimensao() {
		
			$idusu = $this->input->post('id');
			
			$data['idQUESTIONARIO'] = $idusu;
			$data['DESCRICAO'] = $this->input->post('txt_dimensao');
			$this->db->insert('DIMENSAO', $data);
			
			$this->v_editar($idusu);
		
			
		}
        
        
        
    }
