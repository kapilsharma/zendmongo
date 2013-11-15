<?php

class Blog_Form_Addcomment extends Zend_Form
{
    
    public function init()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name');
        $email1 = new Zend_Form_Element_Text('email1');
        $email1->setLabel('Email');
        $comment = new Zend_Form_Element_Textarea('comment');
        $comment->setLabel('Comment');
        $comment->setAttrib('rows', '4');
        $comment->setAttrib('cols', '30');
        $submit = new Zend_Form_Element_Submit('submit');        
        $this->addElements(array($name,$email1,$comment,$submit));
    }

}

