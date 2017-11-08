<?php

										


	foreach($QUESTIONARIO as $q) {
		echo anchor("Professor/v_dimensao/".$q->idUSUARIO."/".$q->TURMA_idTURMA."/".$q->MATERIA_idMATERIA."/".$q->QUESTIONARIO_idQUESTIONARIO,
							"".$q->NOMEQUESTIONARIO." - ".$q->SERIE."° ".$q->NOMECURSO." ".$q->MODALIDADE." ".$q->ANO." - ".$q->NOMEMATERIA, "class = 'btn btn-info'").br();
	}
?>
