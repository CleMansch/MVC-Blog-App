<?php

class Users extends Controller
{

    public function index()
    {
        // load a model, perform an action, pass the returned data to a variable
        $users_model = $this->loadModel('UsersModel');
        $users = $users_model->getAllUsers();
    if ($_SESSION){
        $anzlna = $users_model->myAccount($_SESSION['user_id']);
                    }  
        // load views.
    require 'application/views/_templates/header.php';

    if(!$_SESSION){
        require 'application/views/users/index.php';  
    }   
    elseif($_SESSION['user_role']=="admin"){
    require 'application/views/users/useraccount.php';   
    require 'application/views/users/myaccount.php';
                                            }
    elseif($_SESSION['user_role']=="user"){
    require 'application/views/users/myaccount.php';
                                            }
    else {
      require 'application/views/users/index.php';  
            }
    require 'application/views/_templates/footer.php';
    }
// adminview show all
    public function useraccount()
    {
        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $users_model = $this->loadModel('UsersModel');
        $users = $users_model->getAllUsers();
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/users/useraccount.php';
        require 'application/views/_templates/footer.php';
    }
    // personal user account
    public function myAccount($user_id)
    {
            // load model, perform an action on the model
            $my_model = $this->loadModel('UsersModel');
            $my_model->myAccount($user_id);
        header('location: ' . URL . 'users/useraccount');
    }
    // makeadmin
    public function makeAdmin($user_id)
    {

        if (isset($user_id) && $_SESSION['user_role']=="admin") {
            // load model, perform an action on the model
            $users_model = $this->loadModel('UsersModel');
            $users_model->makeAdmin($user_id);
        }
        header('location: ' . URL . 'users/useraccount');
    }
    // delete user
    public function deleteUser($userr_id)
    {
        // if we have an id of a user that should be deleted
        if (isset($userr_id)) {
            // load model, perform an action on the model
            $users_model = $this->loadModel('UsersModel');
            $users_model->deleteUser($userr_id);
        }
        header('location: ' . URL . "index.php?logout");
    }
// action add user
    public function addUser()
    {
        if (empty($_POST['user_fname'])) {
            $this->errors[] = "Empty Username";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        }
         elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['user_fname']) > 64 || strlen($_POST['user_fname']) < 2) {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_fname'])) {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } elseif (!empty($_POST['user_fname'])
            && strlen($_POST['user_fname']) <= 64
            && strlen($_POST['user_fname']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_fname'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }
            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {
                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_fname = $this->db_connection->real_escape_string(strip_tags($_POST['user_fname'], ENT_QUOTES));
                $user_lname = $this->db_connection->real_escape_string(strip_tags($_POST['user_lname'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));

                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE user_fname = '" . $user_fname . "' OR user_email = '" . $user_email . "';";
                $query_check_user_fname = $this->db_connection->query($sql);

                if ($query_check_user_fname->num_rows == 1) {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                                                            } 
                else {
                    // write new user's data into database
                    $sql = "INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_password_hash`, `user_email`)
                            VALUES
                            (
                                '" . NULL . "',
                                '" . $user_fname . "',
                                '" . $user_lname . "',
                                '" . $user_password_hash . "',
                                '" . $user_email . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);
                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                            }
                        }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
                // where to go after user has been added
                header('location: ' . URL . 'users/index');
    }
}
