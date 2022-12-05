<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione pezzi";
    $SetParameters["file"] = "nuovo_pezzo.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo pezzi dal database
	$SetParameters["pezzi"] = array(); # DA IMPLEMENTARE $db->getAllParts();
	
    if(isset($_POST["pezzoCasaProd"]) && isset($_POST["pezzoModello"])
		&& isset($_POST["pezzoDescrizione"]) && isset($_POST["pezzoCosto"]))
	{
		// Controllo se Pezzo di ricambio già presente
		# Questa parte è da riadattare e DA IMPLEMENTARE 
		/*
		try{
			$db->insertCar($_POST["pezzoCasaProd"], $_POST["pezzoModello"],
					$_POST["pezzoCosto"], $_POST["pezzoDescrizione"]);
			$cod_pezzo = $db->getCarCod( $_POST["pezzoModello"], $_POST["pezzoCasaProd"], $_POST["pezzoCosto"]);
			$scaduto = 0;
			echo($dataAppropriazione);
			$db->insertOwnershipCertificate($_POST["proprietarioPezzo"], $cod_pezzo, $scaduto, $dataAppropriazione);
		}catch (Exception $e) {
			echo 'Errore: è stato inserito un pezzo già presente. ';
		}
		*/
    }

    require("template/base.php");

?>
