<?php

namespace Controllers;



class CommentController
{
    public function displayComments()
    {
        $commentModel = new \Models\Comment();
        $comments = $commentModel->getComments();
        
        $view = 'comments.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayCommentForm()
    {
        $view = 'newCommentForm.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function recupNameComment()
    {
        $nameModel = new \Models\Comment();
        $nameModel->recupUserName();
        
        $view = 'comments.phtml';
        include_once 'views/layout.phtml';
    }
        
    public function addNewComment()
    {
        $addNewCommentModel = new \Models\Comment();
        
        if( isset($_SESSION['user']) )
        {
            $addNewCommentModel->addNewComment( $_SESSION['user']['user_id'] , $_POST['content']);
        
        } elseif( isset($_SESSION['admin'])){
            
            $addNewCommentModel->addNewComment( $_SESSION['admin']['user_id'] , $_POST['content']); 
            
            header('Location: index.php?route=comments');
            exit();
            
        }
        
        
        header('Location: index.php?route=displayCommentValid');
        exit();
        
        }
        
    public function displayCommentValid()
    {
        
        $addNewCommentModel = new \Models\Comment();
        $comValid = $addNewCommentModel->getCommentValid();
        
        $view = 'displayCommentValid.phtml';
        include_once 'views/layout.phtml';
        
    }

    public function manageComment()
    {
        
            if($_POST['validation'] === '0')
            {
                $manageCommentModel = new \Models\Comment();
                $manageCommentModel->deleteComment($_POST['commentId']);
            }
            if($_POST['validation'] === '1')
            {
              $manageCommentModel = new \Models\Comment();
              $manageCommentModel->updateComment($_POST['validation'],
                $_POST['commentId']);
          
            }
            
            
            header('Location: index.php?route=comments');
            exit();
    }
        

            
            
        
        
}



