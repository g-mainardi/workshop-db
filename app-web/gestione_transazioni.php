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
			$scaduto = 0;
			$SetParameters["veicoli"] = $db->getClientValidCar($_POST["selezioneCliente"], $scaduto);
		} else{
			$scaduto = 1;
			$arrayProva =  $db->getGarageCar(1);
			$SetParameters["veicoli"] = array();
			$arrayname = array();
			for ($i = 0; $i < count($arrayProva); ++$i) {
				if (!in_array($arrayProva[$i]["cod_veicolo"], $arrayname)){
					array_push($arrayname, $arrayProva[$i]["cod_veicolo"]);
					$result = $db->checkActiveCertificate($arrayProva[$i]["cod_veicolo"], 0);
					if (!empty($result)){
						array_splice($arrayProva, $i, 1);
						#unset($arrayProva[$i]);
					}else{
						array_push($SetParameters["veicoli"], $arrayProva[$i]);
					}
				}
			}
		}
	}
	else if($_SESSION["selezionati"] && isset($_POST["inserisciTransazione"]) && isset($_POST["selezioneVeicolo"]) && isset($_POST["selezionePrezzo"])){
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
		$db->insertTransaction($_SESSION["cliente"]["codice_fiscale"], $_POST["selezioneVeicolo"], $_SESSION["agente"]["codice_fiscale"],  $_POST["selezionePrezzo"], $data_produzione , $_SESSION["tipo"]);
	}
	else{
		$SetParameters["agenti"] = $db->getAllAgents();
		$SetParameters["clienti"] = $db->getAllClient();
	}
	$SetParameters["transazioni"] = $db->getAllTransactions(); // da implementare $db->getAllTransactions();
    require("template/base.php");

?>
