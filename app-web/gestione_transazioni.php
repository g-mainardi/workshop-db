<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione transazioni";
    $SetParameters["file"] = "nuova_transazione.php";
    
	$SetParameters["selezionati_specifiche"] = false;
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
		$SetParameters["tipoVeicolo"] = $_POST["selezioneTipoVeicolo"];
		$_SESSION["tipoVeicolo"] = $SetParameters["tipoVeicolo"];
		if($_POST["selezioneTipo"] == "acquisto"){
			if($_SESSION["tipoVeicolo"] == "nuovo"){
				$SetParameters["veicoli"] = $db->getAllVeicoliNuovi();
			}else{
				$SetParameters["veicoli"] = $db->getClientValidCar(0, $_POST["selezioneCliente"]);
			}
		} else{
			if($_SESSION["tipoVeicolo"] == "nuovo"){
				$SetParameters["veicoli"] = $db->getAllVeicoliNuovi();
			}else{
				#TUTTI I VEICOLI USATI CHE SONO DI PROPRIETà DELL'OFFICINA
				$SetParameters["veicoli"] = $db->getGarageCar(1);
			}
		}
	}
	else if($_SESSION["selezionati"] && isset($_POST["inserisciTransazione"]) && isset($_POST["selezioneVeicolo"]) && isset($_POST["selezionePrezzo"])){
		$_SESSION["selezionati"] = false;
		$data_produzione = date('Y-m-d');
		$ora_transazione = date("h:i:sa");
		if($_SESSION["tipo"]  == "acquisto"){
			if($_SESSION["tipoVeicolo"]=="usato"){
				print_r("sono dentro");
				$scaduto=1;
				$db->updateCertificate($scaduto, $_SESSION["cliente"]["CF_cliente"], $_POST["selezioneVeicolo"]);
				$db->insertTransaction($_SESSION["cliente"]["CF_cliente"], $_POST["selezioneVeicolo"], $_SESSION["agente"]["CF_agente"],  $_POST["selezionePrezzo"], $data_produzione , $_SESSION["tipo"], $ora_transazione);
			}
		}else{
			if($_SESSION["tipoVeicolo"]=="nuovo"){
				#elimino il veicolo da i veicoli nuovi
				$informazioni_veicolo = $db->getVeicoloNuovo($_POST["selezioneVeicolo"]);
				$modello =$informazioni_veicolo[0]["modello"];
				$casa_produttrice = $informazioni_veicolo[0]["casa_produttrice"];
				$anno_produzione =$informazioni_veicolo[0]["anno_produzione"];
				$cilindrata = $informazioni_veicolo[0]["cilindrata"];
				$km_percorsi = 0;
				$scaduto = 0;
				#in tutte le transaioni con tipo veicolo = nuovo e cod_veiolo = $_POST["selezioneVeicolo"]
				#devo modificare il nuo
				$db->deleteNuovoVeicolo($_POST["selezioneVeicolo"]);
				print_r("eliminazione");
				#inserisco il veicolo in quelli usati con km ercodi = 0 
				$db->insertVeicoloUsato($casa_produttrice, $modello, $anno_produzione, $cilindrata, $km_percorsi);
				print_r("veicolo nuovo");
				$cod_veicolo = $db->getCarCod( $modello, $casa_produttrice,$anno_produzione, $cilindrata,$km_percorsi);
				$db->insertAttestatoProprieta($_SESSION["cliente"]["CF_cliente"], $cod_veicolo, $scaduto, $data_produzione);
				print_r("inserito attestato");
				$db->insertTransaction($_SESSION["cliente"]["CF_cliente"], $cod_veicolo, $_SESSION["agente"]["CF_agente"],  $_POST["selezionePrezzo"], $data_produzione , $_SESSION["tipo"], $ora_transazione);
			}else{
				$scaduto=0;
				$db->updateCertificate($scaduto, $_SESSION["cliente"]["CF_cliente"], $_POST["selezioneVeicolo"]);
				$db->insertTransaction($_SESSION["cliente"]["CF_cliente"], $_POST["selezioneVeicolo"], $_SESSION["agente"]["CF_agente"],  $_POST["selezionePrezzo"], $data_produzione , $_SESSION["tipo"], $ora_transazione);
			}
		}
	}
	else{
		$SetParameters["agenti"] = $db->getAllAgents();
		$SetParameters["clienti"] = $db->getAllClient();
	}
	$SetParameters["transazioni"] = $db->getAllTransactions(); 
    require("template/base.php");

?>
