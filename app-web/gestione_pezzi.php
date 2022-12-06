<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione pezzi";
    $SetParameters["file"] = "nuovo_pezzo.php";

	// Leggo dal database
	$SetParameters["veicoli"] = $db->getAllCar();

	// DA IMPLEMENTARE $db->getAllParts(); ora c'è un array di prova
	$SetParameters["pezzi"] = array(array("veicolo"=> $SetParameters["veicoli"][0], "nome" => "ruote", "descrizione"=>"vuota", "costo"=>"200"));
	
    if(isset($_POST["pezzoVeicolo"]) && isset($_POST["pezzoNome"]) && isset($_POST["pezzoCosto"]))
	{
		// Prendo i valori
		$veicolo = $_POST["pezzoVeicolo"]; # è il codice veicolo
		$nome = $_POST["pezzoNome"];
		$costo = $_POST["pezzoCosto"];

		// Se descrizione non inserita, ne metto una vuota
		if(isset($_POST["pezzoDescrizione"])){
			$descrizione = $_POST["pezzoDescrizione"];
		} else {
			$descrizione = "";
		}
		// Controllo se Pezzo di ricambio già presente, altrimenti inserisco
		# Questa parte è da riadattare e DA IMPLEMENTARE 
		/*
		try{
			$db->insertPart($veicolo, $nome, $costo, $descrizione);
		}catch (Exception $e) {
			echo 'Errore: è stato inserito un pezzo già presente. ';
		}
		*/
    }

    require("template/base.php");

?>
