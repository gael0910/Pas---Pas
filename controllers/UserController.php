<?php

namespace Controllers;

class UserController
{
    public function addNewUser()
    {
        
        $userModel = new \Models\User();
        $mailUser = $userModel->existUser($_POST['email']);
        
        if($mailUser)
        {
            $_SESSION['message'] = 'Un compte est créé avec cette adresse email !';
            header('Location:' .$_SERVER['HTTP_REFERER']);
            exit();
            
        }else{
            
            $model = new \Models\User();
            $users = $model->addUser($_POST['email'],password_hash($_POST['password'],PASSWORD_BCRYPT ),htmlspecialchars($_POST['first_name']),htmlspecialchars($_POST['last_name']),$_POST['birthdate']);
        
        // log utilisateur avec $_SESSION
            $sessionModel = new \Models\Session();
            $session = $sessionModel->getSession($_POST['email']);
            $_SESSION['user'] = $session;
        
            header('Location: index.php?route=homePage');
            exit();
        }
        
        
    }
    
    public function displayInfos()
        {
            
            $infosModel = new \Models\User();
            $infos = $infosModel->displayInfosUser();
            
            $view = 'displayInfos.phtml';
            include_once 'views/layout.phtml';
        
        }
    
    public function displayInfosAjax()
        {
            
         if( isset( $_GET['tri'] ))
         {
            $choice = $_GET['tri'];
         }
        
        switch( $choice )
        {

            case 'user_id':
                $triModel = new \Models\User();
                $infos = $triModel->displayUserId();
                break;
            
            case 'name':
                $triModel = new \Models\User();
                $infos = $triModel->displayUserName();
                break;

            case 'registration':
                $triModel = new \Models\User();
                $infos = $triModel->displayUserRegistration();
                break;

            case 'birthdate':
                $triModel = new \Models\User();
                $infos= $triModel->displayUserBirthdate();
                break;
        }

            include_once 'views/searchInfos.phtml';
    
}
        
    
    
    /*
    
    protected function addAdmin()
    {
        $model = new \Models\User();
    
        $admin = $model->addAdmin($email,password_hash($password,PASSWORD_BCRYPT),$firstname,$lastname);
    }
    */
}