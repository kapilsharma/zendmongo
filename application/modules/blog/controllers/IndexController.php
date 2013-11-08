<?php

class Blog_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->loginNamespace  = new Zend_Session_Namespace('Login');
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
       
       echo '<pre>';print_r($_SESSION);echo '</pre>';
       if($this->getRequest()->getPost()) {
            //echo '<pre>';print_r($_POST);echo '</pre>';
         $username = $this->getRequest()->getPost('username');  
         $this->loginNamespace->username = $username;           
            
       
    }
    }

    public function signupAction()
    {
       if($this->getRequest()->getPost()) {
           
           $users = new Application_Model_Mongo_Users();
           $username = $this->getRequest()->getPost('username');
           $email    = $this->getRequest()->getPost('email');
           $password = $this->getRequest()->getPost('pass');
           try {
                $users->signUp($username,$password,$email);
           } catch (MongoCursorException $e) {
               echo 'exception ' . $e->getMessage();
           }
           
           echo 'success';
       
      }
    }
    

    public function blogpostAction()
    {
        $username = $this->loginNamespace->username;
        if($this->getRequest()->getPost()) {
           
           $blogpost = new Application_Model_Mongo_Blogpost();
           $title    = $this->getRequest()->getPost('title');
           $body     = $this->getRequest()->getPost('body');
           $tags     = $this->getRequest()->getPost('tags');
           try {
                $blogpost->postBlog($title,$body,$tags);
           } catch (MongoCursorException $e) {
               echo 'exception ' . $e->getMessage();
           }
           
           echo 'success';
       
      }
        
    }


}







