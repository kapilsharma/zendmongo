<?php
/**
 * Application_Model_Mongo_Users class
 * @author Ravindra
 */

/**
 * Used for hadling operations on users collection in blog database in Mongo
 */
class Application_Model_Mongo_Users extends Bas_Shared_Mongo_Connection
{  
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
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_USERS);        
      $document   = array("_id" => $username, "password" => $password, "email" => $email);
        
      try {
         return $collection->insert($document, array("w" => 1));
      } catch (MongoCursorException $e) {
         throw $e;
      }
   }   
   
   /**
    * 
    * @param string $username
    * @param string $password
    * @return array
    */
   public function getUser($username,$password) 
   {
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_USERS);
      return $document   = iterator_to_array($collection->find(array('_id'=>$username,'password'=>$password))); 
   }
}
