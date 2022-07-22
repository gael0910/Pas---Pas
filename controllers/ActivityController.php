<?php

namespace Controllers;

class ActivityController

{
     public function displayActivity()
    {
        $activityModel = new \Models\Activity();
        $activities = $activityModel->getActivities();
        
        $view = 'activities.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayFormActivity()
    {
       
        $view = 'addActivity.phtml';
        include_once 'views/layout.phtml';
    }
     
     public function addActivity()
    {
        $addActivityModel = new \Models\Activity();
        
        if(isset($_POST['activity_name']) && !empty($_POST['activity_name']) && isset($_POST['activity_cat']) && !empty($_POST['activity_cat']) && isset($_POST['activity_description']) && !empty($_POST['activity_description']) && isset($_POST['is_collective']) && !empty($_POST['is_collective']))
        {
            $data =[htmlspecialchars($_POST['activity_name']),htmlspecialchars($_POST['activity_cat']),htmlspecialchars($_POST['activity_description']),htmlspecialchars($_POST['is_collective'])];
            
            $addActivity = $addActivityModel->addActivity($data);
        
        }
            
            header('Location: index.php?route=activities');
            exit();
    }
    
    public function displayModifActivity()
    {
        
        $activityModel = new \Models\Activity();
        $activity = $activityModel->getOneActivity($_GET['activityID']);
       
        $view = 'modifActivity.phtml';
        include_once 'views/layout.phtml';
    }
    
     public function modifActivity()
    {
    
        $modifActivityModel = new \Models\Activity();
        $modifActivity = $modifActivityModel->updateActivity($_POST['activity_cat'],$_POST['activity_name'],$_POST['description'],
        intval($_POST['is_collective']),$_POST['id']);
            
        
        header('Location: index.php?route=activities');
        exit();
    }
    
     public function suppActivity()
    {
    
        $suppActivityModel = new \Models\Activity();
        $suppActivity = $suppActivityModel->deleteOneActivity($_GET['activityID']);
            
        header('Location: index.php?route=activities');
        exit();
    }
}




