<?php

class Application_Model_Mongo_Blogpost extends Bas_Shared_Mongo_Connection
{ 
    
    //ToBe written by developers
    public function postBlog($title, $body, $tags)
    {
        $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_BLOGPOST);
        
        $document = array("title" => $title, "body" => $body, "tags" => $tags);
        
        try {
            $collection->insert($document, array("w" => 1));
        } catch (MongoCursorException $e) {
            throw $e;
        }
    }
}