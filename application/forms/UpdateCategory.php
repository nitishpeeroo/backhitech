<?php

class Application_Form_UpdateCategory extends Zend_Form {

    public function init() {
        
        $this->_view = Zend_Layout::getMvcInstance()->getView();
        
        $action = $this->_view->url(array(
            'controller'    => 'category',
            'action'        => 'update',
            'id'            => $_SESSION['id'],
        ));
        
        $this->setAttribs(array(
            'method'        => 'post',
            'action'        => $action,
        ));
        
        $this->addElement('text', 'label_category', array(
            'class'         => 'form-control',
            'style'         => 'width:500px',
        ));
        
        $this->addElement('select', 'parent', array(
            'class'         => 'form-control',
            'style'         => 'width:500px',
            'label'         => 'Catégorie parent ?',
            'multioptions'  => array(NULL => 'Aucune'),
        ));
        
        $this->addElement('file', 'image', array(
            'class'         => 'form-control',
            'label'         => 'Logo de la catégorie',
            'style'         => 'width:500px',
        ));
        
        $this->addElement('submit', 'submit', array(
            'label'         => 'Modifier',
            'class'         => 'btn btn-primary btn-sm',
        ));
    }
}