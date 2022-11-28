<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Gestione meccanici";
    $SetParameters["file"] = "nuovo_meccanico.php";
	array_push($SetParameters["scripts"], "./js/script.js");

	// Leggo meccanici dal database
    $SetParameters["meccanici"] = [array("CF" => "RSSMRA65P21R889T", "nome" => "mario",
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
										 "data_nascita" => "1965-10-21", "mail" => "-", "paga" => "20")];  // $db->getMechanics()

	if(isset($_POST["aggiornaTelefono"])){
		/*
		$db->updateMechanicTelephone($_POST["meccanicoCF"], $_POST["meccanicoTelefono"]);
		*/
		echo "aggiornato: ".$_POST["meccanicoCF"]." numero: ".$_POST["meccanicoTelefono"];
	}
	if(isset($_POST["aggiornaMail"])){
		/*
		$db->updateMechanicMail($_POST["meccanicoCF"], $_POST["meccanicoMail"]);
		*/
		echo "aggiornato: ".$_POST["meccanicoCF"]." Mail: ".$_POST["meccanicoMail"];
	}
	if(isset($_POST["aggiornaPaga"])){
		/*
		$db->updateMechanicPay($_POST["meccanicoCF"], $_POST["meccanicoPaga"]);
		*/
		echo "aggiornato: ".$_POST["meccanicoCF"]." Paga: ".$_POST["meccanicoPaga"];
	}
	if(isset($_POST["aggiornaTutto"])){
		/*
		$db->updateMechanic($_POST["meccanicoCF"], $_POST["meccanicoTelefono"], $_POST["meccanicoMail"], $_POST["meccanicoPaga"]);
		*/
		echo "aggiornato: ".$_POST["meccanicoCF"]." numero: ".$_POST["meccanicoTelefono"]." Mail: ".$_POST["meccanicoMail"]." Paga: ".$_POST["meccanicoPaga"];
	}

    if(isset($_POST["meccanicoCF"]) && isset($_POST["meccanicoNome"]) && isset($_POST["meccanicoCognome"]) 
		&& isset($_POST["meccanicoTelefono"]) && isset($_POST["meccanicoDataNascita"])  && isset($_POST["meccanicoPaga"])){
			$error = false;
			// Controllo se sono inseriti nome e cognome
			if(strlen($_POST['meccanicoNome']) <= 0 || strlen($_POST['meccanicoCognome']) <= 0){
				echo "Nome e cognome non possono essere vuoti<br>";
				$error = true;
			}
			// Controllo se mail inserita correttamente
			if($_POST["meccanicoMail"] != "" && !filter_var($_POST['meccanicoMail'], FILTER_VALIDATE_EMAIL)){
				echo "L'email non ha un giusto formato<br>";
				$error = true;
			}
			// Controllo se CF inserito correttamente
			if(strlen($_POST['meccanicoCF']) != 16){
				echo "Il codice fiscale è composto da esattamente 16 caratteri<br>";
				$error = true;
			}
			// Controllo se telefono inserito correttamente
			if(!is_numeric($_POST['meccanicoTelefono'])){
				echo "Numero di telefono non valido<br>";
				$error = true;
			}
			/*
			// Controllo se CF già presente
			if($db->checkAll(($_POST['meccanicoCF']))!=0)
			{
				echo "CF gia presente nel database<br>";
				$error = true;
			}
			*/
			if(!$error){
				// Inserisco meccanico nel database
				/*
				$db->insertmeccanico($_POST["meccanicoCF"], $_POST["meccanicoNome"], $_POST["meccanicoCognome"],
					 $_POST["meccanicoTelefono"], $_POST["meccanicoDataNascita"], $_POST["meccanicoMail"]);
				*/
				$SetParameters["meccanici"][] = array("CF" => $_POST["meccanicoCF"], "nome" => $_POST["meccanicoNome"],
										"cognome" => $_POST["meccanicoCognome"],	"telefono" => $_POST["meccanicoTelefono"], 
										"data_nascita" => $_POST["meccanicoDataNascita"], "mail" => $_POST["meccanicoMail"], "paga" => $_POST["meccanicoPaga"]);
			}
        }

    require("template/base.php");

?>