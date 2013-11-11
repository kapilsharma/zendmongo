<?php

class Application_Model_Mongo_Users extends Bas_Shared_Mongo_Connection
{ 
    
    //ToBe written by developers
    public function signUp($username, $password, $email)
    {
        $collection = $this->getCollection(Bas_Shared_Mongo_Connection::COLLECTION_USERS);
        
        $document = array("_id" => $username, "password" => $password, "email" => $email);
        
        try {
            $collection->insert($document, array("w" => 1));
        } catch (MongoCursorException $e) {
            throw $e;
        }
    }
}