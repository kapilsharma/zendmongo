<?php
include_once('connection.php');
$username = (isset($_SESSION['username']) && $_SESSION['username'])?$_SESSION['username']:'';
$fetchAllBlogPost = iterator_to_array($blogpostCollectionObj->find()->sort(array('user'=>1)));
if($fetchAllBlogPost) {
  $allusers = $fetchAllBlogPost; 
}
$allusers = ($fetchAllBlogPost)?$fetchAllBlogPost:array(); 
include_once('view/indexview.php');