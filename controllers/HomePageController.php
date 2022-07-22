<?php

namespace Controllers;

class HomePageController

{
    public function homePage()
    {
    
        $view = 'homePage.phtml';
        include_once 'views/layout.phtml';
    }
}


?>
