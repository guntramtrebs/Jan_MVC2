<?php
//Datenbank anlegen
// PDO = Klasse
// new lege Kopie des Objekts der Klasse PDO in den Arbeitsspeicher
// $myPDO = Instanz, verweist auf dieses Objekt, 
// mit Hilfe der Instanz ist Zugriff auf Methoden, Attribute möglich
$myPDO = new PDO('mysql:host='.INI['host'].';charset=utf8',   INI['user'] ,    INI['pass']   ); 
// erstmal Datenbank anlegen
$myPDO->exec('CREATE DATABASE IF NOT EXISTS '.INI['db_name']);
// Datenbank bereitstellen für Tabellen anlegen
$myPDO->exec('USE '.INI['db_name']);//Verbindung zur angelegten Datenbank herstellen
//Tabellen aufbauen
//Reihenfolge beachten zuerst die Tabellen ohne foreign keys
$myPDO->exec('CREATE TABLE IF NOT EXISTS tb_user(
                  id INT(11) PRIMARY KEY AUTO_INCREMENT,
                  name VARCHAR(255) NOT NULL,
                  password VARCHAR(128) NOT NULL
              )');
$myPDO->exec('CREATE TABLE IF NOT EXISTS tb_event(
                id INT(11) PRIMARY KEY AUTO_INCREMENT,
                event VARCHAR(100) DEFAULT "kein Eintrag",
                time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                id_user INT(11) NOT NULL,
                FOREIGN KEY(id_user) REFERENCES tb_user(id) 
             )');
 // geht nicht mehr           
 //$error = $myPDO->errorInfo();//SQL Fehler finden
 //echo $error[2];//Textausgabe
 
 