<?php

class UsersModel
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
     * make user admin
     */
    public function makeAdmin($usaId)
    {
        $sql = "UPDATE `users` SET `user_role` = 'admin' WHERE `users`.`user_id` = $usaId; ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    /**
     * grab my userdata
     */
    public function myAccount($user_id)
    {
        $sql = "SELECT `user_id`, `user_fname`, `user_lname`, `user_password_hash`, `user_email`, `user_role` FROM users WHERE user_id=$user_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    /**
     * Get all users from database
     */
    public function getAllUsers()
    {
        $sql = "SELECT `user_id`, `user_fname`, `user_lname`, `user_password_hash`, `user_email`, `user_role` FROM users";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addUsers($user_id, $user_fname, $user_lname, $user_password_hash, $user_email)
    {
        // clean the input from javascript code for example
        $user_id = strip_tags($user_id);
        $user_fname = strip_tags($user_fname);
        $user_lname = strip_tags($user_lname);
        $user_password_hash = strip_tags($user_password_hash);
        $user_email = strip_tags($user_email);

        $sql = "INSERT INTO Users (`user_id`, `user_fname`, `user_lname`, `user_password_hash`, `user_email`) VALUES (:user_id,:user_fname,:user_lname, :user_password_hash, :user_email)";
        $query = $this->db->prepare($sql);
        $query->execute(array
        (
            ':user_id' => $user_id, 
            ':user_fname' => $user_fname,
            ':user_lname' => $user_lname,  
            ':user_password_hash' => $user_password_hash,
            ':user_email' => $user_email));
    }

    /**
     * add/update/delete stuff!
     * @param int $user_id
     */
    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM users WHERE users.user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array
        (
            ':user_id' => $user_id
        
        ));
    }
    
}
