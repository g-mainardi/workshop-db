<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione clienti";
    $SetParameters["file"] = "nuovo_cliente.php";

	// Leggo clienti dal database
	$SetParameters["clienti"] = [array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
									"cognome" => "rossi",	"telefono" => "3428990332", 
									"data_nascita" => "1965-10-21", "mail" => ""),
									array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
									"cognome" => "rossi",	"telefono" => "3428990332", 
									"data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com"),
									array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
									"cognome" => "rossi",	"telefono" => "3428990332", 
									"data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com"),
									array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
									"cognome" => "rossi",	"telefono" => "3428990332", 
									"data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com"),
									array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
									"cognome" => "rossi",	"telefono" => "3428990332", 
									"data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com")];  // $db->getClienti()
	
	if(isset($_POST["aggiornaTelefono"])){
		/*
		$db->updateClientTelephone($_POST["clienteCF"], $_POST["clienteTelefono"]);
		*/
		echo "aggiornato: ".$_POST["clienteCF"]." numero: ".$_POST["clienteTelefono"];
	}
	if(isset($_POST["aggiornaMail"])){
		/*
		$db->updateClientMail($_POST["clienteCF"], $_POST["clienteMail"]);
		*/
		echo "aggiornato: ".$_POST["clienteCF"]." Mail: ".$_POST["clienteMail"];
	}

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
		/*
		// Controllo se CF già presente
		if($db->checkAll(($_POST['clienteCF']))!=0)
		{
			echo "CF gia presente nel database<br>";
			$error = true;
		}
		*/
		if(!$error){
			// Inserisco cliente nel database
			/*
			$db->insertCliente($_POST["clienteCF"], $_POST["clienteNome"], $_POST["clienteCognome"],
					$_POST["clienteTelefono"], $_POST["clienteDataNascita"], $_POST["clienteMail"]);
			*/
			$SetParameters["clienti"][] = array("CF" => $_POST["clienteCF"], "nome" => $_POST["clienteNome"],
										"cognome" => $_POST["clienteCognome"],	"telefono" => $_POST["clienteTelefono"], 
										"data_nascita" => $_POST["clienteDataNascita"], "mail" => $_POST["clienteMail"]);
		}
    }

    require("template/base.php");

?>