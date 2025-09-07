<?php

try {
    session_start();
    //connexion a la base de donnee
    //code...
    $bdd = new  PDO("mysql:host=localhost;dbname=locazen;charset=utf8", "root","");
} catch (Exception $e) {
    //throw $th;
    die('une erreur a ete trouvee : ' .$e->getMessage());
}
?>
