<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione riparazioni";
    $SetParameters["file"] = "nuova_riparazione.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Riavvio la sessione se non sono stati inviati dati
	if(!isset($_POST["avanti"]) && !isset($_POST["inserisciRiparazione"])){
		session_destroy();
		session_start();
	}

	// Inizializzo le variabili di controllo di sessione
	if(!isset($_SESSION["selezionatoCliente"])){
		$_SESSION["selezionatoCliente"] = false;
		$_SESSION["clienti"] = $db->getAllClient();
	}
	if(!isset($_SESSION["selezionatoVeicolo"])){
		$_SESSION["selezionatoVeicolo"] = false;
	}

	// Faccio i controlli per i 3 step d'inserimento
	if(isset($_POST["avanti"]) && isset($_POST["selezioneCliente"])) {
		// Cliente inserito
		$_SESSION["selezionatoCliente"] = true;
		$_SESSION["cliente"] = $db->checkClient($_POST["selezioneCliente"])[0]; 
		$scaduto = 0;
		$_SESSION["veicoli"] = $db->getClientValidCar($_POST["selezioneCliente"], $scaduto);
	} else if($_SESSION["selezionatoCliente"] && !$_SESSION["selezionatoVeicolo"] && isset($_POST["avanti"]) && isset($_POST["selezioneVeicolo"])) {
		// Veicolo inserito
		$_SESSION["selezionatoVeicolo"] = true;
		$_SESSION["veicoloCod"] = $_POST["selezioneVeicolo"];
		$_SESSION["veicoloSpecific"] = $db->getCarSpecific($_SESSION["veicoloCod"]);
		$_SESSION["meccanici"] = $db->getAllMechanics();
		//gestire se è vuoto, mandare un messaggio di errore sull'inserire i pezzi
		$_SESSION["pezzi"] = $db->getCarPieces($_SESSION["veicoloCod"]);
	} else if($_SESSION["selezionatoVeicolo"] && isset($_POST["inserisciRiparazione"]) && isset($_POST["nomeRiparazione"])){
		// Controllo inserimento meccanici
		if(!isset($_POST["meccaniciSelezionati"]) || (count($_POST["meccaniciSelezionati"]) <= 0)) {
			echo "Errore : Inserire almeno un meccanico";
		} else {
			// Dati inseriti pronti da inviare al db
			//okay quindi bosogna inserire la riparazione e fare join con comprende_pezzo e comprende_meccanico
			$cliente = $_SESSION["cliente"]["codice_fiscale"];
			$veicolo = $_SESSION["veicoloCod"];
			$meccanici = $_POST["meccaniciSelezionati"];  // array di CF di meccanici
			$nome = $_POST["nomeRiparazione"];
			$data_inizio = $_POST["dataInizio"];
			$data_fine = $_POST["dataFine"];
			$costo_totale = $_POST["costo_totale"];
			if(isset($_POST["pezziSelezionati"]) && (count($_POST["pezziSelezionati"]) > 0)){
				$pezzi = $_POST["pezziSelezionati"];   // array di nomi
			}
			//se vuoi calcolare il costo e non inserirlo bospgna mettere per ogni meccanico le ore lavoarte , diventa troppo complicato secondo me
			try{
				$db->insertRepair($cliente, $veicolo, $data_inizio, $data_fine, $costo_totale);
			}catch (Exception $e) {
				echo 'Errore: è stato inserito una riparazione già presente. ';
			}
			$id_repair = $db->getRepairId($cliente, $veicolo, $data_inizio, $data_fine, $costo_totale)[0]["id_riparazione"];
			
			foreach ($meccanici as $meccanico) {
				$db->insertMechanicIntoReparation($meccanico, $id_repair);
			}

			if(!empty($_SESSION["pezzi"])){
				foreach ($pezzi as $pezzo){
					$db->insertPieceIntoReparation($pezzo, $id_repair);
				}
			}
			
			// Ricarico la pagina 
			unset($_POST);
			session_destroy();
			session_start();
			$_SESSION["selezionatoCliente"] = false;
			$_SESSION["clienti"] = $db->getAllClient();	
			$_SESSION["selezionatoVeicolo"] = false;
		}
	}
	
	$SetParameters["riparazioni"] = $db->getAllRepairs();
    require("template/base.php");

?>
