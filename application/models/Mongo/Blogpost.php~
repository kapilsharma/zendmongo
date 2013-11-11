<?php
/**
 * Application_Model_Mongo_Blogpost
 * @author Ravindra
 */
/**
 * Used for hadling operations on blogpost collection in blog database in Mongo
 */
class Application_Model_Mongo_Blogpost extends Bas_Shared_Mongo_Connection
{  
   /**
    * 
    * @param type $title
    * @param type $body
    * @param type $tags
    * @param type $user
    * @return type
    * @throws MongoCursorException
    */ 
   public function postBlog($title, $body, $tags, $user)
   {
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_BLOGPOST);        
      $document = array("title" => $title, "body" => $body, "tags" => $tags, "user" => $user);        
      try {
         return $collection->insert($document);
      } catch (MongoCursorException $e) {
         throw $e;
      }
   }
   
   /**
    * 
    * @return type
    */
   public function fetchAllUsers()
   {
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_BLOGPOST);
      return $document   = $collection->find();       
   }
   
   /**
    * 
    * @param type $blogId
    * @return type
    */
   public function findBlog($blogId) 
   {       
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_BLOGPOST);
      return $document = $collection->findOne(array('_id'=> new MongoId($blogId)));      
   }
   
   /**
    * 
    * @param type $blogId
    * @param type $name
    * @param type $email
    * @param type $content
    * @return type
    */
   public function addComment($blogId,$name,$email,$content) {
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_BLOGPOST);       
      //$collection->update(array("_id" => new MongoId($blogId)), array('$set' => array("comment.name" => $name,"comment.email"=>$email,"comment.content"=>$content)));
      return $collection->update(array("_id" => new MongoId($blogId)), array('$push' => array('comment'=>array('name'=>$name,'email'=>$email,'content'=>$content))));     
   }
}
