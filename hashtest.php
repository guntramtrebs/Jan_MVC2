<?php
$eingabe = '456';
// ARGON2I moderne Hash Verschlüsselung
$hash = password_hash($eingabe,PASSWORD_ARGON2I);
echo $hash;
// hash in DB eintragen
// Passwort mit Datenbankeintrag prüfen
if(password_verify($eingabe,$hash)){
     echo "<br>Passwort war schalke04";
}
?>

######## Eigene Methode mit salt & pepper #####

<?php
$salt = 'dhgsreghcshSdsW';//sicher auf Server hinterlegen
$pepper = 'Fggsdv$f%5454v6';//sicher auf Server hinterlegen
$eingabe = 'schalke04';
// hash wir immer 128 Zeichen lang egal wieviel salt & pepper 
$hash_in_datenbank = hash('sha512',$salt.$eingabe.$pepper);
echo $hash_in_datenbank;
// Prüfung
$eingabe = 'schalke04';
if($hash_in_datenbank == hash('sha512',$salt.$eingabe.$pepper)){
    echo "Passwort war schalke04";
}



