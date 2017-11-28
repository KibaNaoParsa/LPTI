<?php defined('BASEPATH') or exit('No direct script access allowed.');

    class Permissao extends CI_Controller {


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

        public function v_tela_listagem() {
				$this->db->where('USUARIO.TIPO', 5);
            $data['USUARIO'] = $this->db->get('USUARIO')->result();
            $data['url'] = base_url();
            $this->parser->parse('ajax', $data);
            $this->parser->parse('Permissao/tela_listagem', $data);
        }
    
		public function v_selecao($ide) {
			$id = base64_decode($ide);			
			
			$this->db->select('CURSO.NOME, TURMA.SERIE, TURMA.idTURMA, MODALIDADE.MODALIDADE');
			$this->db->from('CURSO');
			$this->db->join('TURMA', 'CURSO.idCURSO=TURMA.idCURSO', 'inner');
			$this->db->join('MODALIDADE', 'CURSO.MODALIDADE = MODALIDADE.idMODALIDADE', 'inner');
			$this->db->where('CURSO.idCURSO !=', 99);

			$this->db->distinct();
			$data['TURMA'] = $this->db->get()->result();
		
			$this->db->where('idUSUARIO', $id);
			
		
			$data['USUARIO'] = $this->db->get('USUARIO')->result();
			//$data['TURMA'] = $this->db->get('TURMA')->result();
			
			
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Permissao/selecao', $data);
		}

		public function v_selecaoII($idUSUARIOe, $idTURMAe) {
			$idUSUARIO = base64_decode($idUSUARIOe);
			$idTURMA = base64_decode($idTURMAe);


			$this->db->select('MATERIA.NOME');
			$this->db->from('MATERIA');
			$this->db->join('TURMA_has_MATERIA', 'TURMA_has_MATERIA.MATERIA_idMATERIA=MATERIA.idMATERIA', 'inner');
			$this->db->distinct();
			$data['NOME'] = $this->db->get()->result();


			
			$this->db->where('idUSUARIO', $idUSUARIO);
			
			
			$data['USUARIO'] = $this->db->get('USUARIO')->result();
			$this->db->where('idTURMA', $idTURMA);
			$data['TURMA'] = $this->db->get('TURMA')->result();

			$this->db->where('TURMA_idTURMA', $idTURMA);
			
			
			$data['TURMA_has_MATERIA'] = $this->db->get('TURMA_has_MATERIA')->result();

			
			$data['url'] = base_url();
			$this->parser->parse('ajax', $data);
			$this->parser->parse('Permissao/selecaoII', $data);
		}

        // Fim de chamada de view


		public function associar() {
			$data['USUARIO_idUSUARIO'] = $this->input->post('idUSUARIO');
			$data['TURMA_idTURMA'] = $this->input->post('idTURMA');
			$data['ANO'] = $this->input->post('txt_ano');
			$idusu = $this->input->post('idUSUARIO');
			$item = $this->input->get_post('mut');
			if(!empty($item)) {
				$qtd = count($item);
			}

			$bool = false;
			
			for ($i = 0; $i < $qtd; $i++) {
					if(!empty($item[$i])) {

						$query = $this->db->query('select MUT.USUARIO_idUSUARIO from MUT where MUT.USUARIO_idUSUARIO = '.$data['USUARIO_idUSUARIO'].' 
																												and MUT.TURMA_idTURMA = '.$data['TURMA_idTURMA'].' 
																												and MUT.MATERIA_idMATERIA = '.$item[$i].' 
																												and MUT.ANO = '.$data['ANO']);
						if ($query->num_rows() == 0) {
							$data['MATERIA_idMATERIA'] = $item[$i];
							$this->db->insert('MUT', $data);
						} else {
							$bool = true;
						}
					}
			}
			
			if ($bool == true) {
		   	echo '<script type="text/javascript">confirm("Alguma matéria escolhida já foi relacionada ao usuário.");</script>';
			}

			$idusue = base64_encode($idusu);			
			$this->v_selecao($idusue);			
		}
		
}

