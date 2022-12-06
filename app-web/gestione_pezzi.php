<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione pezzi";
    $SetParameters["file"] = "nuovo_pezzo.php";

	// Leggo dal database
	$SetParameters["veicoli"] = $db->getAllCar();

	// DA IMPLEMENTARE $db->getAllParts(); ora c'è un array di prova
	$SetParameters["pezzi"] = $db->getAllPieces();
	
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
		try{
			#public function insertPiece($nome, $cod_veicolo, $costo_unitario, $descrizione){

			$db->insertPiece($nome, $veicolo, $costo, $descrizione);
		}catch (Exception $e) {
			echo 'Errore: è stato inserito un pezzo già presente. ';
		}
    }

    require("template/base.php");

?>
