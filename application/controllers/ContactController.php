<?php

class ContactController extends Zend_Controller_Action {
    
    public function init()              {
        
        parent::init();
        $this->contact = new Application_Model_Contact();
    }
    
    public function messagesAction()    {
        
        $this->view->headTitle("Messages");
        $this->view->code_menu          = "Contact";
        $this->view->code_sous_menu     = "Messages";
        
        $this->view->messages           = $this->contact->getMessages();
    }
    
    public function messageAction()     {
        
        $this->view->headTitle("Message");
        $this->view->code_menu          = "Contact";
        $this->view->code_sous_menu     = "Messages";
        
        $_SESSION['id']                 = $this->_getParam('id');
        $this->view->message            = $this->contact->getMessage($_SESSION['id']);
    }
}