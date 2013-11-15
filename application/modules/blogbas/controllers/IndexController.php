<?php

class Blogbas_IndexController extends Zend_Controller_Action
{

    public function init()
    {
       $this->loginNamespace  = new Zend_Session_Namespace('Login');///session namespace
       $this->blogpost = new Application_Model_Mongo_Blogpost();
       $this->users = new Application_Model_Mongo_Users();
    }

    public function indexAction()
    {
       $this->view->allusers = ''; 
       $this->view->username = ($this->loginNamespace->username)?$this->loginNamespace->username:'';       
               
       $fetchAllBlogPost = $this->blogpost->fetchAllUsers();         
                  
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
             $getUser = $this->users->getUser($username,$password);            
          
             //if($getUser && count($getUser)==1) {
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
          $username = $this->getRequest()->getPost('username');
          $email    = $this->getRequest()->getPost('email');
          $password = $this->getRequest()->getPost('pass');
          if($username && $email && $password) { 
             try {
             $signUp = $this->users->signUp($username,$password,$email);            
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
             $title    = $this->getRequest()->getPost('title');
             $body     = $this->getRequest()->getPost('body');
             $tags     = $this->getRequest()->getPost('tags');
             $user     = $username;
             $tags_arr = array();
             if($tags) {
                $tags_arr = explode(',',$tags);  
             }           
             try {
                $insertblog = $this->blogpost->postBlog($title,$body,$tags_arr,$user);
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
       $blog_id = $this->_getParam('blogid');
       $this->view->blogData='';
       
       if($blog_id) {          
          $getBlog = $this->blogpost->findBlog($blog_id);
          $this->view->blogData = $getBlog;
       }
        
       if($this->getRequest()->getPost()) {         
          $name  = trim($this->getRequest()->getPost('name'));
          $email = trim($this->getRequest()->getPost('email1'));
          $comment  = trim($this->getRequest()->getPost('comment'));
          if($name && $email && $comment) {
             $addcomment = $this->blogpost->addComment($blog_id,$name,$email,$comment);   
             if($addcomment) {
                $this->_redirect('/blogbas/index/');
             }
          }
       }
    }

}

