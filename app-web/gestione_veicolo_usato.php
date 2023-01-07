<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione Veicoli";
    $SetParameters["file"] = "nuovo_veicolo_usato.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	if(isset($_POST["veicoloCasaProd"]) && isset($_POST["veicoloModello"]) && isset($_POST["veicoloCilindrata"]) && isset($_POST["veicoloAnnoProd"]))
	{
		// Controllo se cilindrata inserita correttamente
		if(!is_numeric($_POST['veicoloCilindrata'])){
			echo "Numero di cilindrata non valido<br>";
		} else {
			$annoProduzione = $_POST["veicoloAnnoProd"];
			$dataAppropriazione = $_POST["dataAppropriazione"];
			$annoAppropriazione = intval(date('Y', strtotime($dataAppropriazione)));
			// Controllo che l'anno di appropriazione sia successivo a quello di produzione
			if($annoAppropriazione < $_POST["veicoloAnnoProd"]){
				echo("la data di acquisizione è sbagliata, non si può comprare un veicolo prima che questo sia prodotto.");
			}else{
				$db->insertVeicoloUsato($_POST["veicoloCasaProd"], $_POST["veicoloModello"],
							$_POST["veicoloAnnoProd"], $_POST["veicoloCilindrata"], $_POST["veicoloKmPercorsi"]);
				$cod_veicolo = $db->getCarCod( $_POST["veicoloModello"], $_POST["veicoloCasaProd"], $_POST["veicoloAnnoProd"], $_POST["veicoloCilindrata"], $_POST["veicoloKmPercorsi"]);
				$scaduto = 0;
				$db->insertAttestatoProprieta($_POST["proprietarioVeicolo"], $cod_veicolo, $scaduto, $dataAppropriazione);
			}
		}
    }

	$SetParameters["proprietari"] = $db->getClients();
	$SetParameters["veicoli"] = $db->getAllClientsCar();
	$SetParameters["veicoli_officina"] = $db->getAllGarageCar();#getAllGarageCar(1)
	
	
    require("template/base.php");

?>
