<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione agenti";
    $SetParameters["file"] = "nuovo_agente.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo agenti dal database
    $SetParameters["agenti"] = [array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
										 "cognome" => "rossi",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com", "paga" => "15"),
										 array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
										 "cognome" => "rossi",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "-", "paga" => "16"),
										 array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
										 "cognome" => "rossi",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com", "paga" => "13"),
										 array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
										 "cognome" => "rossi",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com", "paga" => "12"),
										 array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
										 "cognome" => "rossi",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "-", "paga" => "20")];  // $db->getAgenti()

	if(isset($_POST["aggiornaTelefono"])){
		/*
		$db->updateAgentTelephone($_POST["agenteCF"], $_POST["agenteTelefono"]);
		*/
		echo "aggiornato: ".$_POST["agenteCF"]." numero: ".$_POST["agenteTelefono"];
	}
	if(isset($_POST["aggiornaMail"])){
		/*
		$db->updateAgentMail($_POST["agenteCF"], $_POST["agenteMail"]);
		*/
		echo "aggiornato: ".$_POST["agenteCF"]." Mail: ".$_POST["agenteMail"];
	}
	if(isset($_POST["aggiornaPaga"])){
		/*
		$db->updateAgentPay($_POST["agenteCF"], $_POST["agentePaga"]);
		*/
		echo "aggiornato: ".$_POST["agenteCF"]." Paga: ".$_POST["agentePaga"];
	}
	if(isset($_POST["aggiornaTutto"])){
		/*
		$db->updateAgent($_POST["agenteCF"], $_POST["agenteTelefono"], $_POST["agenteMail"], $_POST["agentePaga"]);
		*/
		echo "aggiornato: ".$_POST["agenteCF"]." numero: ".$_POST["agenteTelefono"]." Mail: ".$_POST["agenteMail"]." Paga: ".$_POST["agentePaga"];
	}

    if(isset($_POST["agenteCF"]) && isset($_POST["agenteNome"]) && isset($_POST["agenteCognome"]) 
		&& isset($_POST["agenteTelefono"]) && isset($_POST["agenteDataNascita"])  && isset($_POST["agentePaga"])){
			$error = false;
			// Controllo se sono inseriti nome e cognome
			if(strlen($_POST['agenteNome']) <= 0 || strlen($_POST['agenteCognome']) <= 0){
				echo "Nome e cognome non possono essere vuoti<br>";
				$error = true;
			}
			// Controllo se mail inserita correttamente
			if($_POST["agenteMail"] != "" && !filter_var($_POST['agenteMail'], FILTER_VALIDATE_EMAIL)){
				echo "L'email non ha un giusto formato<br>";
				$error = true;
			}
			// Controllo se CF inserito correttamente
			if(strlen($_POST['agenteCF']) != 16){
				echo "Il codice fiscale è composto da esattamente 16 caratteri<br>";
				$error = true;
			}
			// Controllo se telefono inserito correttamente
			if(!is_numeric($_POST['agenteTelefono'])){
				echo "Numero di telefono non valido<br>";
				$error = true;
			}
			/*
			// Controllo se CF già presente
			if($db->checkAll(($_POST['agenteCF']))!=0)
			{
				echo "CF gia presente nel database<br>";
				$error = true;
			}
			*/
			if(!$error){
				// Inserisco agente nel database
				/*
				$db->insertagente($_POST["agenteCF"], $_POST["agenteNome"], $_POST["agenteCognome"],
					 $_POST["agenteTelefono"], $_POST["agenteDataNascita"], $_POST["agenteMail"]);
				*/
				$SetParameters["agenti"][] = array("CF" => $_POST["agenteCF"], "nome" => $_POST["agenteNome"],
										"cognome" => $_POST["agenteCognome"],	"telefono" => $_POST["agenteTelefono"], 
										"data_nascita" => $_POST["agenteDataNascita"], "mail" => $_POST["agenteMail"], "paga" => $_POST["agentePaga"]);
			}
        }

    require("template/base.php");

?>