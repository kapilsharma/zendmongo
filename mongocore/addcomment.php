<?php   
include_once('connection.php');
$blog_id = (isset($_GET['blogid']) && $_GET['blogid'])?trim($_GET['blogid']):'';
$blogData='';

if($blog_id) {    
  $getBlog = $blogpostCollectionObj->findOne(array('_id'=> new MongoId($blog_id)));
  $blogData = $getBlog;
  include_once('view/addcommentview.php');
}
        
if($_POST) {         
  $name  = (isset($_POST['name']) && $_POST['name'])?trim($_POST['name']):'';
  $email = (isset($_POST['email1']) && $_POST['email1'])?trim($_POST['email1']):'';
  $comment  = (isset($_POST['comment']) && $_POST['comment'])?trim($_POST['comment']):'';
  if($name && $email && $comment) { 
    $addcomment = $blogpostCollectionObj->update(array("_id" => new MongoId($blog_id)), array('$push' => array('comment'=>array('name'=>$name,'email'=>$email,'content'=>$comment))));     
    if($addcomment) {      
      header("Location:index.php");
    }
  }
}
