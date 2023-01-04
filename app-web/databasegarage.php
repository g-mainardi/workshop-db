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
        $statement->bind_param('ssis', $casa_produttrice, $modello, $data_produzione, $cilindrata);
        $statement->execute();
    }

    #per ogni transazione fare l'update dell'attestao ovvero cambiare il CF_proprietario
    public function insertTransaction($CF_cliente, $cod_veicolo, $CF_agente, $prezzo, $data_transazione, $tipologia){
        $statement = $this->db->prepare('INSERT INTO TRANSAZIONE(CF_cliente, cod_veicolo, CF_agente, prezzo, data_transazione, tipologia) VALUES(?, ?, ?, ?, ?, ?)');
        $statement->bind_param('sisiss', $CF_cliente, $cod_veicolo, $CF_agente, $prezzo, $data_transazione, $tipologia);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertOwnershipCertificate($CF_proprietario, $cod_veicolo, $scaduto, $data_attestato){
        $statement = $this->db->prepare('INSERT INTO ATTESTATO_PROPRIETA(CF_proprietario, cod_veicolo, scaduto, data_attestato	) VALUES(?, ?, ?, ?)');
        $statement->bind_param('siis', $CF_proprietario, $cod_veicolo, $scaduto, $data_attestato);
        $statement->execute();
    }

    public function insertPiece($nome, $cod_veicolo, $costo_unitario, $descrizione){
        $statement = $this->db->prepare('INSERT INTO PEZZO_RICAMBIO(nome, cod_veicolo, costo_unitario, descrizione) VALUES(?, ?, ?, ?)');
        $statement->bind_param('siis', $nome, $cod_veicolo, $costo_unitario, $descrizione);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertRepair($CF_cliente, $cod_veicolo, $data_inizio, $data_fine, $costo_totale){
        $statement = $this->db->prepare('INSERT INTO RIPARAZIONE(CF_cliente, cod_veicolo, data_inizio, data_fine, costo_totale) VALUES(?, ?, ?, ?, ?)');
        $statement->bind_param('sissi', $CF_cliente, $cod_veicolo, $data_inizio, $data_fine, $costo_totale);
        $statement->execute();
    }
    
    public function insertMechanicIntoReparation($CF_meccanico, $id_riparazione){
        $statement = $this->db->prepare('INSERT INTO COMPRENDE_MECCANICO(CF_meccanico, id_riparazione) VALUES(?, ?)');
        $statement->bind_param('si', $CF_meccanico, $id_riparazione);
        $statement->execute();
    }

    public function insertPieceIntoReparation($id_pezzo, $id_riparazione){
        $statement = $this->db->prepare('INSERT INTO COMPRENDE_PEZZO(id_pezzo, id_riparazione) VALUES(?, ?)');
        $statement->bind_param('ii', $id_pezzo, $id_riparazione);
        $statement->execute();
    }

    public function updateCertificate($scaduto, $CF_proprietario, $cod_veicolo ){
            $statement = $this->db->prepare("UPDATE ATTESTATO_PROPRIETA
                                            SET scaduto = ?,
                                            CF_proprietario = ?
                                            WHERE cod_veicolo =  ? ");
        $statement->bind_param("isi", $scaduto, $CF_proprietario, $cod_veicolo);
        $statement->execute();
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
		$statement = $this->db->prepare("SELECT * FROM AGENTE WHERE codice_fiscale = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}

    public function checkClient($codice_fiscale){
		$statement = $this->db->prepare("SELECT * FROM cliente WHERE codice_fiscale = ?");
		$statement->bind_param('s', $codice_fiscale);
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
        $statement = $this->db->prepare("SELECT cod_veicolo, data_attestato FROM ATTESTATO_PROPRIETA WHERE CF_proprietario = ?");
		$statement->bind_param('is', $cod_veicolo, $data_attestato);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    #visualizzazione attestato di proprietà valido per un determinato utente se c'è
    public function getValidOwnershipCertificate($CF){
        $scaduto = 0;
        $statement = $this->db->prepare("SELECT cod_veicolo, data_attestato FROM ATTESTATO_PROPRIETA WHERE CF_proprietario = ? AND scaduto = $scaduto");
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

    #stampa proprietario del veicolo se c'è sennò stampa che è di proprietà dell'officina(ovvero se tutti hanno scaduto=1)
    public function getActualOwnerForCar($cod_veicolo){
        $statement = $this->db->prepare("SELECT CF_proprietario FROM ATTESTATO_PROPRIETA WHERE cod_veicolo = ? AND scaduto = 0");
		$statement->bind_param('i', $cod_veicolo);
		$statement->execute();
		$result = $statement->get_result();
		$data = $result->fetch_array(MYSQLI_ASSOC);
        if(empty($data["CF_proprietario"])){
            return "officina";
        }else{
            return $data["CF_proprietario"];
        }
    }

    #dal modello data di produzione e casa produttrice individuare il codice veicolo
    public function getCarCod($modello, $casa_produttrice, $data_produzione){
        $statement = $this->db->prepare("SELECT cod_veicolo FROM VEICOLO WHERE modello = ? AND casa_produttrice = ? AND data_produzione = ? ");
		$statement->bind_param('ssi', $modello, $casa_produttrice, $data_produzione);
		$statement->execute();
		$result = $statement->get_result();
		$data = $result->fetch_array(MYSQLI_ASSOC);
        return $data["cod_veicolo"];
    }

    public function getAllClientsCar(){
        $statement = $this->db->prepare("SELECT v.*,a.CF_proprietario, c.nome  AS 'nome_proprietario', c.cognome AS 'cognome_proprietario'
        FROM ATTESTATO_PROPRIETA a 
        JOIN VEICOLO v ON a.cod_veicolo = v.cod_veicolo 
        JOIN CLIENTE c ON a.CF_proprietario = c.codice_fiscale
        WHERE a.scaduto=0");
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

    public function checkCar($modello, $casa_produttrice, $anno_produzione){
        $statement = $this->db->prepare("SELECT * FROM VEICOLO WHERE modello = ? AND casa_produttrice = ? AND data_produzione = ? ");
        $statement->bind_param('ssi', $modello, $casa_produttrice, $data_produzione);
        $statement->execute();
		$result = $statement->get_result();
		
		if(empty($result->fetch_all(MYSQLI_ASSOC))){
            return 0;
        }else{
            return 1;
        }
    }

    public function getClientValidCar($scaduto, $CF_cliente){
        $statement = $this->db->prepare("SELECT v.* FROM attestato_proprieta a, veicolo v WHERE a.cod_veicolo = v.cod_veicolo AND scaduto=? AND CF_proprietario=?");
        $statement->bind_param('is', $scaduto, $CF_cliente);
        $statement->execute();
        $result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGarageCar($scaduto){
        $statement = $this->db->prepare("SELECT *  FROM ATTESTATO_PROPRIETA a JOIN VEICOLO v ON a.cod_veicolo = v.cod_veicolo WHERE a.scaduto=? ");
        $statement->bind_param('i', $scaduto);
        $statement->execute();
        $result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTransactions(){
        $statement = $this->db->prepare("SELECT * FROM TRANSAZIONE ");
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllMechanics(){
        $statement = $this->db->prepare("SELECT * FROM MECCANICO ");
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllPieces(){
        $statement = $this->db->prepare("SELECT * FROM PEZZO_RICAMBIO ");
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCarSpecific($cod_veicolo){
        $statement = $this->db->prepare("SELECT * FROM VEICOLO WHERE cod_veicolo = ?");
        $statement->bind_param('i', $cod_veicolo);
		$statement->execute();
		$result = $statement->get_result();
		$data = $result->fetch_array(MYSQLI_ASSOC);
        return $data["modello"]." - ".$data["casa_produttrice"];
    }

    public function getUser($codice_fiscale){
        $statement = $this->db->prepare("SELECT * FROM CLIENTE WHERE codice_fiscale = ? ");
        $statement->bind_param('s', $codice_fiscale);
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkActiveCertificate($cod_veicolo, $scaduto){
        $statement = $this->db->prepare("SELECT * FROM ATTESTATO_PROPRIETA WHERE cod_veicolo = ? AND scaduto = ? ");
        $statement->bind_param('ii', $cod_veicolo, $scaduto);
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

    public function getRepairId($CF_cliente, $cod_veicolo, $data_inizio, $data_fine, $costo_totale){
        $statement = $this->db->prepare("SELECT id_riparazione FROM RIPARAZIONE WHERE CF_cliente = ? AND cod_veicolo = ? AND data_inizio = ? AND data_fine = ? AND costo_totale = ?");
        $statement->bind_param('sissi', $CF_cliente, $cod_veicolo, $data_inizio, $data_fine, $costo_totale);
        $statement->execute();
		$result = $statement->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCarPieces($cod_veicolo){
        $statement = $this->db->prepare("SELECT * FROM PEZZO_RICAMBIO WHERE cod_veicolo = ? ");
        $statement->bind_param('i', $cod_veicolo);
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllRepairs(){
        $statement = $this->db->prepare("SELECT * FROM RIPARAZIONE ");
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }
}


?>
