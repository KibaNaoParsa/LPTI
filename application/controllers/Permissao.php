<?php

    class Permissao extends CI_Controller {


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

        public function v_tela_listagem() {
            $data['USUARIO'] = $this->db->get('USUARIO')->result();
            $data['url'] = base_url();
            $this->parser->parse('Permissao/tela_listagem', $data);
        }
    
		public function v_selecao($id) {
			$this->db->where('idUSUARIO', $id);
			$data['USUARIO'] = $this->db->get('USUARIO')->result();
			$data['TURMA'] = $this->db->get('TURMA')->result();
			
			
			$data['url'] = base_url();
			$this->parser->parse('Permissao/selecao', $data);
		}

		public function v_selecaoII($idUSUARIO, $idTURMA) {
			
//			$data['CURSO'] = $this->db->get('CURSO')->result();
			$this->db->where('idUSUARIO', $idUSUARIO);
			
			
			$data['USUARIO'] = $this->db->get('USUARIO')->result();
			$this->db->where('idTURMA', $idTURMA);
			$data['TURMA'] = $this->db->get('TURMA')->result();

			$this->db->where('TURMA_idTURMA', $idTURMA);
			
			
			$data['TURMA_has_MATERIA'] = $this->db->get('TURMA_has_MATERIA')->result();
			
//			$this->db->select('NOME');
//    		$this->db->from('TURMA');
//			$this->db->join('CURSO', 'CURSO.idCURSO = TURMA.idCURSO');
//			$query = $this->db->get();

			
			$data['url'] = base_url();
			$this->parser->parse('Permissao/selecaoII', $data);
		}





        // Fim de chamada de view


		public function associar() {
			$data['USUARIO_idUSUARIO'] = $this->input->post('idUSUARIO');
			$data['TURMA_idTURMA'] = $this->input->post('idTURMA');
			$idusu = $this->input->post('idUSUARIO');
			$item = $this->input->get_post('mut');
			if(!empty($item)) {
				$qtd = count($item);
			}
			
			for ($i = 0; $i < $qtd; $i++) {
					if(!empty($item[$i])) {
						$data['MATERIA_idMATERIA'] = $item[$i];
						$this->db->insert('MUT', $data);
					}
			}
			
			
			$this->v_selecao($idusu);

		
		
			
		}
		
		


    }

