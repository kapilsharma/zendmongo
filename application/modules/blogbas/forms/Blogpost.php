<?php

class Blogbas_Form_Blogpost extends Zend_Form
{

    public function init()
    {
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title');
        $body = new Zend_Form_Element_Textarea('body');
        $body->setLabel('Body');
        $body->setAttrib('rows', '4');
        $body->setAttrib('cols', '30');
        $tags = new Zend_Form_Element_Text('tags');
        $tags->setLabel('Tags');
        $submit = new Zend_Form_Element_Submit('submit');        
        $this->addElements(array($title,$body,$tags,$submit));
    }

}

