<?php

session_start();

require_once 'config/config.php';

require_once 'config/test.php';
    
$TOP = connex();

// VERIFICATION DE LA CONNEXION
// if($TOP) { 
    
//   var_dump ("Connexion à la base de données réalisée avec succès !");
   
//  }else{  
     

//     die("Echec de connexion à la base"); 
//  }


spl_autoload_register(function( $class ){
    require_once lcfirst( str_replace( '\\', '/', $class ) ) . '.php';
});

if( array_key_exists( 'route', $_GET ) )
{
    
   $adminRoutes = ['deleteActivity','displayModifActivity','displayFormActivity','comments','manageComment','deleteComment','displayInfos','getCommentValid','addNewAdmin','addActivity','modifActivity','displayInfosAjax' ];
   
    // appeler la function in_array pour vérifier le contenu du tableau $adminRoutes avec en premier argument , si il existe une route déclarée dans le switch
   
if(in_array($_GET['route'],$adminRoutes) && !isset($_SESSION['admin']))

    {
    header( 'Location: index.php?route=homePage' );
    exit();
    }
   
    switch( $_GET['route'] )
    {
        
    // routes admin   
        
        case 'deleteActivity':
            $controller = new Controllers\ActivityController();
            $controller->suppActivity();
            break;
        
        case 'displayModifActivity':
            $controller = new Controllers\ActivityController();
            $controller->displayModifActivity();
            break;
            
        case 'displayFormActivity':
            $controller = new Controllers\ActivityController();
            $controller->displayFormActivity();
            break;
            
        case 'comments':
                
            $controller = new Controllers\CommentController();
            $controller->displayComments();
            break;
            
        case 'manageComment':
            if(isset($_SESSION['admin']))
            {
                $controller = new Controllers\CommentController();
                $controller->manageComment();
                break;
            }
                
        case 'deleteComment':
            $controller = new Controllers\CommentController();
            $controller->deleteComment();
            break;
            
        case 'displayInfos':
            $controller = new Controllers\UserController();
            $controller->displayInfos();
            break; 
            
        case 'getCommentValid':
            $controller = new Controllers\CommentController();
            $controller->getCommentValid();
            break; 
            
        case 'addNewAdmin':
            $controller = new Controllers\UserController();
            $controller->addAdmin();
            break;
            
        case 'addActivity':
            $controller = new Controllers\ActivityController();
            $controller->addActivity();
            break;
                
        case 'modifActivity':
            $controller = new Controllers\ActivityController();
            $controller->modifActivity();
            break;
            
        case 'displayInfosAjax':
            $controller = new Controllers\UserController();
            $controller->displayInfosAjax();
            break;
            
    //fin des routes admin 
            
        case 'homePage':
            $controller = new Controllers\HomePageController();
            $controller->homePage();
            break; 
                
        case 'mySelf':
            $controller = new Controllers\MySelfController();
            $controller->mySelf();
            break; 
                
        case 'activities':
            $controller = new Controllers\ActivityController();
            $controller->displayActivity();
            break;
                
        case 'displayComment':
            
            if( isset( $_SESSION['user']) && !empty($_SESSION['user']))
            {
                $controller = new Controllers\CommentController();
                $controller->displayCommentForm();
                break;
            }
                header('Location: index.php?route=displayConnect');
                exit(); 

        case 'displayCommentValid':
                
            $controller = new Controllers\CommentController();
            $controller->displayCommentValid();
            break;
                
        case 'addComment':
            if( isset( $_SESSION['user'] ) && !empty( $_SESSION['user']) || 
                isset( $_SESSION['admin']) )
            {
                $controller = new Controllers\CommentController();
                $controller->addNewComment();
                break;   
            }
                
                header('Location: index.php?route=displayConnect');
                exit();
                break;
                   
        case 'displayForm':
            $controller = new Controllers\displayFormController();
            $controller->displayForm();
            break;
                
        case 'addNewUser':
            $controller = new Controllers\UserController();
            $controller->addNewUser();
            break;
            
        case 'displayConnect':
            $controller = new Controllers\SessionController();
            $controller->displayConnect();
            break;
                
        case 'submitConnect':
            $controller = new Controllers\SessionController();
            $controller->submitConnect();
            break;
                
        case 'displayContact':
            $controller = new Controllers\displayFormController();
            $controller->displayContact();
            break;
                
        case 'deconnexion':
            $controller = new Controllers\SessionController();
            $controller->deconnexion();
            break;
        }
        }else{
            
            header( 'Location: index.php?route=homePage' );
            exit();
            
        }