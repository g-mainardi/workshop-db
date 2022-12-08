<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione clienti";
    $SetParameters["file"] = "nuovo_cliente.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo clienti dal database
	$SetParameters["clienti"] = $db->getClients();
	
	// Tipo di utente: cliente -> 0
	$type =0;

	// Controlli per attributi aggiornati
	if(isset($_POST["aggiornaTelefono"])){
		$db->updateTelephone( $_POST["clienteTelefono"], $_POST["clienteCF"], $type);
	}
	if(isset($_POST["aggiornaMail"])){
		$db->updateEmail($_POST["clienteMail"], $_POST["clienteCF"], $type);
		echo "<meta http-equiv='refresh' content='0'>";
	}
	if(isset($_POST["aggiornaTutto"])){
		$db->updateEverythingClient($_POST["clienteMail"], $_POST["clienteTelefono"], $_POST["clienteCF"]);
	}
	
	// Controllo se tutto inserito
	if(isset($_POST["inserisciCliente"]) && isset($_POST["clienteCF"]) && isset($_POST["clienteNome"]) && isset($_POST["clienteCognome"]) 
		&& isset($_POST["clienteTelefono"]) && isset($_POST["clienteDataNascita"]))
		{
		// Controllo l'input digitato
		if(checkUserInputDigit($_POST["clienteNome"], $_POST["clienteCognome"], $_POST["clienteCF"], $_POST["clienteTelefono"], $_POST["clienteMail"])){
			// Inserisco cliente nel database, se non è già presente
			try{
				$db->insertCliente($_POST["clienteCF"], $_POST["clienteNome"], $_POST["clienteCognome"],
				$_POST["clienteDataNascita"], $_POST["clienteTelefono"], $_POST["clienteMail"]);
			}catch (Exception $e) {
				echo 'Errore: è stato inserito un utente già presente. ';
			}
			
		}
	}

    require("template/base.php");

?>
