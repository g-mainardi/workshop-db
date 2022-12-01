<?php
class DatabaseHelper {
	private $db;
	
	public function __construct($servername, $username, $password, $dbname, $port) {
		$this->db = new mysqli($servername, $username, $password, $dbname, $port);
		if($this->db->connect_error) {
			die("Connection failed!");
		}
	}
    
    public function insertCliente($CF, $nome, $cognome, $data_di_nascita, $telefono, $email) {
        $statement = $this->db->prepare('INSERT INTO CLIENTE(codice_fiscale, nome, cognome, data_nascita, telefono, email) VALUES(?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssss', $CF, $nome, $cognome, $data_di_nascita, $telefono, $email);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertAgente($CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria) {
        $statement = $this->db->prepare('INSERT INTO AGENTE(codice_fiscale, nome, cognome, data_nascita, telefono, email, paga_oraria) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssisi', $CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertMeccanico($CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria) {
        $statement = $this->db->prepare('INSERT INTO MECCANICO(codice_fiscale, nome, cognome, data_nascita, telefono, email, paga_oraria) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssisi', $CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    #avro un metodo per ottenere un codice veicolo passando una casa produtrrive un modello e una data di produzione
    public function insertCar($casa_produttrice, $modello, $data_produzione, $cilindrata){
        $statement = $this->db->prepare('INSERT INTO VEICOLO(casa_produttrice, modello, data_produzione, cilindrata) VALUES(?, ?, ?, ?)');
        $statement->bind_param('ssss', $casa_produttrice, $modello, $data_produzione, $cilindrata);
        $statement->execute();
        /*
        $cod_veicolo = $this->getCarCod($modello, $casa_produttrice, $data_produzione);
        $this->insertOwnershipCertificate($CF, $cod_veicolo, $data_appropriazione, $scaduto);*/
    }

    #per ogni transazione fare l'update dell'attestao ovvero cambiare il CF_proprietario
    public function insertTransaction($CF_cliente, $cod_veicolo, $CF_agente, $prezzo, $data_transazione, $tipologia){
        $statement = $this->db->prepare('INSERT INTO TRANSAZIONE(CF_cliente, cod_veicolo, CF_agente, prezzo, data_transazione, tipologia) VALUES(?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssissss', $CF_cliente, $cod_veicolo, $CF_agente, $prezzo, $data_transazione, $tipologia);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
    #a livello di applicazione fare un if, se la transazione è di tipo acquisto allora scaduto deve essere posto a 1 in alternativa a 0
    #se quindi la transazione è di tipo vendita il cf viene aggiornato in alternativa lo mettosolo a scaduto
    public function updateCertificate($CF_proprietario, $tipologia, $cod_veicolo){
        if ($tipologia == "acquisto"){
            $varScaduto = 1;
            $statement = $this->db->prepare("UPDATE ATTESTATO_PROPRIETA
                                            SET scaduto = $varScaduto 
                                            WHERE cod_veicolo =  $cod_veicolo ");
            $statement->bind_param("ii", $varScaduto, $cod_veicolo);
        }
    }
    /*
    public fuction insertRepair($CF_cliente, $CF_meccanico, $data_inizio, $data_fine, $costo_totale, $cod_veicolo){
        $statement = $this->db->prepare('INSERT INTO RIPARAZIONE(CF_cliente, CF_meccanico, data_inizio, data_fine, costo_totale, cod_veicolo) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssi', $CF_cliente, $CF_meccanico, $data_inizio, $data_fine, $costo_totale, $cod_veicolo);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
    */
    public function insertOwnershipCertificate($CF_proprietario, $cod_veicolo, $scaduto, $data_produzione){
        $statement = $this->db->prepare('INSERT INTO ATTESTATO_PROPRIETA(CF_proprietario, cod_veicolo, scaduto, data_produzione	) VALUES(?, ?, ?, ?)');
        $statement->bind_param('siis', $CF_proprietario, $cod_veicolo, $scaduto, $data_produzione);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
        #echo "<meta http-equiv='refresh' content='0'>";
    }

    public function getDependentType($CF){
        if (!empty($this->checkClient($CF))){
            return 0;
        }else if (!empty($this->checkAgent($CF))){
            return 1;
        }else if (!empty($this->checkMechanic($CF))){
            return 2;
        }
    }

    public function getAgents(){
        $statement = $this->db->prepare("SELECT * FROM AGENTE");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllMechanical(){
        $statement = $this->db->prepare("SELECT * FROM MECCANICO");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllClient(){
        $statement = $this->db->prepare("SELECT * FROM CLIENTE");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkAgent($CF){
		$statement = $this->db->prepare("SELECT * FROM AGENTE WHERE codice_fiscale = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}

    public function checkClient($CF){
		$statement = $this->db->prepare("SELECT * FROM CLIENTE WHERE codice_fiscale = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}


    public function checkMechanic($CF){
		$statement = $this->db->prepare("SELECT * FROM MECCANICO WHERE codice_fiscale = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}

    public function updateEmail($email, $CF, $type){
        if ($type == 0){
            $statement = $this->db->prepare("UPDATE CLIENTE SET CLIENTE.email = ? WHERE CLIENTE.codice_fiscale = ? ");
        }else if ($type == 1){
            echo($email);
            echo($CF);
            $statement = $this->db->prepare("UPDATE AGENTE
                                            SET email = ? 
                                            WHERE AGENTE.codice_fiscale = ?");
        }else if ($type == 2){
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET email = ? 
                                            WHERE MECCANICO.codice_fiscale = ?");
        }
        $statement->bind_param('ss', $email, $CF);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function updateTelephone($telefono, $CF, $type){
        if ($type == 0){
            $statement = $this->db->prepare("UPDATE CLIENTE
                                            SET telefono = ? 
                                            WHERE codice_fiscale =  ?");
        }else if ($type == 1){
            $statement = $this->db->prepare("UPDATE AGENTE
                                            SET telefono = ?  
                                            WHERE codice_fiscale =  ?");
        }else if ($type == 2){
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET telefono = ? 
                                            WHERE codice_fiscale =  ?");
        }
            $statement->bind_param('ss', $telefono, $CF);
            $statement->execute();
            echo "<meta http-equiv='refresh' content='0'>";
    }

    public function updatePagaOraria($paga_oraria, $CF, $type){
        if ($type == 1){
            $statement = $this->db->prepare("UPDATE AGENTE
                                            SET paga_oraria = ? 
                                            WHERE codice_fiscale =  ?");
        }else if ($type == 2){
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET paga_oraria = ? 
                                            WHERE codice_fiscale =  ?");
        }
        $statement->bind_param('is', $paga_oraria, $CF);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
    
    public function updateEverythingClient($email, $telefono, $CF){
        $statement = $this->db->prepare("UPDATE CLIENTE
                                            SET email = ?, telefono = ?
                                            WHERE codice_fiscale =  ?");
        $statement->bind_param('sss', $email, $telefono, $CF);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function updateEverything($email, $telefono, $paga_oraria, $CF, $type){
        if ($type == 1){
            echo($paga_oraria);
            $statement = $this->db->prepare("UPDATE AGENTE SET email = ?, telefono = ?, paga_oraria = ? WHERE codice_fiscale =  ? ");
            $statement->bind_param('ssis', $email, $telefono, $paga_oraria, $CF);
        }else if ($type == 2){
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET email = ?, telefono = ?, paga_oraria = ?
                                            WHERE codice_fiscale =  ? ");
            $statement->bind_param('ssis', $email, $telefono, $paga_oraria, $CF);
        }
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
    
    #visualizzazione attestati per un determinato utente, sia scaduti che non
    public function getOwnershipForClient($CF){
        $statement = $this->db->prepare("SELECT cod_veicolo, data_produzione FROM ATTESTATO_PROPRIETA WHERE CF_proprietario = ?");
		$statement->bind_param('is', $cod_veicolo, $data_produzione);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    #visualizzazione attestato di proprietà valido per un determinato utente se c'è
    public function getValidOwnershipCertificate($CF){
        $scaduto = 0;
        $statement = $this->db->prepare("SELECT cod_veicolo, data_produzione FROM ATTESTATO_PROPRIETA WHERE CF_proprietario = ? AND scaduto = $scaduto");
		$statement->bind_param('si', $CF, $scaduto);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    #visualizzazione elenco tutti proprietari di un veicolo, ora prendo i cf poi capire se voglio i nomk
    public function getOwnersForCar($cod_veicolo){
        $statement = $this->db->prepare("SELECT CF_proprietario FROM ATTESTATO_PROPRIETA WHERE cod_veicolo = ? ");
		$statement->bind_param('i', $cod_veicolo);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    #stampa proprietario del veicolo se c'è sennò stampa che è di proprietà dell'officina(ovvero se scaduto=1)
    public function getActualOwnerForCar($cod_veicolo){
        $scaduto = 0;
        $statement = $this->db->prepare("SELECT CF_proprietario FROM ATTESTATO_PROPRIETA WHERE cod_veicolo = ? AND scaduto = $scaduto ");
		$statement->bind_param('ii', $cod_veicolo, $scaduto);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    #dal modello data di produzione e casa produttrice individuare il codice veicolo
    public function getCarCod($modello, $casa_produttrice, $data_produzione){
        $statement = $this->db->prepare("SELECT cod_veicolo FROM VEICOLO WHERE modello = ? AND casa_produttrice = ? AND data_produzione = ? ");
		$statement->bind_param('sss', $modello, $casa_produttrice, $data_produzione);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllCar(){
        $statement = $this->db->prepare("SELECT * FROM VEICOLO ");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    #ottieni0 tutti i codici
    public function getAllCarCodes(){
        $statement = $this->db->prepare("SELECT cod_veicolo FROM VEICOLO ");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getClients(){
        $statement = $this->db->prepare("SELECT * FROM CLIENTE");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }
}


?>
