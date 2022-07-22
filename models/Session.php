<?php

namespace Models;

require_once 'config/config.php';

require_once 'config/test.php';

class Session {

    public function getSession($email)
    {
        $query = connex()->prepare(
    
        "SELECT * FROM users
        WHERE email = ?");

        $query->execute([$email]);
        return $query->fetch();
    }

}

?>


