									<style>
.dropbtn {
    background-color: #add8e6;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #add8e6;
}
</style>       

          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Questionários</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		        	<div class="col-lg-12 col-md-12" id="btn">
									<?php			
										echo '<div class="dropdown">
  													<button class="dropbtn">QUESTIONÁRIO</button>
  													<div class="dropdown-content">';
										echo '<a href="{url}Professor/v_drop/'.base64_encode(0).'/'.base64_encode(0).'/'.base64_encode(0).'/'.base64_encode($idUSUARIO).'">-</a>';										
										foreach($QUESTIONARIO as $q) {
												echo '<a href="{url}Professor/v_drop/'.base64_encode($q->QUESTIONARIO_idQUESTIONARIO).'/'.base64_encode(0).'/'.base64_encode(0).'/'.base64_encode($idUSUARIO).'">'.$q->NOMEQUESTIONARIO.'</a>';


										}

										echo '	</div>
												</div>';
										
										echo '-';
												
										echo '<div class="dropdown">
  													<button class="dropbtn">TURMA</button>
  													<div class="dropdown-content">';
										echo '<a href="{url}Professor/v_drop/'.base64_encode(0).'/'.base64_encode(0).'/'.base64_encode(0).'/'.base64_encode($idUSUARIO).'">-</a>';										
										foreach($TURMA as $q) {
											
											echo '<a href="{url}Professor/v_drop/0/0/'.base64_encode($q->TURMA_idTURMA).'/'.base64_encode($idUSUARIO).'">'.$q->SERIE."° ".$q->NOMECURSO." ".$q->MODALIDADE.'</a>';

										}

										echo '	</div>
												</div>';
										echo '-';
												
										echo '<div class="dropdown">
  													<button class="dropbtn">DISCIPLINA</button>
  													<div class="dropdown-content">';
										echo '<a href="{url}Professor/v_drop/'.base64_encode(0).'/'.base64_encode(0).'/'.base64_encode(0).'/'.base64_encode($idUSUARIO).'">-</a>';										
										foreach($DISCIPLINA as $q) {
											
											echo '<a href="{url}Professor/v_drop/'.base64_encode(0).'/'.base64_encode($q->MATERIA_idMATERIA).'/'.base64_encode(0).'/'.base64_encode($idUSUARIO).'">'.$q->NOMEMATERIA.'</a>';

										}

										echo '	</div>
												</div>'.br().br();
									
									
									/*									
													
										foreach($QUESTIONARIO as $q) {
											echo anchor("Professor/v_dimensao/".$q->idUSUARIO."/".$q->TURMA_idTURMA."/".$q->MATERIA_idMATERIA."/".$q->QUESTIONARIO_idQUESTIONARIO,
														"".$q->NOMEQUESTIONARIO." - ".$q->SERIE."° ".$q->NOMECURSO." ".$q->MODALIDADE." ".$q->ANO." - ".$q->NOMEMATERIA, "class = 'btn btn-info'").br();
										}
									*/
									?>