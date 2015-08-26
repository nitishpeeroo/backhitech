<?php 

class Application_Form_UpdateUser extends Zend_Form {

    public function init() {
        
        $this->_view = Zend_Layout::getMvcInstance()->getView();
        
        $action = $this->_view->url(array(
            'controller'    => 'user',
            'action'        => 'block',
            'id'            => $_SESSION['id'],
        ));
        
        $this->setAttribs(array(
            'method'        => 'post',
            'action'        => $action,
        ));
        
        $this->addElement('select', 'is_blocked', array(
            'label'         => 'Bloquer cet utilisateur ?',
            'class'         => 'form-control',
            'style'         => 'width:100px',
            'multiOptions'  => array(0 => 'Non', 
                                     1 => 'Oui')
        ));
        
        $this->addElement('submit', 'submit', array(
            'label'         => 'Valider',
            'class'         => 'btn btn-primary btn-sm',
        ));
    }
}