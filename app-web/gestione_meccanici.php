<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione meccanici";
    $SetParameters["file"] = "nuovo_meccanico.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo meccanici dal database
    $SetParameters["meccanici"] =  $db->getAllMechanics();

	if(isset($_POST["aggiornaTelefono"])){
		$type = 2;
		$db->updateTelephone( $_POST["meccanicoTelefono"], $_POST["meccanicoCF"], $type);
	}
	if(isset($_POST["aggiornaMail"])){
		$type = 2;
		$db->updateEmail($_POST["meccanicoMail"], $_POST["meccanicoCF"], $type);
	}
	if(isset($_POST["aggiornaPaga"])){
		$type = 2;
		$db->updatePagaOraria($_POST["meccanicoMail"], $_POST["meccanicoCF"], $type);
	}
	if(isset($_POST["aggiornaTutto"])){
		$type = 2;
		$paga = intval($_POST["agentePaga"]);
		$db->updateEverything($_POST["meccanicoMail"], $_POST["meccanicoTelefono"], $paga, $_POST["meccanicoCF"], $type);
	}

    if(isset($_POST["meccanicoCF"]) && isset($_POST["meccanicoNome"]) && isset($_POST["meccanicoCognome"]) 
		&& isset($_POST["meccanicoTelefono"]) && isset($_POST["meccanicoDataNascita"])  && isset($_POST["meccanicoPaga"])){
			$error = false;
			// Controllo se sono inseriti nome e cognome
			if(strlen($_POST['meccanicoNome']) <= 0 || strlen($_POST['meccanicoCognome']) <= 0){
				echo "Nome e cognome non possono essere vuoti<br>";
				$error = true;
			}
			// Controllo se mail inserita correttamente
			if($_POST["meccanicoMail"] != "" && !filter_var($_POST['meccanicoMail'], FILTER_VALIDATE_EMAIL)){
				echo "L'email non ha un giusto formato<br>";
				$error = true;
			}
			// Controllo se CF inserito correttamente
			if(strlen($_POST['meccanicoCF']) != 16){
				echo "Il codice fiscale è composto da esattamente 16 caratteri<br>";
				$error = true;
			}
			// Controllo se telefono inserito correttamente
			if(!is_numeric($_POST['meccanicoTelefono'])){
				echo "Numero di telefono non valido<br>";
				$error = true;
			}
			/*
			// Controllo se CF già presente
			if($db->checkAll(($_POST['meccanicoCF']))!=0)
			{
				echo "CF gia presente nel database<br>";
				$error = true;
			}
			*/
			if(!$error){
				// Inserisco meccanico nel database
				$db->insertmeccanico($_POST["meccanicoCF"], $_POST["meccanicoNome"], $_POST["meccanicoCognome"], $_POST["meccanicoDataNascita"], $_POST["meccanicoTelefono"], $_POST["meccanicoMail"], $_POST["meccanicoPaga"]);
				
			}
        }

    require("template/base.php");

?>
