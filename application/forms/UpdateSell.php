<?php

class Application_Form_UpdateSell extends Zend_Form {
    
    public function init() {
        
        $this->_view = Zend_Layout::getMvcInstance()->getView();
        
        $action = $this->_view->url(array(
            'controller'    => 'sell',
            'action'        => 'update',
            'id'            => $_SESSION['id'],
        ));
        
        $this->setAttribs(array(
            'method'        => 'post',
            'action'        => $action,
        ));
        
        $this->addElement('select', 'is_checked', array(
            'label'         => 'Approuver ce produit ?',
            'class'         => 'form-control',
            'style'         => 'width:100px',
            'multiOptions'  => array(0 => '',
                                     1 => 'Oui', 
                                     2 => 'Non')
        ));
        
        $this->addElement('submit', 'submit', array(
            'label'         => 'Valider',
            'style'         => 'margin-top:20px;',
            'class'         => 'btn btn-primary btn-sm',
        ));
    }
}