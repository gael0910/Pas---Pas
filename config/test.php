<?php

function connex()
{
    try
    {
        $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    
        return $dbh;
    }
    catch(Exeption $e)
    {
        die('Erreur : ' . $e-> getMessage());   
    }
}



?>
