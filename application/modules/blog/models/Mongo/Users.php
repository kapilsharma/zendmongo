<?php

class Application_Models_Mongo_Users extends Bas_Shared_Mongo_Connection
{ 
    
    //ToBe written by developers
    public function signUp($username, $password)
    {
        $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_USERS);
        
        $document = array("username" => $username, "password" => $password);
        
        try {
            $collection->insert($document, array("w" => 1));
        } catch (MongoCursorException $e) {
            throw $e;
        }
    }
}