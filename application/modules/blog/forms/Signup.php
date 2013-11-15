<?php

class Blog_Form_Signup extends Zend_Form
{
    
    public function init()
    {
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Enter Username');
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Enter Email');
        $pass = new Zend_Form_Element_Password('pass');
        $pass->setLabel('Enter Password');
        $submit = new Zend_Form_Element_Submit('submit');        
        $this->addElements(array($username,$email,$pass,$submit));
    }
    
}

