<?php
include_once('connection.php');
$username = (isset($_SESSION['username']) && $_SESSION['username'])?$_SESSION['username']:'';
if($username) {
  if($_POST) {           
    $title    = (isset($_POST['title']) && $_POST['title'])?trim($_POST['title']):'';
    $body     = (isset($_POST['body']) && $_POST['body'])?trim($_POST['body']):'';
    $tags     = (isset($_POST['tags']) && $_POST['tags'])?trim($_POST['tags']):'';
    $user     = $username;
    $tags_arr = array();
    if($tags) {
      $tags_arr = explode(',',$tags);  
    }           
    try {         
       $document = array("title" => $title, "body" => $body, "tags" => $tags_arr, "user" => $user);        
       $insertblog = $blogpostCollectionObj->insert($document);      
       if($insertblog) {         
         header("Location:index.php");
       }
    } catch (Exception $e) {
      echo 'exception ' . $e->getMessage();exit;
    }       
  }
  include_once('view/blogpostview.php');
} else { 
  header("Location:index.php");
}
