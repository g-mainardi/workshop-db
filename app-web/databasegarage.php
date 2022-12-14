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
        $statement = $this->db->prepare('INSERT INTO CLIENTE(CF_cliente, nome, cognome, data_nascita, telefono, email) VALUES(?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssss', $CF, $nome, $cognome, $data_di_nascita, $telefono, $email);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertAgente($CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria) {
        $statement = $this->db->prepare('INSERT INTO AGENTE(CF_agente, nome, cognome, data_nascita, telefono, email, paga_oraria) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssisi', $CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertMeccanico($CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria) {
        $statement = $this->db->prepare('INSERT INTO MECCANICO(CF_meccanico, nome, cognome, data_nascita, telefono, email, paga_oraria) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssssisi', $CF, $nome, $cognome, $data_di_nascita, $telefono, $mail, $paga_oraria);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    #avro un metodo per ottenere un codice veicolo passando una casa produtrrive un modello e una data di produzione
    public function insertVeicoloNuovo($casa_produttrice, $modello, $anno_produzione, $cilindrata){
        $statement = $this->db->prepare('INSERT INTO VEICOLO_NUOVO(casa_produttrice, modello, anno_produzione, cilindrata) VALUES(?, ?, ?, ?)');
        $statement->bind_param('ssis', $casa_produttrice, $modello, $anno_produzione, $cilindrata);
        $statement->execute();
    }

    public function insertVeicoloUsato($casa_produttrice, $modello, $anno_produzione, $cilindrata, $km_percorsi, $targa){
        $statement = $this->db->prepare('INSERT INTO VEICOLO_USATO(casa_produttrice, modello, anno_produzione, cilindrata, km_percorsi, targa) VALUES(?, ?, ?, ?, ?, ?)');
        $statement->bind_param('ssiiis', $casa_produttrice, $modello, $anno_produzione, $cilindrata, $km_percorsi, $targa);
        $statement->execute();
        #echo "<meta http-equiv='refresh' content='0'>";
    }

    #per ogni transazione fare l'update dell'attestao ovvero cambiare il CF_proprietario
    public function insertTransaction($CF_cliente, $targa, $CF_agente, $prezzo, $data_transazione, $tipologia, $ora_transazione){
        $statement = $this->db->prepare('INSERT INTO TRANSAZIONE(CF_cliente, targa, CF_agente, prezzo, data_transazione, tipologia, ora) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param('sssisss', $CF_cliente, $targa, $CF_agente, $prezzo, $data_transazione, $tipologia, $ora_transazione);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertAttestatoProprieta($CF_proprietario, $targa, $scaduto, $data_attestato){
        $statement = $this->db->prepare('INSERT INTO ATTESTATO_PROPRIETA(CF_proprietario, targa, scaduto, data_attestato	) VALUES(?, ?, ?, ?)');
        $statement->bind_param('ssis', $CF_proprietario, $targa, $scaduto, $data_attestato);
        $statement->execute();
    }

    public function insertPiece($nome, $targa, $costo_unitario, $descrizione){
        $statement = $this->db->prepare('INSERT INTO PEZZO_RICAMBIO(nome, targa, costo_unitario, descrizione) VALUES(?, ?, ?, ?)');
        $statement->bind_param('ssis', $nome, $targa, $costo_unitario, $descrizione);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function insertRepair($CF_cliente, $targa, $data_inizio, $data_fine, $costo_totale){
        $statement = $this->db->prepare('INSERT INTO RIPARAZIONE(CF_cliente, targa, data_inizio, data_fine, costo_totale) VALUES(?, ?, ?, ?, ?)');
        $statement->bind_param('ssssi', $CF_cliente, $targa, $data_inizio, $data_fine, $costo_totale);
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

    public function updateCertificate($scaduto, $CF_proprietario, $targa ){
            $statement = $this->db->prepare("UPDATE ATTESTATO_PROPRIETA
                                            SET scaduto = ?,
                                            CF_proprietario = ?
                                            WHERE targa =  ? ");
        $statement->bind_param("iss", $scaduto, $CF_proprietario, $targa);
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

    public function getAllVeicoliUsati(){
        $statement = $this->db->prepare("SELECT * FROM VEICOLO_USATO ");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllVeicoliNuovi(){
        $statement = $this->db->prepare("SELECT * FROM VEICOLO_NUOVO ");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkAgent($CF){
		$statement = $this->db->prepare("SELECT * FROM AGENTE WHERE CF_agente = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}

    public function checkClient($codice_fiscale){
		$statement = $this->db->prepare("SELECT * FROM cliente WHERE CF_cliente = ?");
		$statement->bind_param('s', $codice_fiscale);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}

    public function checkMechanic($CF){
		$statement = $this->db->prepare("SELECT * FROM MECCANICO WHERE CF_meccanico = ?");
		$statement->bind_param('s', $CF);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}

    public function updateEmail($email, $CF, $type){
        if ($type == 0){
            $statement = $this->db->prepare("UPDATE CLIENTE SET CLIENTE.email = ? WHERE CLIENTE.CF_cliente = ? ");
        }else if ($type == 1){
            echo($email);
            echo($CF);
            $statement = $this->db->prepare("UPDATE AGENTE
                                            SET email = ? 
                                            WHERE AGENTE.CF_agente = ?");
        }else if ($type == 2){
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET email = ? 
                                            WHERE MECCANICO.CF_meccanico = ?");
        }
        $statement->bind_param('ss', $email, $CF);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function updateTelephone($telefono, $CF, $type){
        if ($type == 0){
            $statement = $this->db->prepare("UPDATE CLIENTE
                                            SET telefono = ? 
                                            WHERE CF_cliente =  ?");
        }else if ($type == 1){
            $statement = $this->db->prepare("UPDATE AGENTE
                                            SET telefono = ?  
                                            WHERE CF_agente =  ?");
        }else if ($type == 2){
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET telefono = ? 
                                            WHERE CF_meccanico =  ?");
        }
            $statement->bind_param('ss', $telefono, $CF);
            $statement->execute();
            echo "<meta http-equiv='refresh' content='0'>";
    }

    public function updatePagaOraria($paga_oraria, $CF, $type){
        if ($type == 1){
            $statement = $this->db->prepare("UPDATE AGENTE
                                            SET paga_oraria = ? 
                                            WHERE CF_agente =  ?");
        }else if ($type == 2){
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET paga_oraria = ? 
                                            WHERE CF_meccanico =  ?");
        }
        $statement->bind_param('is', $paga_oraria, $CF);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
    
    public function updateEverythingClient($email, $telefono, $CF){
        $statement = $this->db->prepare("UPDATE CLIENTE
                                            SET email = ?, telefono = ?
                                            WHERE CF_cliente =  ?");
        $statement->bind_param('sss', $email, $telefono, $CF);
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    public function updateEverything($email, $telefono, $paga_oraria, $CF, $type){
        if ($type == 1){
            echo($paga_oraria);
            $statement = $this->db->prepare("UPDATE AGENTE SET email = ?, telefono = ?, paga_oraria = ? WHERE CF_agente =  ? ");
            $statement->bind_param('ssis', $email, $telefono, $paga_oraria, $CF);
        }else if ($type == 2){
            $statement = $this->db->prepare("UPDATE MECCANICO
                                            SET email = ?, telefono = ?, paga_oraria = ?
                                            WHERE CF_meccanico =  ? ");
            $statement->bind_param('ssis', $email, $telefono, $paga_oraria, $CF);
        }
        $statement->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
    
    public function deleteNuovoVeicolo($cod_veicolo_nuovo){
        $statement = $this->db->prepare("DELETE FROM VEICOLO_NUOVO WHERE cod_veicolo_nuovo = ?");
        $statement->bind_param('i', $cod_veicolo_nuovo);
        $statement->execute();
        #fvecho "<meta http-equiv='refresh' content='0'>";
    }

    #visualizzazione attestato di propriet?? valido per un determinato utente se c'??
    public function getValidOwnershipCertificate($CF){
        $scaduto = 0;
        $statement = $this->db->prepare("SELECT targa, data_attestato FROM ATTESTATO_PROPRIETA WHERE CF_proprietario = ? AND scaduto = $scaduto");
		$statement->bind_param('si', $CF, $scaduto);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    #visualizzazione elenco tutti proprietari di un veicolo, ora prendo i cf poi capire se voglio i nomk
    public function getOwnersForCar($targa){
        $statement = $this->db->prepare("SELECT CF_proprietario FROM ATTESTATO_PROPRIETA WHERE targa = ? ");
		$statement->bind_param('s', $targa);
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    #stampa proprietario del veicolo se c'?? senn?? stampa che ?? di propriet?? dell'officina(ovvero se tutti hanno scaduto=1)
    public function getActualOwnerForCar($targa){
        $statement = $this->db->prepare("SELECT CF_proprietario FROM ATTESTATO_PROPRIETA WHERE targa = ? AND scaduto = 0");
		$statement->bind_param('s', $targa);
		$statement->execute();
		$result = $statement->get_result();
		$data = $result->fetch_array(MYSQLI_ASSOC);
        if(empty($data["CF_proprietario"])){
            return "officina";
        }else{
            return $data["CF_proprietario"];
        }
    }

    public function getAllGarageCar(){
        $statement = $this->db->prepare("SELECT v.*
        FROM ATTESTATO_PROPRIETA a 
        JOIN VEICOLO_USATO v ON a.targa = v.targa
        WHERE a.scaduto=1");
		$statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllClientsCar(){
        $statement = $this->db->prepare("SELECT v.*,a.CF_proprietario, c.nome  AS 'nome_proprietario', c.cognome AS 'cognome_proprietario'
        FROM ATTESTATO_PROPRIETA a 
        JOIN VEICOLO_USATO v ON a.targa = v.targa
        JOIN CLIENTE c ON a.CF_proprietario = c.CF_cliente
        WHERE a.scaduto=0");
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
        $statement = $this->db->prepare("SELECT v.* FROM attestato_proprieta a, veicolo_usato v WHERE a.targa = v.targa AND scaduto=? AND CF_proprietario=?");
        $statement->bind_param('is', $scaduto, $CF_cliente);
        $statement->execute();
        $result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getVeicoloNuovo($cod_veicolo_nuovo){
        $statement = $this->db->prepare("SELECT * FROM VEICOLO_NUOVO WHERE cod_veicolo_nuovo = ?");
        $statement->bind_param('i', $cod_veicolo_nuovo);
        $statement->execute();
        $result = $statement->get_result();
       
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGarageCar($scaduto){
        $statement = $this->db->prepare("SELECT *  FROM ATTESTATO_PROPRIETA a JOIN VEICOLO_USATO v ON a.targa = v.targa WHERE a.scaduto=? ");
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

    public function getVeicoloUsatoSpecifico($targa){
        $statement = $this->db->prepare("SELECT * FROM VEICOLO_USATO WHERE targa = ?");
        $statement->bind_param('s', $targa);
		$statement->execute();
		$result = $statement->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data["casa_produttrice"]." - ".$data["modello"]." (".$data["anno_produzione"].")";
    }

    public function getVeicoloNuovoSpecifico($cod_veicolo){
        $statement = $this->db->prepare("SELECT * FROM VEICOLO_NUOVO WHERE cod_veicolo_nuovo = ?");
        $statement->bind_param('i', $cod_veicolo);
		$statement->execute();
		$result = $statement->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data["modello"]." - ".$data["casa_produttrice"];
    }

    public function getUser($codice_fiscale){
        $statement = $this->db->prepare("SELECT * FROM CLIENTE WHERE CF_cliente = ? ");
        $statement->bind_param('s', $codice_fiscale);
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkActiveCertificate($targa, $scaduto){
        $statement = $this->db->prepare("SELECT * FROM ATTESTATO_PROPRIETA WHERE targa = ? AND scaduto = ? ");
        $statement->bind_param('ii', $targa, $scaduto);
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRepairId($CF_cliente, $targa, $data_inizio, $data_fine, $costo_totale){
        $statement = $this->db->prepare("SELECT id_riparazione FROM RIPARAZIONE WHERE CF_cliente = ? AND targa = ? AND data_inizio = ? AND data_fine = ? AND costo_totale = ?");
        $statement->bind_param('ssssi', $CF_cliente, $targa, $data_inizio, $data_fine, $costo_totale);
        $statement->execute();
		$result = $statement->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCarPieces($targa){
        $statement = $this->db->prepare("SELECT * FROM PEZZO_RICAMBIO WHERE targa = ? ");
        $statement->bind_param('s', $targa);
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

    public function updateKmPercorsi($kmPercorsiVeicolo, $targa){
        $statement = $this->db->prepare("UPDATE VEICOLO_USATO
                                        SET km_percorsi = ?
                                        WHERE targa =  ?");
        $statement->bind_param('is', $kmPercorsiVeicolo, $targa);
        $statement->execute();
    }

    public function getCaseProduttriciConRiparazioni($anno_produzione){
        $statement = $this->db->prepare("SELECT casa_produttrice as nome, COUNT(casa_produttrice) AS n_riparazioni
                                         FROM riparazione, veicolo_usato
                                         WHERE riparazione.targa = veicolo_usato.targa
                                         AND YEAR(data_inizio) = ?
                                         GROUP BY casa_produttrice
                                         HAVING COUNT(casa_produttrice)>5
                                         ORDER BY COUNT(casa_produttrice) DESC");
        $statement->bind_param('i', $anno_produzione);
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMiglioriMeccanici(){
        $statement = $this->db->prepare("SELECT meccanico.CF_meccanico, meccanico.nome, meccanico.cognome, COUNT(meccanico.CF_meccanico) AS n_riparazioni
                                         FROM meccanico , comprende_meccanico
                                         WHERE comprende_meccanico.CF_meccanico = meccanico.CF_meccanico
                                         GROUP BY meccanico.CF_meccanico
                                         ORDER BY COUNT(meccanico.CF_meccanico) DESC LIMIT 5");
        $statement->execute();
		$result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchAgentOfMonth($anno, $mese) {
        $statement = $this->db->prepare("SELECT agente.CF_agente, agente.nome, agente.cognome, COUNT(DATE_FORMAT(data_transazione, '%m-%Y')) AS n_vendite
        FROM transazione, agente
        WHERE transazione.CF_agente=agente.CF_agente AND YEAR(data_transazione)=? AND MONTH(data_transazione)=?
        GROUP BY agente.CF_agente
        ORDER BY COUNT(DATE_FORMAT(data_transazione, '%m-%Y')) DESC
        LIMIT 1");
		$statement->bind_param('ss', $anno, $mese);
		$statement->execute();
		$result = $statement->get_result();
		return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function getRepairMechanics($id_riparazione){
        $statement = $this->db->prepare("SELECT m.* FROM MECCANICO m, COMPRENDE_MECCANICO c WHERE c.id_riparazione = ? AND m.CF_meccanico = c.CF_meccanico");
        $statement->bind_param('i', $id_riparazione);
        $statement->execute();
        $result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getRepairPieces($id_riparazione){
        $statement = $this->db->prepare("SELECT p.* FROM PEZZO_RICAMBIO p, COMPRENDE_PEZZO c WHERE c.id_riparazione = ? AND p.id_pezzo = c.id_pezzo");
        $statement->bind_param('i', $id_riparazione);
        $statement->execute();
        $result = $statement->get_result();
		
		return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>
