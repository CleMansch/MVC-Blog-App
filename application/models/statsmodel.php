<?php

class StatsModel
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

//total amount of memos
    public function getAmountOfMemos()
    {
        $sql = "SELECT COUNT(memo_id) AS amount_of_memos FROM memos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->amount_of_memos;
    }
//show me my memos
public function getMyMemos()
{
    $sql = "SELECT * FROM `memos` WHERE fk_user_id =".$_SESSION['user_id']."";
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetch()->amount_of_memos;
}
}

