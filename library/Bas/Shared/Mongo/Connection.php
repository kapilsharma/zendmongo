<?php
/**
 * Bas_Shared_Mongo_Connection class
 * @author Kapil
 */

/**
 * Used for setting Mongodb connection
 */
class Bas_Shared_Mongo_Connection
{
   const DBNAME = "blog";
   const COLLECTION_USERS = "users";
   const COLLECTION_BLOGPOST = "blogpost";
    
   protected $collections;
   protected $mongoClient;
   protected $database;
   
   /**
    * Create Mongo Connection
    */
   public function __construct()
   {
      $this->collection = array();        
      $this->mongoClient = new MongoClient();        
      $dbname = Bas_Shared_Mongo_Connection::DBNAME;        
      $this->database = $this->mongoClient->$dbname;
   }
   
   /**
    * 
    * @param type $collection
    * @return type
    */
   public function getCollection($collection)
   {
        //ToDO: Validation        
      if(!isset($this->collections[$collection])) {
         $this->collections[$collection] = $this->database->$collection;
      }        
      return $this->collections[$collection];
   }    
}
