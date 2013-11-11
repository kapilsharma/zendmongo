<?php
/**
 * Blog_IndexController class
 * @author Ravindra
 */

/**
 * Used for blog related functionalities like displaying blog users, Handling data(add,update,delete operations on blog data) etc.
 */

class Blog_IndexController extends Zend_Controller_Action
{
    
   public function init()
   {     
      $this->loginNamespace  = new Zend_Session_Namespace('Login');///session namespace
   }
   
   /**
    * Show listing of all blog owners
    */
   public function indexAction()
   {
      $this->view->allusers = ''; 
      $this->view->username = ($this->loginNamespace->username)?$this->loginNamespace->username:'';            
      $users = new Application_Model_Mongo_Blogpost();
      $fetchAllUsers = $users->fetchAllUsers();             
      if($fetchAllUsers) {
         $this->view->allusers = $fetchAllUsers;
      }
   }  
    
    /**
     * User's login
     */
    public function loginAction()
    {
       $this->view->error_message = ($this->_getParam('errormessage'))?urldecode($this->_getParam('errormessage')):''; 
       if($this->getRequest()->getPost()) {        
          $username = trim($this->getRequest()->getPost('username')); 
          $password = trim($this->getRequest()->getPost('pass'));
          $users = new Application_Model_Mongo_Users();
          $getUser = $users->getUser($username,$password);         
          if($getUser && count($getUser)==1) {
             $this->loginNamespace->username = $username;
             $this->_redirect('/blog/index/');
          } else {
             $message = urlencode('Enter proper Username and Password'); 
             $this->_redirect("blog/index/login/errormessage/$message");   
          }
       }        
    }
    
    /**
     * Sign Up for User
     */
    public function signupAction()
    {
       if($this->getRequest()->getPost()) {           
          $users = new Application_Model_Mongo_Users();
          $username = $this->getRequest()->getPost('username');
          $email    = $this->getRequest()->getPost('email');
          $password = $this->getRequest()->getPost('pass');
          try {
             $signUp = $users->signUp($username,$password,$email);
             if($signUp) {
                //$this->_redirect('/blog/index/');
                $message = urlencode('Signed Up Successfully. Please login.'); 
                $this->_redirect("blog/index/login/errormessage/$message");
             }
          } catch (MongoCursorException $e) {
             echo 'exception ' . $e->getMessage();
          }          
       }       
    }
    
    /**
     * Save the blog post
     */
    public function blogpostAction()
    {
       $username = ($this->loginNamespace->username)?$this->loginNamespace->username:'';
       if($username) {
          if($this->getRequest()->getPost()) {           
             $blogpost = new Application_Model_Mongo_Blogpost();
             $title    = $this->getRequest()->getPost('title');
             $body     = $this->getRequest()->getPost('body');
             $tags     = $this->getRequest()->getPost('tags');
             $user     = $username;
             $tags_arr = array();
             if($tags) {
                $tags_arr = explode(',',$tags);  
             }           
             try {
                $insertblog = $blogpost->postBlog($title,$body,$tags_arr,$user);                
                if($insertblog) {
                   $this->_redirect('/blog/index/'); 
                }
             } catch (MongoCursorException $e) {
                echo 'exception ' . $e->getMessage();
             }       
         }  
      } else {
         $this->_redirect('/blog/index/');  
      }
    }
    
    /**
     * Logout for User
     */
    public function logoutAction()
    {
       Zend_Session::destroy();
       $this->_redirect('/blog/index/');
    }
    
    
    /**
     * Add comment in the user's blog
     */
    public function addcommentAction()
    {
       $blog_id = $this->_getParam('blogid');
       $this->view->blogData='';
       $blog = new Application_Model_Mongo_Blogpost();
       if($blog_id) {          
          $getBlog = $blog->findBlog($blog_id);          
          $this->view->blogData = $getBlog;
       }
        
       if($this->getRequest()->getPost()) {         
          $name  = trim($this->getRequest()->getPost('name'));
          $email = trim($this->getRequest()->getPost('email1'));
          $comment  = trim($this->getRequest()->getPost('comment'));
          if($name && $email && $comment) {
             $addcomment = $blog->addComment($blog_id,$name,$email,$comment);
             if($addcomment) {
                $this->_redirect('/blog/index/');
             }
          }
       }
    }
}












