<?php 

// Funzione per il controllo dei dati all'inserimento di un utente
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

// Funzione per ottenere nome del mese (italiano)
function monthName($number){
    switch($number){
        case 1:
            return "gennaio";
        case 2:
            return "febbraio";
        case 3:
            return "marzo";
        case 4:
            return "aprile";
        case 5:
            return "maggio";
        case 6:
            return "giugno";
        case 7:
            return "luglio";
        case 8:
            return "agosto";
        case 9:
            return "settembre";
        case 10:
            return "ottobre";
        case 11:
            return "novembre";
        case 12:
            return "dicembre";
    }
}
    
?>