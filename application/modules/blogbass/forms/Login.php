<?php

class Blogbass_Form_Login extends Zend_Form
{

    public function init()
    {
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username');
        $pass = new Zend_Form_Element_Password('pass');
        $pass->setLabel('Password');
        $submit = new Zend_Form_Element_Submit('submit');        
        $this->addElements(array($username,$pass,$submit));
    }

}

