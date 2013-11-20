<?php

class Blogbas_IndexController extends Zend_Controller_Action
{

    public function init()
    {
       $this->loginNamespace  = new Zend_Session_Namespace('Login');///session namespace
       $this->blogpost = new Blogbas_Model_Mongo_Blogpost();
       $this->users    = new Blogbas_Model_Mongo_Users();
    }

    public function indexAction()
    {
       $this->view->allusers = ''; 
       $this->view->username = ($this->loginNamespace->username)?$this->loginNamespace->username:'';       
       $fetchAllBlogPost = $this->blogpost->findAll();//for adapter  
       if($fetchAllBlogPost) {
          $this->view->allusers = $fetchAllBlogPost;
       }     
    }

    public function loginAction()
    {
       if(isset($this->loginNamespace->username) && $this->loginNamespace->username) {
           $this->_redirect('/blogbas/index');
       } 
       $this->view->loginForm = new Blogbas_Form_Login();       
       $this->view->error_message = ($this->_getParam('errormessage'))?urldecode($this->_getParam('errormessage')):''; 
       if($this->getRequest()->getPost()) {        
          $username = trim($this->getRequest()->getPost('username')); 
          $password = trim($this->getRequest()->getPost('pass'));
          
          if($username && $password) {                   
             $getUser = $this->users->findOne(array('_id'=>$username,'password'=>$password));//for shanty  
          
             if($getUser) {    
                $this->loginNamespace->username = $username;
                $this->_redirect('/blogbas/index/');
             } else {
                $message = urlencode('Enter proper Username and Password'); 
                $this->_redirect("/blogbas/index/login/errormessage/$message");   
             }
          }
       }
    }

    public function signupAction()
    {
       $this->view->signUpForm = new Blogbas_Form_Signup();
       $this->view->success_message = ($this->_getParam('successmessage'))?urldecode($this->_getParam('successmessage')):''; 
       if($this->getRequest()->getPost()) {         
          $username = trim($this->getRequest()->getPost('username'));
          $email    = trim($this->getRequest()->getPost('email'));
          $password = trim($this->getRequest()->getPost('pass'));
          if($username && $email && $password) { 
             try {
             $signUp = $this->users->insert(array('_id'=>$username,'password'=>$password,'email'=>$email));
                if($signUp) {                
                   $message = urlencode('Signed Up Successfully. Please login.'); 
                   $this->_redirect("/blogbas/index/signup/successmessage/$message");
                }
             } catch (Exception $e) {
                echo 'exception ' . $e->getMessage();exit;
             }
          }   
       }
    }

    public function blogpostAction()
    {
       $this->view->blogPostForm = new Blogbas_Form_Blogpost();       
       $username = ($this->loginNamespace->username)?$this->loginNamespace->username:'';
       if($username) {
          if($this->getRequest()->getPost()) {           
             $title    = trim($this->getRequest()->getPost('title'));
             $body     = trim($this->getRequest()->getPost('body'));
             $tags     = trim($this->getRequest()->getPost('tags'));
             $user     = $username;
             $tags_arr = array();
             if($tags) {
                $tags_arr = explode(',',$tags);  
             }           
             try {
                $insertblog = $this->blogpost->insert(array('title'=>$title,'body'=>$body,'tags'=>$tags_arr,'user'=>$user));
                if($insertblog) {
                   $this->_redirect('/blogbas/index/'); 
                }
             } catch (Exception $e) {
                echo 'exception ' . $e->getMessage();exit;
             }       
         }  
      } else {
         $this->_redirect('/blogbas/index/');  
      }
    }

    public function logoutAction()
    {
       Zend_Session::destroy();
       $this->_redirect('/blogbas/index/');
    }

    public function addcommentAction()
    {
       $this->view->addCommentForm = new Blogbas_Form_Addcomment();       
       $blog_id = trim($this->_getParam('blogid'));
       $this->view->blogData='';
       
       if($blog_id) {          
          $getBlog = $this->blogpost->findOne(array('_id'=> new MongoId($blog_id)));//for adapter 
          $this->view->blogData = $getBlog;
       }
        
       if($this->getRequest()->getPost()) {         
          $name  = trim($this->getRequest()->getPost('name'));
          $email = trim($this->getRequest()->getPost('email1'));
          $comment  = trim($this->getRequest()->getPost('comment'));
          if($name && $email && $comment) {
             $addcomment = $this->blogpost->update(array("_id" => new MongoId($blog_id)), array('$push' => array('comment'=>array('name'=>$name,'email1'=>$email,'content'=>$comment))));     
             if($addcomment) {
                $this->_redirect('/blogbas/index/');
             }
          }
       }
    }

}

