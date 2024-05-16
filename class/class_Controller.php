<?php
class Controller{
  private $r;// alle Request assoziatives Array
  public function __construct(){
    //wird automatisch durch new Controller() gestartet
    //echo __METHOD__;//magische Konstante
    $_SESSION['user'] = 1;
 
    $this->r = $_REQUEST;//Speichern von requests
    print_r($this->r );
    //letzter Key ist trigger für switch-case
    //www.meinewebseite.de/?edit=true&event.....&add_event=true
    switch(array_key_last($this->r)){   
      case 'edit' : $this->getAllEvents();
                    break;
      case 'contact' : View::setLayout('contact');
                    break;
      case 'add_event':$this->setAddEvent();
                    break;              
      default: View::setLayout('start');           
    }
    // statische Ansprache von Methoden  $ins... =new View()
    //View::setLayout();//wird als Klasse benutzt 
  }

  private function getAllEvents(){
     $data = Model::getAllEventsFromDB();
     View::setLayout('edit',$data);
  }


  private function setAddEvent(){
    //                             text               Datum  id aus Tabelle User
    Model::addEventIntoDB($this->r['event'],$this->r['time'],$_SESSION['user']);
    header('Location: index.php?edit=true');//Erzwungene aktualisierung der Ansicht
  }


}
?>
