<?php
$mongoClientObj = new MongoClient();
$blogDbObj  = $mongoClientObj->selectDB('blog');
$usersCollectionObj    = $blogDbObj->users;
$blogpostCollectionObj = $blogDbObj->blogpost;
session_start();
ini_set('display_errors',1);

//$con = new Mongo("mongodb://{$username}:{$password}@{$host}"); // Connect to Mongo Server
//$db = $con->selectDB($database); // Connect to Database

