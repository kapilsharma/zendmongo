<?php
/**
 * Application_Model_Shanty_Users class
 * @author Ravindra
 */
/**
 * Used for hadling operations on users collection in blog database in Mongo using Shanty library
 */
class Application_Model_Shanty_Users extends Shanty_Mongo_Document
{
   protected static $_db = 'blog';
   protected static $_collection = 'users';
   
   /**
    * 
    * @param string $username
    * @param string $password
    * @param string $email
    * @return boolean
    * @throws MongoCursorException
    */
   public function signUp($username, $password, $email)
   {          
      $document   = array("_id" => $username, "password" => $password, "email" => $email);
      return $signUp = $this->insert($document);//for shanty
   }   
   
   /**
    * 
    * @param string $username
    * @param string $password
    * @return array
    */
   public function getUser($username,$password) 
   {     
      //$getUser1 = (array)$this->fetchOne(array('_id'=>$username,'password'=>$password))->export();  
      $getUser1 = $this->fetchOne(array('_id'=>$username,'password'=>$password));  
      return ($getUser1)?(array)$getUser1->export():array();      
   }
}

