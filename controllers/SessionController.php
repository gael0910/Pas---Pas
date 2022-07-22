<?php

namespace Controllers;


class SessionController 
{
    
    public function displayConnect()
    {
        
        $view = 'displayConnect.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function submitConnect()
    {  
        
        $email = $_POST['email']; 
    
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);  //supprime les caractères spéciaux
        
        $washEmail = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // tiens compte du default_charset
        
        if( filter_var($washEmail, FILTER_VALIDATE_EMAIL) )
        
            // permet de valider l'adresse mail si dans la console le type du mail est changé en text
        {
            $sessionModel = new \Models\Session();
            $session = $sessionModel->getSession($email);
        
        if(!$session || !$email)
            {
                
                $_SESSION['message'] = 'Mauvais identifiant';
                header('Location: '.$_SERVER['HTTP_REFERER']);
                exit();
                
            }else{
                // vérifier le mot de passe
                
                if(password_verify($_POST['password'],$session['password'])&&($session['role_id']=== 3))
                {
                    // mot de passe correct alors on crée une session
                    $_SESSION['user'] = $session;
                   // unset//($_SESSION['message'//]);
                    // log utilisateur avec $_SESSION
    
                    header('Location: index.php?route=homePage');
                    exit();
                
                } elseif(password_verify($_POST['password'],$session['password'])&&($session['role_id']=== 1)){
                    
                    
                    $_SESSION['admin'] = $session;
                    header('Location: index.php?route=homePage');
                    exit(); 
                    
                }else{
                    
                    // sinon on réaffiche le formulaire avec un message d'erreur
                    $_SESSION['message'] = 'Mot de passe incorrect';
                    header('Location: '. $_SERVER['HTTP_REFERER']);
                    exit();
                
                
                }
            }
        }else
        
        {
            unset($_SESSION['message']);
            $_SESSION['message'] = 'Mauvais identifiant';
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit();
        }
        
    }
    
    public function deconnexion()
    {
        session_destroy();
        header('Location: index.php?route=homePage');
        exit();
        
    }
}  
       
    

    
    

