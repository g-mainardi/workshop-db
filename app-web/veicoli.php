<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione veicoli";
    $SetParameters["file"] = "nuovo_veicolo.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo veicoli dal database
	$SetParameters["proprietari"] = $db->getClients();
	$SetParameters["veicoli"] = $db->getAllCar();
	
	/*[array("casaProd" => "Fiat", "modello" => "Stilo",
										"cilindrata" => "1596", "anno_prod" => "1965-10-21", "proprietario" => "Mario Rossi"),
									array("casaProd" => "Audi", "modello" => "A4",
										"cilindrata" => "1984", "anno_prod" => "1965-10-21", "proprietario" => "Mario Rossi"),
									array("casaProd" => "Volkswagen", "modello" => "Golf",
										"cilindrata" => "1498", "anno_prod" => "1965-10-21", "proprietario" => "In Vendita"),
									array("casaProd" => "Citroen", "modello" => "C3",
										"cilindrata" => "1199", "anno_prod" => "1965-10-21", "proprietario" => "Mario Rossi"),
									array("casaProd" => "Toyota", "modello" => "Yaris",
										"cilindrata" => "1618", "anno_prod" => "1965-10-21", "proprietario" => "In Vendita")];  // $db->getVehicles()*/

    if(isset($_POST["veicoloCasaProd"]) && isset($_POST["veicoloModello"])
		&& isset($_POST["veicoloCilindrata"]) && isset($_POST["veicoloAnnoProd"]))
	{
		$error = false;
		// Controllo se sono inseriti Modello e Casa Produttrice
		if(strlen($_POST['veicoloModello']) <= 0 || strlen($_POST['veicoloCasaProd']) <= 0){
			echo "Modello o Casa produttrice non possono essere vuoti<br>";
			$error = true;
		}

		// Controllo se cilindrata inserita correttamente
		if(!is_numeric($_POST['veicoloCilindrata'])){
			echo "Numero di cilindrata non valido<br>";
			$error = true;
		}
		/*
		// Controllo se Veicolo già presente
		if($db->checkVehicle(($_POST['veicoloCasaProd'], $_POST['veicoloModello']))!=0)
		{
			echo "Veicolo già presente nel database<br>";
			$error = true;
		}
		*/
		if(!$error){
			$db->insertCar($_POST["veicoloCasaProd"], $_POST["veicoloModello"],
							$_POST["veicoloAnnoProd"], $_POST["veicoloCilindrata"]);
			$cod_veicolo_array = $db->getCarCod( $_POST["veicoloModello"], $_POST["veicoloCasaProd"], $_POST["veicoloAnnoProd"]);
			$cod_veicolo = $cod_veicolo_array[0];
			echo(gettype($cod_veicolo));
			$scaduto = 0;
			$dataAppropriazione = $_POST["dataAppropriazione"];
			echo($dataAppropriazione);
			$db->insertOwnershipCertificate($_POST["proprietarioVeicolo"], $cod_veicolo, $dataAppropriazione, $scaduto);
			/*
			$SetParameters["veicoli"][] = array("casaProd" => $_POST["veicoloCasaProd"], "modello" => $_POST["veicoloModello"],
					"cilindrata" => $_POST["veicoloCilindrata"], "anno_prod" => $_POST["veicoloAnnoProd"], "proprietario" => "In Vendita");
			*/
		}
    }

    require("template/base.php");

?>
