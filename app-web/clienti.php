<?php

    require_once 'require.php';

    $SetParameters["titolo"] = "Inserimento cliente";
    $SetParameters["file"] = "nuovocliente.php";
    $SetParameters["clienti"] = [array("CF" => "BRGPEP65P21R889T", "nome" => "peppe",
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
										 "data_nascita" => "1965-10-21", "mail" => "borgia.peppe@gmail.com")];  // $db->getClienti()


    if(isset($_POST["clienteCF"]) && isset($_POST["clienteNome"]) && isset($_POST["clienteCognome"]) && isset($_POST["clienteTelefono"]) && isset($_POST["clienteDataNascita"]) && isset($_POST["clienteLuogoNascita"]) && isset($_POST["clienteIndirizzo"]) && isset($_POST["clienteMail"]) && isset($_POST["dottore"]) && ($_POST["dottore"]!=0)){
			$error = false;
			// Controllo se sono inseriti nome e cognome
			if(strlen($_POST['clienteNome']) <= 0 || strlen($_POST['clienteCognome']) <= 0){
				echo "Nome e cognome non possono essere vuoti<br>";
				$error = true;
			}
			// Controllo se mail inserita correttamente
			if(!filter_var($_POST['clienteMail'], FILTER_VALIDATE_EMAIL)){
				echo "L'email non ha un giusto formato<br>";
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
			// Controllo se CF già presente
			if($db->checkAll(($_POST['clienteCF']))!=0)
			{
				echo "CF gia presente nel database<br>";
				$error = true;
			}
			if(!$error){
				$db->insertCliente($_POST["clienteCF"], $_POST["clienteNome"], $_POST["clienteCognome"], $_POST["clienteTelefono"], $_POST["clienteDataNascita"], $_POST["clienteLuogoNascita"], $_POST["clienteIndirizzo"], $_POST["clienteMail"], $_POST["dottore"]);
			}
        }

    require("template/base.php");

?>