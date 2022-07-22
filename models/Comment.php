<?php

namespace Models;

    require_once 'config/config.php';
    
    require_once 'config/test.php';

class Comment {
    
    public function getComments()
    // récupérer les commentaires par ordre décroissant
    {
        $query = connex()->prepare(
        
        "SELECT * FROM comments
            ORDER BY created_at DESC");

        $query->execute();
        return $query->fetchAll();
    }
    
    public function addCommentUser($user_id): array
    // récupérer le commentaire par l'id de l'utilisateur
    {
        $query = connex()->prepare(
            
        "INSERT INTO users.user_id 
        FROM users
        INNER JOIN comments AS Com
        ON Com.user_id = users.user_id");
        
        $query->execute($user_id);
        return $query->fetch();
    }


    public function addNewComment($user_id,$content): void
    // ajouter le commentaire dans les commentaires à valider
    {
        $query = connex()->prepare(
            
        "INSERT INTO comments( user_id, content, created_at, validated ) values(?,?,NOW(), 0)");
        
        $query->execute([$user_id,$content]);
    }
    
    public function updateComment($valid,$id) : void
    // ajout du commentaire si il est validé
    {
        $query = connex()->prepare(
            
        "UPDATE comments SET validated = ?
         WHERE id = ?");
        
        $query->execute([$valid,$id]);
    }
    
    public function deleteComment($commentId) : void
    // supprimer le commentaire 
    {
        $query = connex()->prepare(
            
        "DELETE FROM comments WHERE id = ?");
        
        $query->execute([$commentId]);
    }
    
    public function getCommentValid() : array
    // affichage du commentaire avec infos de l'utilisateur par ordre décroissant
    {
        $query = connex()->prepare(
            
        "SELECT *  FROM comments
        INNER JOIN users ON comments.user_id = users.user_id
        WHERE validated = 1
        ORDER BY created_at DESC");
        
        
        $query->execute([]);
        return $query->fetchAll();
    }

}

?>
