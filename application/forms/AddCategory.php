<?php

class Application_Form_AddCategory extends Zend_Form {

    public function init() {
        
        $this->addElement('text', 'label_category', array(
            'required'      => true,
            'placeholder'   => 'Label',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('select', 'parent', array(
            'required'      => true,
            'class'         => 'form-control',
            'style'         => 'width:500px',
            'label'         => 'Catégorie parent ?',
            'multioptions'  => array(NULL => 'Aucune (catégorie principale)'),
        ));
        
        $this->addElement('file', 'image', array(
            'required'      => true,
            'class'         => 'form-control',
            'label'         => 'Logo de la catégorie',
            'style'         => 'width:500px',
        ));
        
        $this->addElement('submit', 'submit', array(
            'label'         => 'Valider',
            'class'         => 'btn btn-primary btn-sm',
        ));
        
        $this->setAttrib('action', 'add');
        $this->setMethod('POST');
    }
}