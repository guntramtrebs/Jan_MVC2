<?php
class View{
private static $output;//leer

public static function setLayout($tpl,$data = ''){
    // Aufbau des Layouts aus mehreren Teilen
   ob_start();// PHP Puffer für externe Berechnungen
            
          require_once('tpl/head.tpl.php');// HTML Kopfdaten

          if(isset($_SESSION['user'])){//user ist angemeldet
            require_once('tpl/logout.tpl.php');
          }else{//user ist nicht angemeldet
            require_once('tpl/login.tpl.php');
          }
          ?>
          <main>
          <?php
          require_once('tpl/'.$tpl.'.tpl.php');
          require_once('tpl/footer.tpl.php');
          ?>
          <!-- Jan Hill -->
          <?PHP 
   self::$output  = ob_get_contents();//bei Bedarf Zwischenstand auslesen
   ob_end_clean();//Puffer löschen
   self::toDisplay();//Aufruf der Ausgabe
}

public static function toDisplay(){
    echo self::$output; //Ausgabe an User
}


}


?>