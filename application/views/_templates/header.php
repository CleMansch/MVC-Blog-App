<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>manschek_internex_memo</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
    <!-- CSS -->
    <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <div class="container">
<!-- mynav -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Memo Navigation</a>
    </div>
    <ul class="nav navbar-nav">
      <!-- <li><a href="<?php echo URL; ?>">home</a></li> -->

      <li><a href="<?php echo URL; ?>memos/">Memos</a></li>

<li><a href="<?php echo URL; ?>users/">Zugangsbereich</a></li>

    </ul>
  </div>
</nav>


<?php 

if(isset($_SESSION['user_id']) )
{
echo "Hey,".
 $_SESSION['user_fname'].
 " ".
 $_SESSION['user_lname'].
 ". Willkommen zurück :)<br><a href='index.php?logout'>Logout</a></div>"; 
 }
 
 ?>
