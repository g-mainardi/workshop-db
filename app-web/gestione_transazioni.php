<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione transazioni";
    $SetParameters["file"] = "nuova_transazione.php";
    $SetParameters["transazioni"] = [array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
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
										 "data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com"),
										 array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
										 "cognome" => "rossi",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "rossi.mario@gmail.com")];  // $db->getTransazioni()


    if(isset($_POST["transazioneCF"]) && isset($_POST["transazioneNome"]) && isset($_POST["transazioneCognome"]) 
		&& isset($_POST["transazioneTelefono"]) && isset($_POST["transazioneDataNascita"]) && isset($_POST["transazioneMail"])){
			$error = false;
			// Controllo se sono inseriti nome e cognome
			if(strlen($_POST['transazioneNome']) <= 0 || strlen($_POST['transazioneCognome']) <= 0){
				echo "Nome e cognome non possono essere vuoti<br>";
				$error = true;
			}
			// Controllo se mail inserita correttamente
			if(!filter_var($_POST['transazioneMail'], FILTER_VALIDATE_EMAIL)){
				echo "L'email non ha un giusto formato<br>";
				$error = true;
			}
			// Controllo se CF inserito correttamente
			if(strlen($_POST['transazioneCF']) != 16){
				echo "Il codice fiscale è composto da esattamente 16 caratteri<br>";
				$error = true;
			}
			// Controllo se telefono inserito correttamente
			if(!is_numeric($_POST['transazioneTelefono'])){
				echo "Numero di telefono non valido<br>";
				$error = true;
			}
			// Controllo se CF già presente
			if($db->checkAll(($_POST['transazioneCF']))!=0)
			{
				echo "CF gia presente nel database<br>";
				$error = true;
			}
			if(!$error){
				$db->inserttransazione($_POST["transazioneCF"], $_POST["transazioneNome"], $_POST["transazioneCognome"],
					 $_POST["transazioneTelefono"], $_POST["transazioneDataNascita"], $_POST["transazioneMail"]);
			}
        }

    require("template/base.php");

?>