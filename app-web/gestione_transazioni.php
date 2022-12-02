<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione transazioni";
    $SetParameters["file"] = "nuova_transazione.php";
    $SetParameters["agenti"] = $db->getAgents();
	$SetParameters["clienti"] = $db->getClients();
	$SetParameters["transazioni"] = array(); // da implementare $db->getAllTransactions();
	
	$SetParameters["selezionati"] = false;
	if(isset($_POST["selezioneAgente"]) && isset($_POST["selezioneCliente"]) && isset($_POST["selezioneTipo"])){
		$SetParameters["selezionati"] = true;
		$SetParameters["agente"] = ["CF" => "RSSMRA65P21R889T", "nome" => "mario", "cognome" => "rossi"];   // getAgent($_POST["selezioneAgente"]) # ottengo agente da cf
		$SetParameters["cliente"] = ["CF" => "RSSMRA65P21R889T", "nome" => "mario", "cognome" => "rossi"]; // getClient($_POST["selezioneCliente"]) # ottengo agente da cf
		$SetParameters["tipo"] = $_POST["selezioneTipo"];
		if($SetParameters["tipo"] == "acquisto"){
			# questo è un array fittizio per provare senza funzione db
			$SetParameters["veicoli"] = [
				array("casaProd" => "Fiat", "modello" => "Stilo"),
				array("casaProd" => "Audi", "modello" => "A4"),
				array("casaProd" => "Volkswagen", "modello" => "Golf")
			]; 
			//$dbh->getClientVehicles($SetParameters["cliente"]); # i veicoli del cliente
		} else{
			# questo è un array fittizio per provare senza funzione db
			$SetParameters["veicoli"] = [
			array("casaProd" => "Citroen", "modello" => "C3"),
			array("casaProd" => "Toyota", "modello" => "Yaris")
			]; 
			//$dbh->getWorkshopVehicles(); # i veicoli dell'officina
		}
	}

	if($SetParameters["selezionati"] && isset($_POST["selezioneVeicolo"]) && isset($_POST["selezionePrezzo"])){
		# effettuo il cambio di proprietà (scade la vecchia e ne creo una nuova)
		//$db->changeCarOwner($_POST["selezioneVeicolo"], $_POST["selezioneCliente"]);
		
		# creo la transazione
		//$db->insertTransaction($_POST["selezioneAgente"],$_POST["selezioneCliente"],$_POST["selezioneVeicolo"]), -data_attuale-, $_POST["selezioneTipo"],$_POST["selezionePrezzo"]);
	}

    require("template/base.php");

?>