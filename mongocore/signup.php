<?php
include_once('connection.php');
$success_message = (isset($_GET['successmessage']) && $_GET['successmessage'])?trim($_GET['successmessage']):'';
if($_POST) {
    $username = (isset($_POST['username']) && $_POST['username'])?trim($_POST['username']):'';
    $email    = (isset($_POST['email']) && $_POST['email'])?trim($_POST['email']):'';
    $password = (isset($_POST['pass']) && $_POST['pass'])?trim($_POST['pass']):'';   
   
    if($username && $email && $password) {    
      $document   = array("_id" => $username, "password" => $password, "email" => $email);     
      $signUp     = $usersCollectionObj->insert($document);   
      if($signUp) {        
        $message = urlencode('Signed Up Successfully. Please login.');         
        header("Location:signup.php?successmessage=$message");
      }             
    }
} 
include_once('view/signupview.php');
