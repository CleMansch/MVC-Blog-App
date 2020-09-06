<?php


class Memos extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/Memos/index
     */
    public function index()
    {


        // load a model, perform an action, pass the returned data to a variable
        $memos_model = $this->loadModel('MemosModel');
        $memos = $memos_model->getAllMemos();
        //allows to see memos when logged in
        if ($_SESSION){

        $mymemos = $memos_model->getMyMemos($_SESSION['user_id']);


        // load another model, perform an action, pass the returned data to a variable
        $stats_model = $this->loadModel('StatsModel');
        $amount_of_memos = $stats_model->getAmountOfMemos();

        // load views. within the views we can echo out $memos and $amount_of_memos easily
        require 'application/views/_templates/header.php';
        require 'application/views/memos/index.php';
        require 'application/views/memos/publicmemos.php';
        require 'application/views/_templates/footer.php';
                    }
    else{
        require 'application/views/_templates/header.php';
        require 'application/views/memos/publicmemos.php';
        require 'application/views/_templates/footer.php';
        }
    }
    /**
     * PAGE: onememo
     * This method handles what happens when you move to http://yourproject/Memos/showonememo
     */
    public function showOneMemo($memo_id)
    {
        // load a model, perform an action, pass the returned data to a variable
        $memos_model = $this->loadModel('MemosModel');
        $onememo = $memos_model->getOneMemo($memo_id);
        require 'application/views/_templates/header.php';
        require 'application/views/memos/showonememo.php';
        require 'application/views/_templates/footer.php';
    }

// add memo
    public function addMemo()
    {
        // if we have POST data to create a new memo entry
        if (isset($_POST["submit_add_memo"])) {
            // load model, perform an action on the model
            $memos_model = $this->loadModel('MemosModel');
            $memos_model->addMemo($_POST["memo_id"], $_POST["memo_content"],  $_POST["memo_public"], $_POST["fk_user_id"]);
        }
        // where to go after memo has been added
        header('location: ' . URL . 'memos/index');
    } 
// update memo
public function updateMemo()
{
    // if we have POST data to update a  memo entry
    if (isset($_POST["submit_update_memo"])) {
        // load model, perform an action on the model
        $memos_model = $this->loadModel('MemosModel');
        $memos_model->updateMemo($_POST["memo_id"], $_POST["memo_content"],  $_POST["memo_public"]);
    }
    // where to go after memo has been updated
    header('location:'.URL.'memos/showonememo/'.$_POST["memo_id"]);
}
// delete Memo
    public function deleteMemo($memo_id)
    {
        // if we have an id of a memo that should be deleted
        if (isset($memo_id)) {
            // load model, perform an action on the model
            $memos_model = $this->loadModel('MemosModel');
            $memos_model->deleteMemo($memo_id);
        }

        // where to go after memo has been deleted
        header('location: ' . URL . 'memos/index');
    }
}
