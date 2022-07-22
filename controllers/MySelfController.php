<?php

namespace Controllers;

class mySelfController

{
    public function mySelf()
    {
        $view = 'mySelf.phtml';
        include_once 'views/layout.phtml';
    }
    
}