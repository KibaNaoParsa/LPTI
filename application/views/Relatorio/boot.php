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
                      <h1 class="page-header">Criação de Relatórios</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
  		        	<div class="col-lg-12 col-md-12" id="btn">
									<?php
										echo '<div class="dropdown">
  													<button class="dropbtn">DIMENSÃO</button>
  													<div class="dropdown-content">';
										echo '<a href="{url}Relatorio/v_chartSingle/'.base64_encode($idQUESTIONARIO).'/'.base64_encode($idTURMA).'/'.base64_encode(0).'">-</a>';										
										foreach($DIMENSAO as $d) {
											
											echo '<a href="{url}Relatorio/v_chartSingle/'.base64_encode($idQUESTIONARIO).'/'.base64_encode($idTURMA).'/'.base64_encode($d->idDIMENSAO).'">'.$d->DESCRICAO.'</a>';

										}

										echo '	</div>
												</div>'.br().br();

									?>