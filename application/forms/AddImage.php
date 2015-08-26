<?php

class Application_Form_AddImage extends Zend_Form {

    public function init() {
        
        $this->addElement('file', 'image', array(
            'required'      => true,
            'class'         => 'form-control',
        ));
        
        $this->addElement('submit', 'submit', array(
            'label'         => 'Valider',
            'class'         => 'btn btn-primary btn-sm',
        ));
        
        $this->setAttrib('action', 'add');
        $this->setMethod('POST');
    }
}