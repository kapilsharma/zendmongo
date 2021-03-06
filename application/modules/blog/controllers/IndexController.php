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
      $this->blogpost = new Application_Model_Mongo_Blogpost();
      $this->users = new Application_Model_Mongo_Users();     
   }
   
   /**
    * Show listing of all blog owners
    */
   public function indexAction()
   {
      $this->view->allusers = ''; 
      $this->view->username = ($this->loginNamespace->username)?$this->loginNamespace->username:'';            
      //if($this->loginNamespace->username) {    
               
         $fetchAllBlogPost = $this->blogpost->fetchAllUsers();//for custom class  
         //$fetchAllBlogPost = (array)$this->blogpost->fetchAll()->export();//for shanty 
                  
         if($fetchAllBlogPost) {
            $this->view->allusers = $fetchAllBlogPost;
      }
      //} else {
         //$this->_redirect('/blog/index/login/');   
      //}    
   }  
    
    /**
     * User's login
     */
    public function loginAction()
    {
       if(isset($this->loginNamespace->username) && $this->loginNamespace->username) {
           $this->_redirect('/blog/index');
       } 
       $this->view->loginForm = new Blog_Form_Login();       
       $this->view->error_message = ($this->_getParam('errormessage'))?urldecode($this->_getParam('errormessage')):''; 
       if($this->getRequest()->getPost()) {        
          $username = trim($this->getRequest()->getPost('username')); 
          $password = trim($this->getRequest()->getPost('pass'));
                             
          if($username && $password) {
          $getUser = $this->users->getUser($username,$password);//for custom class                
          //$getUser = (array)$this->users->fetchOne(array('_id'=>$username,'password'=>$password))->export();//for shanty  
          
          //if($getUser && count($getUser)==1) {
          if($getUser) {    
             $this->loginNamespace->username = $username;
             $this->_redirect('/blog/index/');
          } else {
             $message = urlencode('Enter proper Username and Password'); 
                $this->_redirect("/blog/index/login/errormessage/$message");   
          }
       }        
    }
    }
    
    /**
     * Sign Up for User
     */
    public function signupAction()
    {
       $this->view->signUpForm = new Blog_Form_Signup();        
       $this->view->success_message = ($this->_getParam('successmessage'))?urldecode($this->_getParam('successmessage')):''; 
       if($this->getRequest()->getPost()) {           
          $username = trim($this->getRequest()->getPost('username'));
          $email    = trim($this->getRequest()->getPost('email'));
          $password = trim($this->getRequest()->getPost('pass'));
          if($username && $email && $password) {
          try {
             $signUp = $this->users->signUp($username,$password,$email);//for custom class
             //$signUp = $this->users->insert(array('_id'=>$username,'password'=>$password,'email'=>$email));//for shanty
            
             if($signUp) {
                //$this->_redirect('/blog/index/');
                $message = urlencode('Signed Up Successfully. Please login.'); 
                   $this->_redirect("/blog/index/signup/successmessage/$message");
             }
             
          } catch (Exception $e) {
             echo 'exception ' . $e->getMessage();exit;
          }          
       }       
    }
    }
    
    /**
     * Save the blog post
     */
    public function blogpostAction()
    {
       $this->view->blogPostForm = new Blog_Form_Blogpost();       
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
                $insertblog = $this->blogpost->postBlog($title,$body,$tags_arr,$user);//for custom class
                //$insertblog = $this->blogpost->insert(array('title'=>$title,'body'=>$body,'tags'=>$tags_arr,'user'=>$user));//for shanty
                if($insertblog) {
                   $this->_redirect('/blog/index/'); 
                }
             } catch (Exception $e) {
                echo 'exception ' . $e->getMessage();exit;
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
       $this->view->addCommentForm = new Blog_Form_Addcomment();       
       $blog_id = trim($this->_getParam('blogid'));
       $this->view->blogData='';
       
       if($blog_id) {          
          $getBlog = $this->blogpost->findBlog($blog_id);//for custom class   
          //$getBlog = (array)$this->blogpost->find($blog_id)->export();//for shanty
          $this->view->blogData = $getBlog;
       }
        
       if($this->getRequest()->getPost()) {         
          $name  = trim($this->getRequest()->getPost('name'));
          $email = trim($this->getRequest()->getPost('email1'));
          $comment  = trim($this->getRequest()->getPost('comment'));
          if($name && $email && $comment) {
             $addcomment = $this->blogpost->addComment($blog_id,$name,$email,$comment);//for custom class
             //$addcomment = $this->blogpost->update(array("_id" => new MongoId($blog_id)), array('$push' => array('comment'=>array('name'=>$name,'email1'=>$email,'content'=>$comment))));//for shanty     
             if($addcomment) {
                $this->_redirect('/blog/index/');
             }
          }
       }
    }

}

