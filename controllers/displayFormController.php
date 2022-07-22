<?php

namespace Controllers;

class displayFormController

{
    public function displayForm()
    {
        $view = 'displayForm.phtml';
        include_once 'views/layout.phtml';
    }
    
     public function displayContact()
    {
        $view = 'contact.phtml';
        include_once 'views/layout.phtml';
    }
    
}

?>