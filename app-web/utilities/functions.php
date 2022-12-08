<?php 
    function checkUserInputDigit($nome, $cognome, $cf, $telefono, $mail){
        // Controllo se sono inseriti nome e cognome
        if(strlen($nome) <= 0 || strlen($cognome) <= 0){
            echo "Nome e cognome non possono essere vuoti<br>";
            return false;
        } else if($mail != "" && !filter_var($mail, FILTER_VALIDATE_EMAIL)){
            // Controllo se mail inserita correttamente
            echo "L'email non ha un giusto formato<br>" . $mail;
            return false;
        } else if(strlen($cf) != 16){
            // Controllo se CF inserito correttamente
            echo "Il codice fiscale è composto da esattamente 16 caratteri<br>";
            return false;
        } else if(!is_numeric($telefono)){
            // Controllo se telefono inserito correttamente
            echo "Numero di telefono non valido<br>";
            return false;
        } else{
            return true;
        }
    }
    
?>