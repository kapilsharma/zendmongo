<?php
include_once('connection.php');
if(isset($_SESSION['username']) && $_SESSION['username']) {    
  header("Location:index.php");
} 
$error_message = (isset($_GET['errormessage']) && $_GET['errormessage'])?trim($_GET['errormessage']):'';
if($_POST) {
    $username = (isset($_POST['username']) && $_POST['username'])?trim($_POST['username']):'';
    $password = (isset($_POST['pass']) && $_POST['pass'])?trim($_POST['pass']):'';    
    if($username && $password) {     
       $getUser = iterator_to_array($usersCollectionObj->find(array('_id'=>$username,'password'=>$password)));       
       if($getUser) {    
         $_SESSION['username'] = $username;        
         header("Location:index.php");
       } else {
         $message = urlencode('Enter proper Username and Password');        
         header("Location:login.php?errormessage=$message");
       }
    }
}
include_once('view/loginview.php');

