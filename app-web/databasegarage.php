<?php
class DatabaseHelper {
	private $db;
	
	public function __construct($servername, $username, $password, $dbname, $port) {
		$this->db = new mysqli($servername, $username, $password, $dbname, $port);
		if($this->db->connect_error) {
			die("Connection failed!");
		}
	}
    
    public function insertCliente($CF, $nome, $cognome, $data_di_nascita, $telefono, $mail) {
        $statement = $this->db->prepare('INSERT INTO CLIENTE(codice_fiscale, nome, cognome, data_nascita, telefono, email) VALUES(?, ?, ?,?, ?, ?)');
        $statement->bind_param('ssssis', $CF, $nome, $cognome, $data_di_nascita, $telefono, $mail);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertAgente($CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, paga_oraria) {
        $statement = $this->db->prepare('INSERT INTO CLIENTE(codice_fiscale, nome, cognome, data_nascita, telefono, email, paga_oraria) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssisi', $CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertMeccanico($CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria) {
        $statement = $this->db->prepare('INSERT INTO CLIENTE(codice_fiscale, nome, cognome, data_nascita, telefono, email, paga_oraria) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssisi', $CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    #avro un metodo per ottenere un codice veicolo passando una casa produtrrive un modello e una data di produzione
    public function insertCar($casa_produttrice, $modello, $data_di_produzione, $cilindrata){
        $statement = $this->db->prepare('INSERT INTO VEICOLO(casa_produttrice, targa, modello, data_produzione, cilindrata) VALUES(?, ?, ?,?, ?)');
        $statement->bind_param('sssss', $casa_produttrice, $targa, $modello, $data_produzione, $cilindrata);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
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
        else if $tipologia == "acquisto":
            $varScaduto = 1;
            $statement = $this->db->prepare("UPDATE ATTESTATO_PROPRIETA
                                            SET scaduto = $varScaduto 
                                            WHERE cod_veicolo =  $cod_veicolo ");
            $statement->bind_param("ii", $varScaduto, $cod_veicolo);
    }

    public fuction insertRepair($CF_cliente, $CF_meccanico, $data_inizio, $data_fine, $costo_totale, $cod_veicolo){
        $statement = $this->db->prepare('INSERT INTO RIPARAZIONE(CF_cliente, CF_meccanico, data_inizio, data_fine, costo_totale, cod_veicolo) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssi', $CF_cliente, $CF_meccanico, $data_inizio, $data_fine, $costo_totale, $cod_veicolo);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertOwnershipCertificate($CF_proprietario, $cod_veicolo, $data_appropriazione){
        $scaduto = 0;
        $statement = $this->db->prepare('INSERT INTO ATTESTATO_PROPRIETA(CF_proprietario, cod_veicolo, scaduto, data_appropriazione) VALUES(?, ?, ?, )');
        $statement->bind_param('s', $CF_proprietario, $cod_veicolo);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function updatePagaOraria($CF, $paga_oraria){
        $type = getDependentType($CF);
        #è agente
        if $type == 0:
            $statement = $this->db->prepare("UPDATE AGENTE
                                            SET paga_oraria = $paga_oraria 
                                            WHERE CF =  $CF");
            $statement->bind_param('i', $CF_proprietario, $cod_veicolo);
            $statement->execute();
        #è meccanico
        else if $type == 1:
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET paga_oraria = $paga_oraria 
                                            WHERE CF =  $CF");
            $statement->bind_param('i', $CF_proprietario, $cod_veicolo);
            $statement->execute();

    }

    #se l'utente non esiste ritorna tre
    public function getDependentType($CF){
        if checkAgent($CF) == 0:
            return 0;
        else if checkClient($CF) == 0:
            return 1;
        else if checkMechanic($CF) == 0:
            return 2;
        return 3;
    }

    public function getAllAgents(){
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
		$statement = $this->db->prepare("SELECT * FROM AGENTE WHERE CF = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}

    public function checkClient($CF){
		$statement = $this->db->prepare("SELECT * FROM CLIENTE WHERE CF = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}


    public function checkMechanic($CF){
		$statement = $this->db->prepare("SELECT * FROM MECCANICO WHERE CF = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}

    public function updateEmail($CF, $email){
        $type = getDependentType($CF);
        if $type == 0:
            $statemente = $this->db->prepare("UPDATE AGENTE
                                          SET email = $email 
                                          WHERE CF =  $CF");
        else if $type == 1:
            $statemente = $this->db->prepare("UPDATE CLIENTE
                                          SET email = $email 
                                          WHERE CF =  $CF");
        else if $type == 2:
            $statemente = $this->db->prepare("UPDATE MECCANICO
                                          SET email = $email 
                                          WHERE CF =  $CF");
            $statement->bind_param('ss', $email, $CF);
            $statement->execute();
            $result = $statement->get_result();
    }

    public function updateTelephone($CF, $telefono){
        $type = getDependentType($CF);
        if $type == 0:
            $statemente = $this->db->prepare("UPDATE AGENTE
                                          SET telefono = $telefono 
                                          WHERE CF =  $CF");
        else if $type == 1:
            $statemente = $this->db->prepare("UPDATE CLIENTE
                                          SET telefono = $telefono  
                                          WHERE CF =  $CF");
        else if $type == 2:
            $statemente = $this->db->prepare("UPDATE MECCANICO
                                          SET telefono = $telefono 
                                          WHERE CF =  $CF");
            $statement->bind_param('ss', $telefono, $CF);
            $statement->execute();
            $result = $statement->get_result();
    }

    public function updateEverything($CF, $email, $telefono, $paga_oraria){
        updateEmail($CF, $email)
        updateTelephone($CF, $telefono)
        if $paga_oraria != null:
            updatePagaOraria($CF, $paga_oraria)
    }
}


?>