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
    * @param string $title
    * @param string $body
    * @param array  $tags
    * @param string $user
    * @return boolean
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
    * @return array
    */
   public function fetchAllUsers()
   {
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_BLOGPOST);
      return $document   = iterator_to_array($collection->find()->sort(array('user'=>1)));       
   }
   
   /**
    * 
    * @param integer $blogId
    * @return array
    */
   public function findBlog($blogId) 
   {       
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_BLOGPOST);
      return $document = $collection->findOne(array('_id'=> new MongoId($blogId)));     
   }
   
   /**
    * 
    * @param integer $blogId
    * @param string $name
    * @param string $email
    * @param string $content
    * @return boolean
    */
   public function addComment($blogId,$name,$email,$content) {
      $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_BLOGPOST);       
      //$collection->update(array("_id" => new MongoId($blogId)), array('$set' => array("comment.name" => $name,"comment.email"=>$email,"comment.content"=>$content)));
      return $collection->update(array("_id" => new MongoId($blogId)), array('$push' => array('comment'=>array('name'=>$name,'email'=>$email,'content'=>$content))));     
   }
}
