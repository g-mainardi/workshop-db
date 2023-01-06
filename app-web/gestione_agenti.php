<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione agenti";
    $SetParameters["file"] = "nuovo_agente.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo agenti dal database
	$SetParameters["agenti"] = $db->getAllAgents();
	
	// Tipo di utente: agente -> 1
	$type = 1;

	// Controlli per attributi aggiornati
	if(isset($_POST["aggiornaTelefono"])){
		$db->updateTelephone( $_POST["agenteTelefono"], $_POST["agenteCF"], $type);
	}
	if(isset($_POST["aggiornaMail"])){
		$db->updateEmail($_POST["agenteMail"], $_POST["agenteCF"], $type);	
	}
	if(isset($_POST["aggiornaPaga"])){
        $paga = intval($_POST["agentePaga"]);
		$db->updatePagaOraria($paga, $_POST["agenteCF"], $type);
	}
	if(isset($_POST["aggiornaTutto"])){
        $paga = intval($_POST["agentePaga"]);
		$db->updateEverything($_POST["agenteMail"], $_POST["agenteTelefono"], $paga, $_POST["agenteCF"], $type);
	}
	
	// Controllo ricerca agente del mese
	if(isset($_POST["ricercaAgente"])){
		$periodo = explode("-", $_POST["periodo"]);
		$anno = $periodo[0];
		$mese = $periodo[1];
		$agenteDelMese = $db->searchAgentOfMonth($anno, $mese);
	}

	// Controllo se tutto inserito
    if(isset($_POST["inserisciAgente"]) && isset($_POST["agenteCF"]) && isset($_POST["agenteNome"]) && isset($_POST["agenteCognome"]) 
		&& isset($_POST["agenteTelefono"]) && isset($_POST["agenteDataNascita"])  && isset($_POST["agentePaga"])){
		if(checkUserInputDigit($_POST["agenteNome"], $_POST["agenteCognome"], $_POST["agenteCF"], $_POST["agenteTelefono"], $_POST["agenteMail"])){
			// Inserisco agente nel database
			try{
				$paga = intval($_POST["agentePaga"]);
				$db->insertAgente($_POST["agenteCF"], $_POST["agenteNome"], $_POST["agenteCognome"], $_POST["agenteDataNascita"], $_POST["agenteTelefono"], $_POST["agenteMail"], $paga);
			}catch(Exception $e) {
				echo 'Errore: è stato inserito un agente già presente. ';
			}
		}
    }

    require("template/base.php");

?>
