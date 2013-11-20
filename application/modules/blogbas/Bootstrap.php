<?php

class Blogbas_Bootstrap extends Zend_Application_Module_Bootstrap
{
   public function _initMongo() {
     require_once APPLICATION_PATH.'/../library/BAS/shared/Mongo/Adapter.php';
   }
}
