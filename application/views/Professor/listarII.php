<?php

										


	foreach($QUESTIONARIO as $q) {
		echo anchor("Professor/v_dimensao/".base64_encode($q->idUSUARIO)."/".base64_encode($q->TURMA_idTURMA)."/".base64_encode($q->MATERIA_idMATERIA)."/".base64_encode($q->QUESTIONARIO_idQUESTIONARIO),
							"".$q->NOMEQUESTIONARIO." - ".$q->SERIE."° ".$q->NOMECURSO." ".$q->MODALIDADE." ".$q->ANO." - ".$q->NOMEMATERIA, "class = 'btn btn-info'").br();
	}
?>
