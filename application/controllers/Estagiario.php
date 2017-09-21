<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Estagiario extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			if(!$this->session->userdata('login')){
					$this->load->view('login');
			}
		}	
		
		public function aluCad(){
			$data['url'] = base_url();
			$this->parser->parse('aluno', $data);
		}
		
		public function aluCadMassa(){
			$data['url'] = base_url();
			$this->parser->parse('alunomassa', $data);
		}		

		
		public function aluno(){
			$data['idALUNO'] = $this->input->post('txt_matricula');
			$data['NOME'] = $this->input->post('txt_nome');
			$dat['TURMA_idTURMA'] = $this->input->post('Turma');
			$dat['ALUNO_idALUNO'] = $data['idALUNO'];
			$dat['ANO'] = $this->input->post('txt_ano');
			if(($data['idALUNO'] <= 100000000000) or ($data['NOME'] == "") or ($dat['TURMA_idTURMA'] == "") or ($dat['ANO'] == "")){
				$da['modal'] = "$(window).on('load',function(){
							  $('#erro-modal').modal('show');
							  });";
				$da['url'] = base_url();
				$this->parser->parse('aluno', $da);
			}
			else{
				$da['modal'] = " ";
				$this->db->insert('ALUNO', $data);
				$this->db->insert('TURMA_has_ALUNO', $dat);
				redirect("Estagiario/aluCad");
			}
			
		}

		public function alunomassa(){
			$alunos = $this->input->post('txt_texto');
			$data['TURMA_idTURMA'] = $this->input->post('Turma');
			$data['ANO'] = $this->input->post('txt_ano');

			$aluno = explode(";", $alunos);
			
			foreach ($aluno as $a) {
				
				$divorcio = explode(":", $a);
				
				$dat['idALUNO'] = $divorcio[0];
				$dat['NOME'] = $divorcio[1];
				$data['ALUNO_idALUNO'] = $dat['idALUNO'];	
								
				if(($dat['idALUNO'] <= 100000000000) or ($dat['NOME'] == "") or ($data['TURMA_idTURMA'] == "") or ($data['ANO'] == "")){
					$da['modal'] = "$(window).on('load',function(){
						  $('#erro-modal').modal('show');
						  });";
					$da['url'] = base_url();
					$this->parser->parse('aluno', $da);
				}else{
					$da['modal'] = " ";
					$this->db->insert('ALUNO', $dat);
					$this->db->insert('TURMA_has_ALUNO', $data);					
				}				
			}	
			
			
			
			/*
			for($i = 0; $i < count($aluno)-1; $i++) {
				if($i == 0 || $i % 2 ==0) {			
					$dat['idALUNO'] = $aluno[$i];
					$dat['NOME'] = $aluno[$i+1];
					$data['ALUNO_idALUNO'] = $dat['idALUNO'];	
								
					if(($dat['idALUNO'] <= 100000000000) or ($dat['NOME'] == "") or ($data['TURMA_idTURMA'] == "") or ($data['ANO'] == "")){
						$da['modal'] = "$(window).on('load',function(){
							  $('#erro-modal').modal('show');
							  });";
						$da['url'] = base_url();
						$this->parser->parse('aluno', $da);
					}else{
						$da['modal'] = " ";
						$this->db->insert('ALUNO', $dat);
						$this->db->insert('TURMA_has_ALUNO', $data);
						unset($dat['idALUNO']);
						unset($data['ALUNO_idALUNO']);						
					}				
				}
				
			}
			*/		
			
			redirect("Login/loginAsEst");						
			
			}
			
		
		public function aluno2(){
			$data['idALUNO'] = $this->input->post('txt_matricula');
			$data['NOME'] = $this->input->post('txt_nome');
			$dat['TURMA_idTURMA'] = $this->input->post('Turma');
			$dat['ALUNO_idALUNO'] = $data['idALUNO'];
			$dat['ANO'] = $this->input->post('txt_ano');
			if(($data['idALUNO'] <= 100000000000) or ($data['NOME'] == "") or ($dat['TURMA_idTURMA'] == "") or ($dat['ANO'] == "")){
				$da['modal'] = "$(window).on('load',function(){
							  $('#erro-modal').modal('show');
							  });";
				$da['url'] = base_url();
				$this->parser->parse('aluno', $da);
			}
			else{
				$da['modal'] = " ";
				$this->db->insert('ALUNO', $data);
				$this->db->insert('TURMA_has_ALUNO', $dat);
				redirect("Estagiario/aEdit/".$dat['TURMA_idTURMA']."/".$dat['ANO']);
			}
			
		}
		
		public function notCad(){
			$this->db->select('TURMA.idTURMA, TURMA.SERIE, TURMA_has_ALUNO.ANO, TURMA.idCURSO');
			$this->db->from('TURMA');
			$this->db->join('TURMA_has_ALUNO', 'TURMA.idTURMA = TURMA_has_ALUNO.TURMA_idTURMA', 'right');
			$this->db->distinct();
			$data['TURMA'] = $this->db->get()->result();
			$data['url'] = base_url();
			$this->parser->parse('nota', $data);
		}
		
		public function notInsert($id, $ano){
			$data['url'] = base_url();
			$this->db->select('MATERIA.idMATERIA, MATERIA.NOME, TURMA_has_MATERIA.TURMA_idTURMA, TURMA_has_MATERIA.MATERIA_idMATERIA, TURMA_has_MATERIA.ANO');
			$this->db->from('TURMA_has_MATERIA');
			$this->db->join('MATERIA', 'MATERIA.idMATERIA = TURMA_has_MATERIA.MATERIA_idMATERIA', 'right');
			$this->db->distinct();
			$this->db->where('TURMA_has_MATERIA.TURMA_idTURMA', $id);
			$this->db->where('TURMA_has_MATERIA.ANO', $ano);
			$data['materia'] = $this->db->get()->result();
			$this->parser->parse('notas', $data);
		}
		
		public function nota($id, $ano){
			$notas = explode(',', $this->input->post('txt_notas'));
			$materia = (string)$this->input->post('txt_materia');
			$bimestre = (string)$this->input->post('txt_bim');
			$this->db->select('TURMA_has_ALUNO.ALUNO_idALUNO, ALUNO.idALUNO, ALUNO.NOME');
			$this->db->from('TURMA_has_ALUNO');
			$this->db->join('ALUNO', 'TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO');
			$this->db->where('TURMA_idTURMA', $id);
			$this->db->order_by('ALUNO.NOME', 'ASC');
			$nomes = $this->db->get()->result();
			if(count($notas)==count($nomes)){
				for($i = 0; $i<count($notas); $i++){
					$data['NOTA'] = $notas[$i];
					$data['idALUNO'] = $nomes[$i]->ALUNO_idALUNO;
					$data['idMATERIA'] = $materia;
					$data['BIMESTRE'] = $bimestre;
					$this->db->insert('NOTA', $data);
				}
				redirect('Estagiario/notInsert/'.$id.'/'.$ano);
			}
			else{
				echo '<script type="text/javascript">alert("A quantidade de notas é diferente da quantidade de alunos");</script>';
			}
		}
		
		public function aluEdit(){
			$this->db->select('TURMA.idTURMA, TURMA.SERIE, TURMA_has_ALUNO.ANO, TURMA.idCURSO');
			$this->db->from('TURMA');
			$this->db->join('TURMA_has_ALUNO', 'TURMA.idTURMA = TURMA_has_ALUNO.TURMA_idTURMA', 'right');
			$this->db->distinct();
			$data['TURMA'] = $this->db->get()->result();
			$data['url'] = base_url();
			$this->parser->parse('aEditar', $data);
		}
		
		public function aEdit($id, $ano){
			$this->db->select('TURMA_has_ALUNO.TURMA_idTURMA, TURMA_has_ALUNO.ALUNO_idALUNO, ALUNO.NOME, TURMA_has_ALUNO.TURMA_idTURMA, TURMA_has_ALUNO.ANO');
			$this->db->from('ALUNO');
			$this->db->join('TURMA_has_ALUNO', 'ALUNO.idALUNO = TURMA_has_ALUNO.ALUNO_idALUNO', 'inner');
			$this->db->where('TURMA_has_ALUNO.TURMA_idTURMA', $id);
			$this->db->where('TURMA_has_ALUNO.ANO', $ano);
			$data['TURMA_has_ALUNO'] = $this->db->get()->result();
			$data['url'] = base_url();
			$this->parser->parse('aEditor', $data);
		}
		
		public function aExcluir($id, $turma, $ano){
			$this->db->where('TURMA_has_ALUNO.ALUNO_idALUNO', $id);
			$this->db->delete('TURMA_has_ALUNO');
			redirect("Estagiario/aEdit/".$turma."/".$ano);
		}
	
	public function freqCad(){
			$this->db->select('TURMA.idTURMA, TURMA.SERIE, TURMA_has_ALUNO.ANO, TURMA.idCURSO');
			$this->db->from('TURMA');
			$this->db->join('TURMA_has_ALUNO', 'TURMA.idTURMA = TURMA_has_ALUNO.TURMA_idTURMA', 'right');
			$this->db->distinct();
			$data['TURMA'] = $this->db->get()->result();
			$data['url'] = base_url();
			$this->parser->parse('freq', $data);
		}
		
		public function freqInsert($id, $ano, $error){
			if($error == 1){
				echo '<script type="text/javascript">alert("A frequência não pode ser maior ");</script>';
			}
			else{
				$this->db->select('MATERIA.idMATERIA, MATERIA.NOME, TURMA_has_MATERIA.TURMA_idTURMA, TURMA_has_MATERIA.MATERIA_idMATERIA, TURMA_has_MATERIA.ANO');
				$this->db->from('TURMA_has_MATERIA');
				$this->db->join('MATERIA', 'MATERIA.idMATERIA = TURMA_has_MATERIA.MATERIA_idMATERIA', 'right');
				$this->db->distinct();
				$this->db->where('TURMA_has_MATERIA.TURMA_idTURMA', $id);
				$this->db->where('TURMA_has_MATERIA.ANO', $ano);
				$data['materia'] = $this->db->get()->result();
			}
			$data['url'] = base_url();
			$this->parser->parse('freqs', $data);
		}
		
		public function freq($id, $ano){
			$freq = explode(',', $this->input->post('txt_freq'));
			$materia = (string)$this->input->post('txt_materia');
			$bimestre = (string)$this->input->post('txt_bim');
			$this->db->select('TURMA_has_ALUNO.ALUNO_idALUNO, ALUNO.idALUNO, ALUNO.NOME');
			$this->db->from('TURMA_has_ALUNO');
			$this->db->join('ALUNO', 'TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO');
			$this->db->where('TURMA_has_ALUNO.TURMA_idTURMA', $id);
			$this->db->where('TURMA_has_ALUNO.ANO', $ano);
			$this->db->order_by('ALUNO.NOME', 'ASC');
			$nomes = $this->db->get()->result();
			if(count($freq)==count($nomes)){
				for($i = 0; $i<count($freq); $i++){
					$data['FALTAS'] = $freq[$i];
					if($data['FALTAS'] > 100 or $data['FALTAS'] < 0){
						redirect('Estagiario/freqInsert/'.$id.'/'.$ano.'/1');
					}
					$data['idALUNO'] = $nomes[$i]->ALUNO_idALUNO;
					$data['idMATERIA'] = $materia;
					$data['BIMESTRE'] = $bimestre;
					$this->db->insert('FREQUENCIA', $data);
				}
				redirect('Estagiario/freqInsert/'.$id.'/'.$ano);
			}
			else{
				echo '<script type="text/javascript">alert("A quantidade de notas é diferente da quantidade de alunos");</script>';
			}
		}
	}
//form_dropdown([$name = ''[, $options = array()[, $selected = array()[, $extra = '']]]])
