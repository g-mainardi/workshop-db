<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione transazioni";
    $SetParameters["file"] = "nuova_transazione.php";
    
	$SetParameters["selezionati"] = false;
	if (!isset($_SESSION["selezionati"])) {
		$_SESSION["selezionati"] = false;	
	}

	// Fase controllo primi 3 input: Agente, Cliente e Tipo di transazione
	if(isset($_POST["avanti"]) && isset($_POST["selezioneAgente"]) && isset($_POST["selezioneCliente"]) && isset($_POST["selezioneTipo"])){
		$SetParameters["selezionati"] = true;
		$_SESSION["selezionati"] = true;
		$SetParameters["agente"] = $db->checkAgent($_POST["selezioneAgente"]);
		$_SESSION["agente"] = $SetParameters["agente"][0];
		$SetParameters["cliente"] = $db->checkClient($_POST["selezioneCliente"]); 
		$_SESSION["cliente"] = $SetParameters["cliente"][0];
		$SetParameters["tipo"] = $_POST["selezioneTipo"];
		$_SESSION["tipo"] = $SetParameters["tipo"];
		if($_POST["selezioneTipo"] == "acquisto"){
			$SetParameters["veicoli"] = $db->getClientValidCar(0, $_POST["selezioneCliente"]);
		} else{
			$scaduto = 1;
			$SetParameters["veicoli"] =  $db->getGarageCar(1);
		}
	}
	else if($_SESSION["selezionati"] && isset($_POST["inserisciTransazione"]) && isset($_POST["selezioneVeicolo"]) && isset($_POST["selezionePrezzo"])){
		$_SESSION["selezionati"] = false;
		$data_produzione = date('Y-m-d');
		if($_SESSION["tipo"]  == "acquisto"){
			$scaduto=1;
			$db->updateCertificate($scaduto, $_SESSION["cliente"]["codice_fiscale"], $_POST["selezioneVeicolo"]);
		}else{
			$scaduto=0;
			$db->updateCertificate($scaduto, $_SESSION["cliente"]["codice_fiscale"], $_POST["selezioneVeicolo"]);
		}
		$db->insertTransaction($_SESSION["cliente"]["codice_fiscale"], $_POST["selezioneVeicolo"], $_SESSION["agente"]["codice_fiscale"],  $_POST["selezionePrezzo"], $data_produzione , $_SESSION["tipo"]);
	}
	else{
		$SetParameters["agenti"] = $db->getAllAgents();
		$SetParameters["clienti"] = $db->getAllClient();
	}
	$SetParameters["transazioni"] = $db->getAllTransactions(); // da implementare $db->getAllTransactions();
    require("template/base.php");

?>
