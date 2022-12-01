<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Agenti, transazioni e proprietà ";
    $SetParameters["file"] = "nuovo_agente.php";
    array_push($SetParameters["scripts"], "./js/script.js");

    $SetParameters["agenti"] = $db->getAgents();

    if(isset($_POST["aggiornaTelefono"])){
		$type = $db->getDependentType($_POST["agenteCF"]);
		$db->updateTelephone( $_POST["agenteTelefono"], $_POST["agenteCF"], $type);
		#echo "aggiornato: ".$_POST["clienteCF"]." numero: ".$_POST["clienteTelefono"];
	}
	if(isset($_POST["aggiornaMail"])){
		$type = $db->getDependentType($_POST["agenteCF"]);
		$db->updateEmail($_POST["agenteMail"], $_POST["agenteCF"], $type);		
		#echo "aggiornato: ".$_POST["clienteCF"]." Mail: ".$_POST["clienteMail"];
	}
    if(isset($_POST["aggiornaPaga"])){
		$type = $db->getDependentType($_POST["agenteCF"]);
		$db->updatePagaOraria($_POST["agentePaga"], $_POST["agenteCF"], $type);		
		#echo "aggiornato: ".$_POST["clienteCF"]." Mail: ".$_POST["clienteMail"];
	}
	if(isset($_POST["aggiornaTutto"])){
		$type = $db->getDependentType($_POST["agenteCF"]);
        $paga = intval($_POST["agentePaga"]);
		$db->updateEverything($_POST["agenteMail"], $_POST["agenteTelefono"], $paga, $_POST["agenteCF"], $type);
	}
	
	if(isset($_POST["inserisciAgente"])){
		if(isset($_POST["agenteCF"]) && isset($_POST["agenteNome"]) && isset($_POST["agenteCognome"]) 
		&& isset($_POST["agenteTelefono"]) && isset($_POST["agenteDataNascita"]))
		{
			$error = false;
			// Controllo se sono inseriti nome e cognome
			if(strlen($_POST['agenteNome']) <= 0 || strlen($_POST['agenteCognome']) <= 0){
				echo "Nome e cognome non possono essere vuoti<br>";
				$error = true;
			}
			// Controllo se mail inserita correttamente
			if($_POST["agenteMail"] != "" && !filter_var($_POST['agenteMail'], FILTER_VALIDATE_EMAIL)){
				echo "L'email non ha un giusto formato<br>" . $_POST["agenteMail"];
				$error = true;
			}
			// Controllo se CF inserito correttamente
			if(strlen($_POST['agenteCF']) != 16){
				echo "Il codice fiscale è composto da esattamente 16 caratteri<br>";
				$error = true;
			}
			// Controllo se telefono inserito correttamente
			if(!is_numeric($_POST['agenteTelefono'])){
				echo "Numero di telefono non valido<br>";
				$error = true;
			}
			if(!$error){
				// Inserisco cliente nel database
                try{
                    $paga = intval($_POST["agentePaga"]);
				    $db->insertAgente($_POST["agenteCF"], $_POST["agenteNome"], $_POST["agenteCognome"],
				    $_POST["agenteDataNascita"], $_POST["agenteTelefono"], $_POST["agenteMail"], $paga);
                }catch (Exception $e) {
					echo 'Errore: è stato inserito un utente già presente. ';
				}
                
			}
    	}
	}

    require("template/base.php");

?>
