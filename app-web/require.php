<?php
session_start();

// Importo funzioni
require_once("utilities/functions.php");

// Connessione al database 
require_once("databasegarage.php");
$db = new DatabaseHelper("127.0.0.1", "root", "", "officina", 3306);

// Definisco costanti
define("UPLOAD_DIR", "./upload/");

// Creo array per gli scripts
$SetParameters["scripts"] = array();
?>
