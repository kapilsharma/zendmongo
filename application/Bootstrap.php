<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

   protected function _initMongo() 
   {
      require_once APPLICATION_PATH.'/../library/Bas/Shared/Mongo/Connection.php';
   }
   
}

