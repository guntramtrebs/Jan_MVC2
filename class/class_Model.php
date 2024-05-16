<?php
// Keine Kontrollstrukturen/Schleifen
// nur SQL Anweisungen
// Funktionsaufrufe

class Model{
############ Service ##########
private static $myPDO;  //steht in Model Klasse zu Verfügung  
private static function dbConnect(){
    self::$myPDO = new PDO('mysql:host='.INI['host'].';dbname='.INI['db_name'].';charset=utf8',
                      INI['user'] ,    INI['pass']   );     
}

private static function setPrepare($sql){
    self::dbConnect();
    return self::$myPDO->prepare($sql);//SQL injection sicher bereitstellen im Arbeitsspeicher
}
//Eintragen
private static function setIntoDB($mask){
   return $mask->execute();
}
//auslesen -> als array
private static function getArrayFromDB($mask){
    $mask->execute();
    return $mask->fetchAll(PDO::FETCH_ASSOC);// Rückgabe als assoziatives array
}
//auslesen als 1 Wert
private static function getOne($mask){
    $mask->execute();
    return $mask->fetchColumn();// String,Int, Bool... 1 Wert
}

########################## Anfragen ##########################

public static function getAllEventsFromDB($id_user){
    $mask = self::setPrepare('SELECT * FROM tb_event WHERE id_user=:id');
    $mask->bindValue(':id',$id_user,PDO::PARAM_INT);
    return self::getArrayFromDB($mask);
}

public static function addEventIntoDB($event,$time,$id_user){ 
    $mask = self::setPrepare('INSERT INTO tb_event (event,time,id_user)
                      VALUES (:e,:t,:i)');
    $mask->bindValue(':e',$event,PDO::PARAM_STR);
    $mask->bindValue(':t',$time,PDO::PARAM_STR);
    $mask->bindValue(':i',$id_user,PDO::PARAM_INT);
    return self::setIntoDB($mask);
}
public static function deleteEventInDB($id){
    $mask = self::setPrepare('DELETE FROM tb_event WHERE id=?');
    $mask->bindValue(1,$id,PDO::PARAM_INT);
    return self::setIntoDB($mask);
}
// Abholen id , argon2hash
public static function getIdHashFromDB($name){
    $mask = self::setPrepare('SELECT id,password FROM tb_user 
                              WHERE name=?');
     $mask->bindValue(1,$name,PDO::PARAM_STR);
     return self::getArrayFromDB($mask);// Rückgabe array                          
}

}

?>