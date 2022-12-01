<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione clienti";
    $SetParameters["file"] = "nuovo_cliente.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo clienti dal database
	$SetParameters["clienti"] = $db->getClients();
	
	if(isset($_POST["aggiornaTelefono"])){
		$type = $db->getDependentType($_POST["clienteCF"]);
		$db->updateTelephone( $_POST["clienteTelefono"], $_POST["clienteCF"], $type);
		#echo "aggiornato: ".$_POST["clienteCF"]." numero: ".$_POST["clienteTelefono"];
	}
	if(isset($_POST["aggiornaMail"])){
		$type = $db->getDependentType($_POST["clienteCF"]);
		$db->updateEmail($_POST["clienteMail"], $_POST["clienteCF"], $type);
		echo "<meta http-equiv='refresh' content='0'>";
		
		#echo "aggiornato: ".$_POST["clienteCF"]." Mail: ".$_POST["clienteMail"];
	}
	if(isset($_POST["aggiornaTutto"])){
		$db->updateEverythingClient($_POST["clienteMail"], $_POST["clienteTelefono"], $_POST["clienteCF"]);
		#echo "aggiornato: ".$_POST["clienteCF"]." numero: ".$_POST["clienteTelefono"]." Mail: ".$_POST["clienteMail"];
	}
	
	if(isset($_POST["inserisciCliente"])){
		if(isset($_POST["clienteCF"]) && isset($_POST["clienteNome"]) && isset($_POST["clienteCognome"]) 
		&& isset($_POST["clienteTelefono"]) && isset($_POST["clienteDataNascita"]))
		{
			$error = false;
			// Controllo se sono inseriti nome e cognome
			if(strlen($_POST['clienteNome']) <= 0 || strlen($_POST['clienteCognome']) <= 0){
				echo "Nome e cognome non possono essere vuoti<br>";
				$error = true;
			}
			// Controllo se mail inserita correttamente
			if($_POST["clienteMail"] != "" && !filter_var($_POST['clienteMail'], FILTER_VALIDATE_EMAIL)){
				echo "L'email non ha un giusto formato<br>" . $_POST["clienteMail"];
				$error = true;
			}
			// Controllo se CF inserito correttamente
			if(strlen($_POST['clienteCF']) != 16){
				echo "Il codice fiscale è composto da esattamente 16 caratteri<br>";
				$error = true;
			}
			// Controllo se telefono inserito correttamente
			if(!is_numeric($_POST['clienteTelefono'])){
				echo "Numero di telefono non valido<br>";
				$error = true;
			}
			if(!$error){
				// Inserisco cliente nel database
				try{
					$db->insertCliente($_POST["clienteCF"], $_POST["clienteNome"], $_POST["clienteCognome"],
					$_POST["clienteDataNascita"], $_POST["clienteTelefono"], $_POST["clienteMail"]);
				}catch (Exception $e) {
					echo 'Errore: è stato inserito un utente già presente. ';
				}
				
			}
    	}
	}

    require("template/base.php");

?>
