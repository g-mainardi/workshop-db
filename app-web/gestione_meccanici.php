<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione meccanici";
    $SetParameters["file"] = "nuovo_meccanico.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo meccanici dal database
    $SetParameters["meccanici"] =  $db->getAllMechanics();
	$SetParameters["meccanico_migliore"] = $db->getMeccanicoPiuPresente();
	// Tipo di utente: meccanico -> 2
	$type = 2;

	// Controlli per attributi aggiornati
	if(isset($_POST["aggiornaTelefono"])){
		$db->updateTelephone( $_POST["meccanicoTelefono"], $_POST["meccanicoCF"], $type);
	}
	if(isset($_POST["aggiornaMail"])){
		$db->updateEmail($_POST["meccanicoMail"], $_POST["meccanicoCF"], $type);
	}
	if(isset($_POST["aggiornaPaga"])){
		$paga = intval($_POST["meccanicoPaga"]);
		echo "La paga è ".$paga;
		$db->updatePagaOraria($paga, $_POST["meccanicoCF"], $type);
	}
	if(isset($_POST["aggiornaTutto"])){
		$paga = intval($_POST["meccanicoPaga"]);
		$db->updateEverything($_POST["meccanicoMail"], $_POST["meccanicoTelefono"], $paga, $_POST["meccanicoCF"], $type);
	}

	// Controllo se tutto inserito
    if(isset($_POST["inserisciMeccanico"]) && isset($_POST["meccanicoCF"]) && isset($_POST["meccanicoNome"]) && isset($_POST["meccanicoCognome"]) 
		&& isset($_POST["meccanicoTelefono"]) && isset($_POST["meccanicoDataNascita"])  && isset($_POST["meccanicoPaga"])){
		if(checkUserInputDigit($_POST["meccanicoNome"], $_POST["meccanicoCognome"], $_POST["meccanicoCF"], $_POST["meccanicoTelefono"], $_POST["meccanicoMail"])){
			// Inserisco meccanico nel database
			try{
				$paga = intval($_POST["meccanicoPaga"]);
				$db->insertMeccanico($_POST["meccanicoCF"], $_POST["meccanicoNome"], $_POST["meccanicoCognome"], $_POST["meccanicoDataNascita"], $_POST["meccanicoTelefono"], $_POST["meccanicoMail"], $paga);
			}catch(Exception $e) {
				echo 'Errore: è stato inserito un meccanico già presente. ';
			}
		}
    }

    require("template/base.php");

?>
