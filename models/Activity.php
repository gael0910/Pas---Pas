<?php

namespace Models;

    require_once 'config/config.php';
    require_once 'config/test.php';

class Activity

{
    public function getActivities()
    {
       $query = connex()->prepare(
        
      "SELECT id,activity_cat,activity_name, description,is_collective
       FROM activities");
       
       $query->execute();
       return $query->fetchAll();
       
     }
     
    public function getOneActivity($id)
    {
        
       $query = connex()->prepare(
        
      "SELECT id,activity_cat,activity_name, description,is_collective
       FROM activities
       WHERE id = ?");
       
       $query->execute([$id]);
       return $query->fetch();
       
     } 
     
    public function addActivity($data):array|bool
    
    {
       $query = connex()->prepare(
        
      "INSERT INTO activities(activity_cat, activity_name, description, is_collective)
       VALUES (?,?,?,?)");
       
       $query->execute($data);
       return $query->fetch();
       
     } 
    
    public function updateActivity($cat,$name,$description,$collect,$id)  
    {
        $query = connex()->prepare(
            
        "UPDATE activities SET activity_cat = ?,activity_name = ?,description = ?,is_collective = ?
         WHERE id = ?");
        
        $query->execute([$cat,$name,$description,$collect,$id]);
    
    }
    
    public function deleteOneActivity($id)
    {
        $query = connex()->prepare(
            
        "DELETE FROM activities WHERE id = ?");
          
        $query->execute([$id]);
    }
    
}
    
    