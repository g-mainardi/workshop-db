<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione veicoli";
    $SetParameters["file"] = "nuovo_veicolo.php";
	array_push($SetParameters["scripts"], "./js/script.js");
	
    if(isset($_POST["veicoloCasaProd"]) && isset($_POST["veicoloModello"]) && isset($_POST["veicoloCilindrata"]) && isset($_POST["veicoloAnnoProd"]))
	{
		// Controllo se cilindrata inserita correttamente
		if(!is_numeric($_POST['veicoloCilindrata'])){
			echo "Numero di cilindrata non valido<br>";
		} else {
			$dataAppropriazione = $_POST["dataAppropriazione"];
			$annoAppropriazione = intval(date('Y', strtotime($dataAppropriazione)));
			
			// Controllo che l'anno di appropriazione sia successivo a quello di produzione
			if($annoAppropriazione < $_POST["veicoloAnnoProd"]){
				echo("la data di acquisizione è sbagliata.");
			}else{
				// Controllo se Veicolo già presente
				try{
					$db->insertCar($_POST["veicoloCasaProd"], $_POST["veicoloModello"],
							$_POST["veicoloAnnoProd"], $_POST["veicoloCilindrata"]);
					$cod_veicolo = $db->getCarCod( $_POST["veicoloModello"], $_POST["veicoloCasaProd"], $_POST["veicoloAnnoProd"]);
					$scaduto = 0;
					echo($dataAppropriazione);
					$db->insertOwnershipCertificate($_POST["proprietarioVeicolo"], $cod_veicolo, $scaduto, $dataAppropriazione);
				}catch (Exception $e) {
					echo 'Errore: è stato inserito un veicolo già presente. ';
				}
			}
		}
    } else{
		echo 'Errore: ci sono dati mancanti.';
	}

	// Leggo dati dal database
	$SetParameters["proprietari"] = $db->getClients();
	$SetParameters["veicoli"] = $db->getAllCar();

    require("template/base.php");

?>
