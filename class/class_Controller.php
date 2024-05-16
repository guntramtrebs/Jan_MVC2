<?php
class Controller{
  private $r;// alle Request assoziatives Array
  public function __construct(){
    //wird automatisch durch new Controller() gestartet
    //echo __METHOD__;//magische Konstante
    //$_SESSION['user'] = 1;
 
    $this->r = $_REQUEST;//Speichern von requests
    print_r($this->r );
    //letzter Key ist trigger für switch-case
    //www.meinewebseite.de/?edit=true&event.....&add_event=true
    switch(array_key_last($this->r)){   
      case 'edit' :    $this->getAllEvents();
                       break;
      case 'contact' : View::setLayout('contact');
                       break;
      case 'add_event':$this->setAddEvent();
                       break;
      case 'del':      $this->deleteEvent();
                       break; 
      case 'login':    $this->checkLogin();
                       break;
      case 'logout':   $this->checkLogout();
                       break;                                
      default: View::setLayout('start');           
    }
    // statische Ansprache von Methoden  $ins... =new View()
    //View::setLayout();//wird als Klasse benutzt 
  }

  public static function secure(){
    if(!isset($_SESSION['user'])){ //bist Du kein angemeldeter User
       header('Location: index.php');//landest Du auf der Startseite
       exit;
    }
  }


  private function checkLogout(){
   session_destroy();
   header('Location: index.php');//Zielseite
   exit;
  }




  private function checkLogin(){
    $data = Model::getIdHashFromDB($this->r['name']);
     $id = false;
     foreach($data as $spalte){
       if(password_verify($this->r['password'],$spalte['password'])){
          $id = $spalte['id'];// User und Passwort erkannt
       }
     }
    if($id)$_SESSION['user']= $id;// Eintrag in Session
    else {
         header('Location: index.php');// wenn nicht erfolgreich zurück Startseite
         exit;//kein weiteren Code ausführen
         }
    header('Location: index.php?edit=true');// nach erfolgreicher Anmeldung
  }

  private function deleteEvent(){
    foreach($this->r['del'] as $id){
      Model::deleteEventInDB($id);
    }
    header('Location: index.php?edit=true');
  }

  private function getAllEvents(){
     $data = Model::getAllEventsFromDB($_SESSION['user']);
     View::setLayout('edit',$data);
  }


  private function setAddEvent(){
    //                             text               Datum  id aus Tabelle User
    Model::addEventIntoDB($this->r['event'],$this->r['time'],$_SESSION['user']);
    header('Location: index.php?edit=true');//Erzwungene aktualisierung der Ansicht
  }


}
?>
