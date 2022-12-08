<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione pezzi";
    $SetParameters["file"] = "nuovo_pezzo.php";

	// Leggo dal database
	$SetParameters["veicoli"] = $db->getAllCar();

	$SetParameters["pezzi"] = $db->getAllPieces();
	
    if(isset($_POST["pezzoVeicolo"]) && isset($_POST["pezzoNome"]) && isset($_POST["pezzoCosto"]))
	{
		// Se descrizione non inserita, ne metto una vuota
		if(isset($_POST["pezzoDescrizione"])){
			$descrizione = $_POST["pezzoDescrizione"];
		} else {
			$descrizione = "";
		}
		
		// Controllo se Pezzo di ricambio già presente, altrimenti inserisco
		try{
			$db->insertPiece($_POST["pezzoNome"], $_POST["pezzoVeicolo"], $_POST["pezzoCosto"], $descrizione);
		}catch (Exception $e) {
			echo 'Errore: è stato inserito un pezzo già presente. ';
		}
    }

    require("template/base.php");

?>
