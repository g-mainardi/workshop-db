<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione riparazioni";
    $SetParameters["file"] = "nuova_riparazione.php";
    
	$SetParameters["meccanici"] = $db->getAllMechanics();
	$SetParameters["clienti"] = $db->getAllClient();

	$SetParameters["selezionatoCliente"] = false;
	$SetParameters["selezionatoVeicolo"] = false;

	if(isset($_POST["selezioneCliente"])) {
		$SetParameters["selezionatoCliente"] = true;
		$scaduto = 0;
		$SetParameters["veicoli"] = $db->getClientValidCar($_POST["selezioneCliente"], $scaduto);
	}

	if($SetParameters["selezionatoCliente"] && isset($_POST["selezioneVeicolo"])) {
		$SetParameters["selezionatoVeicolo"] = true;
	}

	// PARTE COPIATA DA MODIFICARE
	// Fase controllo primi 3 input: Agente, Cliente e Tipo di riparazione
	if(isset($_POST["avanti"]) && isset($_POST["selezioneCliente"])){
		$SetParameters["selezionati"] = true;
		$_SESSION["selezionati"] = true;
		//$SetParameters["agente"] = $db->checkAgent($_POST["selezioneAgente"]);
		//$_SESSION["agente"] = $SetParameters["agente"][0];
		$SetParameters["cliente"] = $db->checkClient($_POST["selezioneCliente"]); 
		$_SESSION["cliente"] = $SetParameters["cliente"][0];
		//$SetParameters["tipo"] = $_POST["selezioneTipo"];
		//$_SESSION["tipo"] = $SetParameters["tipo"];
	}/*
	else if($_SESSION["selezionati"] && isset($_POST["inserisciRiparazione"]) && isset($_POST["selezioneVeicolo"]) && isset($_POST["selezionePrezzo"])){
		$_SESSION["selezionati"] = false;
		$data_produzione = date('Y-m-d');
		if($_SESSION["tipo"]  == "acquisto"){
			$scaduto=1;
			$db->updateCertificate($scaduto, $_POST["selezioneVeicolo"], $_SESSION["cliente"]["codice_fiscale"]);
			#problema non mi refresha la pagina
		}else{
			$scaduto = 0;
			# effettuo il cambio di proprietà, comprando dall'officin vuol dire che l'attestato è già cambiato quindi (scade la vecchia e ne creo una nuova)
			$db->insertOwnershipCertificate($_SESSION["cliente"]["codice_fiscale"], $_POST["selezioneVeicolo"], $scaduto, $data_produzione);
		}
		$db->insertRepair($_SESSION["cliente"]["codice_fiscale"], $_POST["selezioneVeicolo"], $_SESSION["agente"]["codice_fiscale"],  $_POST["selezionePrezzo"], $data_produzione , $_SESSION["tipo"]);
	}*/
	
	$SetParameters["riparazioni"] = array(); // da implementare $db->getAllRepairs();
    require("template/base.php");

?>
