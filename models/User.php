<?php

namespace Models;

require_once 'config/config.php';

require_once 'config/test.php';
   
    
 class User
 {

    public function addUser($email,$password,$lastname,$firstname,$birthdate): void
    {
        $query = connex()->prepare(
        
        "INSERT INTO users (email, password,last_name,first_name ,birthdate) values (?,?,?,?,?)");
        
        $query->execute([$email,$password,$lastname,$firstname,$birthdate]);
    }
    
    public function existUser($email): array
    // vérifier si un utilisateur existe dans la bdd
    {
        $query = connex()->prepare(
        
         "SELECT email, role_id
          FROM users
          WHERE email = ?");
        
        $query->execute([$email]);
        return $query->fetchAll();
    }
    
    public function getUser($email):array 
    // récupérer l'utilisateur par son emeil
    {
        $query = connex()->prepare(
        
         "SELECT *
          FROM users
          WHERE email = ?");
        
        $query->execute([$email]);
        return $query->fetchAll();
    }
    
    public function displayInfosUser()
    // afficher les infos de l'utilisateur
    {
        $query = connex()->prepare(
        
         "SELECT user_id,first_name,last_name ,birthdate,registration
          FROM users");
          
          $query->execute();
          return $query->fetchAll();
    }
    
    public function displayUserId() 
    
    {
        
        $query = connex()->prepare(
        
         "SELECT user_id,first_name,last_name ,birthdate,registration
          FROM users
          ORDER BY user_id ASC");
          
          $query->execute();
          return $query->fetchAll();
    }
   
    public function displayUserName() 
    {
        $query = connex()->prepare(
            
         "SELECT user_id,first_name,last_name ,birthdate,registration
          FROM users
          ORDER BY last_name ASC");
          
          $query->execute();
          return $query->fetchAll();
    }
    
    public function displayUserBirthdate() 
    {
        $query = connex()->prepare(
            
         "SELECT user_id,first_name,last_name ,birthdate,registration
          FROM users
          ORDER BY birthdate ASC");
          
          $query->execute();
          return $query->fetchAll();
    }
    
     public function displayUserRegistration() 
    {
        $query = connex()->prepare(
            
         "SELECT user_id,first_name,last_name ,birthdate,registration
          FROM users
          ORDER BY registration ASC");
          
          $query->execute();
          return $query->fetchAll();
    }
    
    /*
    // function pour ajouter un admin
    protected function addAdmin($email,$password,$firstname,$lastname): void
    {
        $query = connex()->prepare(
            "CREATE users(role_id,email, password,first_name,last_name)
            VALUES(:user_id,:role_id,:email,:password,:first_name,:last_name)
            WHERE (user_id,role_id,email, password,first_name,last_name)"
        );
                      
        $query->bindValue(':role_id' , 1);         
        $query->bindValue(':email' , $email);
        $query->bindValue(':password', $password);
        $query->bindValue(':first_name', $firstname);
        $query->bindValue(':last_name', $firstname);
        
        $query->execute();
    }
    */
}