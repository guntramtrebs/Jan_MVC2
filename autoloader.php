<?php
   session_start();//Sessionverwaltung freischalten
   // Laden ini Datei
   //true = mehrdimensionales assoziatives Array
   $ini =  parse_ini_file('termine.ini'); //true
   //print_r($ini); //test
   //echo $ini['db_name'];//test
   define('INI',$ini);// als Konstante definieren
   //echo INI['db_name'];// Ausgabe einer Konstante aus einer ini Datei
   require_once 'php/db_init.php';//Datenbank on the fly
   //Klassen bereitstellen
   spl_autoload_register(function($class_name){
      require_once 'class/class_'.$class_name.'.php';
   })
?>