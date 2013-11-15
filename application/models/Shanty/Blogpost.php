<?php
/**
 * Application_Model_Shanty_Blogpost class
 * @author Ravindra
 */
/**
 * Used for hadling operations on blogpost collection in blog database in Mongo using Shanty
 */
class Application_Model_Shanty_Blogpost extends Shanty_Mongo_Document
{ 
   protected static $_db = 'blog';
   protected static $_collection = 'blogpost'; 
   /**
    * 
    * @param string $title
    * @param string $body
    * @param array  $tags
    * @param string $user
    * @return boolean    
    */ 
   public function postBlog($title, $body, $tags, $user)
   {      
      $document = array("title" => $title, "body" => $body, "tags" => $tags, "user" => $user);       
      return $insertblog = $this->insert($document);
   }
   
   /**
    * 
    * @return array
    */  
   public function fetchAllUsers() {    
      //return $fetchAllUsers = (array)$this->fetchAll()->sort(array('user'=>1))->export();
      $fetchAllUsers1 = $this->fetchAll()->sort(array('user'=>1));
      return ($fetchAllUsers1)?(array)$fetchAllUsers1->export():array();
   }
   
   /**
    * 
    * @param integer $blogId
    * @return array
    */
   public function findBlog($blogId) 
   {     
      //return $findBlog = (array)$this->find($blogId)->export();
      $findBlog1 = $this->find($blogId);
      return ($findBlog1)?(array)$findBlog1->export():array();
   }
   
   /**
    * 
    * @param integer $blogId
    * @param string $name
    * @param string $email
    * @param string $content
    * @return boolean
    */
   public function addComment($blogId,$name,$email,$content) 
   {      
      return $addcomment = $this->update(array("_id" => new MongoId($blogId)), array('$push' => array('comment'=>array('name'=>$name,'email1'=>$email,'content'=>$content))));    
   }
}
