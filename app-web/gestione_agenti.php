<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione agenti";
    $SetParameters["file"] = "nuovo_agente.php";
    $SetParameters["agenti"] = [array("CF" => "BRGPEP65P21R889T", "nome" => "peppe",
										 "cognome" => "borgia",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "borgia.peppe@gmail.com"),
										 array("CF" => "BRGPEP65P21R889T", "nome" => "peppe",
										 "cognome" => "borgia",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "borgia.peppe@gmail.com"),
										 array("CF" => "BRGPEP65P21R889T", "nome" => "peppe",
										 "cognome" => "borgia",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "borgia.peppe@gmail.com"),
										 array("CF" => "BRGPEP65P21R889T", "nome" => "peppe",
										 "cognome" => "borgia",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "borgia.peppe@gmail.com"),
										 array("CF" => "BRGPEP65P21R889T", "nome" => "peppe",
										 "cognome" => "borgia",	"telefono" => "3428990332", 
										 "data_nascita" => "1965-10-21", "mail" => "borgia.peppe@gmail.com")];  // $db->getAgenti()


    if(isset($_POST["agenteCF"]) && isset($_POST["agenteNome"]) && isset($_POST["agenteCognome"]) 
		&& isset($_POST["agenteTelefono"]) && isset($_POST["agenteDataNascita"])  && isset($_POST["agenteMail"])){
			$error = false;
			// Controllo se sono inseriti nome e cognome
			if(strlen($_POST['agenteNome']) <= 0 || strlen($_POST['agenteCognome']) <= 0){
				echo "Nome e cognome non possono essere vuoti<br>";
				$error = true;
			}
			// Controllo se mail inserita correttamente
			if(!filter_var($_POST['agenteMail'], FILTER_VALIDATE_EMAIL)){
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
			// Controllo se CF già presente
			if($db->checkAll(($_POST['agenteCF']))!=0)
			{
				echo "CF gia presente nel database<br>";
				$error = true;
			}
			if(!$error){
				$db->insertagente($_POST["agenteCF"], $_POST["agenteNome"], $_POST["agenteCognome"],
					 $_POST["agenteTelefono"], $_POST["agenteDataNascita"], $_POST["agenteMail"]);
			}
        }

    require("template/base.php");

?>