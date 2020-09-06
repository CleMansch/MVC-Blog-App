<?php

class MemosModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get public memos
     */
    public function getAllMemos()
    {
        $sql = "SELECT memo_id, memo_content, fk_user_id FROM memos WHERE memo_public='1'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    /**
     * Get one users Memos from database
     */
    public function getMyMemos($myId)
    {
        $sql = "SELECT memo_id, memo_content, fk_user_id FROM memos WHERE fk_user_id=$myId ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

        /**
     * Get one users Memos from database
     */
    public function getOneMemo($memo_id)
    {
        $sql = "SELECT memo_id, memo_content, fk_user_id, memo_public FROM memos WHERE memo_id=$memo_id ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
// add memo
    public function addMemo($memo_id, $memo_content, $memo_public, $fk_user_id)
    {
        // clean the input from javascript code for example
        $memo_id = strip_tags($memo_id);
        $memo_content = strip_tags($memo_content);
        $memo_public = strip_tags($memo_public);
        $fk_user_id = strip_tags($fk_user_id);

        $sql = "INSERT INTO memos (`memo_id`, `memo_content`, `memo_public`, `fk_user_id`) VALUES (:memo_id,:memo_content,:memo_public, :fk_user_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array
        (
            ':memo_id' => $memo_id, 
            ':memo_content' => $memo_content,
            ':memo_public' => $memo_public,  
            ':fk_user_id' => $fk_user_id));
    }
// update memo
    public function updateMemo($memo_id, $memo_content, $memo_public)
    {
        // clean the input from javascript code for example
        $memo_id = strip_tags($memo_id);
        $memo_content = strip_tags($memo_content);
        $memo_public = strip_tags($memo_public);

        $sql = "UPDATE memos SET `memo_content`= :memo_content, `memo_public`= :memo_public WHERE `memos`.`memo_id` = :memo_id";
        $query = $this->db->prepare($sql);
        $query->execute(array
        (
            ':memo_id' => $memo_id, 
            ':memo_content' => $memo_content,
            ':memo_public' => $memo_public));
    }

    /**
     * Delete a memo
     * @param int $memo_id
     */
    public function deleteMemo($memo_id)
    {
        $sql = "DELETE FROM memos WHERE memos.memo_id = :memo_id";
        $query = $this->db->prepare($sql);
        $query->execute(array
        (
            ':memo_id' => $memo_id
        
        ));
    }




    /**
     * Get one memo
     * @param int $memo_id
     */
    // public function getOneMemo($memo_id)
    // {
    //     $sql = "SELECT memo_id, memo_content, fk_user_id FROM memos WHERE memos.memo_id = :memo_id";
    //     $query = $this->db->prepare($sql);
    //     $query->execute(array
    //     (
    //         ':memo_id' => $memo_id
        
    //     ));
    // }







}
