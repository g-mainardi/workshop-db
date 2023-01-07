<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione agenti";
    $SetParameters["file"] = "nuovo_veicolo_nuovo.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	if(isset($_POST["veicoloCasaProd"]) && isset($_POST["veicoloModello"]) && isset($_POST["veicoloCilindrata"]) && isset($_POST["veicoloAnnoProd"]))
	{
		// Controllo se cilindrata inserita correttamente
		if(!is_numeric($_POST['veicoloCilindrata'])){
			echo "Numero di cilindrata non valido<br>";
		} else {
			try{
				$db->insertVeicoloNuovo($_POST["veicoloCasaProd"], $_POST["veicoloModello"],
						$_POST["veicoloAnnoProd"], $_POST["veicoloCilindrata"]);
			}catch(Exception $e){
				print("Errore: è stato inserito un veicolo già presente.");
			}
		}
	}

	// Leggo dati dal database
	$SetParameters["proprietari"] = $db->getClients();
	$SetParameters["veicoli"] = $db->getAllVeicoliNuovi();
	
	
    require("template/base.php");

?>
