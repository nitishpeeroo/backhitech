<?php

class UserController extends Zend_Controller_Action {
    
    public function init()              {
        
        parent::init();
        $this->user = new Application_Model_User();
    }
    
    public function usersAction()       {
        
        $this->view->headTitle('Utilisateurs');
        $this->view->code_menu      = 'User';
        $this->view->code_sous_menu = 'Users';
        
        $this->view->resultat       = $this->user->getUsers();
    }
    
    public function blockedAction()     {
        
        $this->view->headTitle('Utilisateurs bloqués');
        $this->view->code_menu      = 'User';
        $this->view->code_sous_menu = 'Blocked';
        
        $this->view->resultat       = $this->user->getUsersBlocked();
    }
    
    public function blockAction()       {
        
        $this->view->headTitle('Utilisateurs');
        $this->view->code_menu      = 'User';
        $this->view->code_sous_menu = 'Users';
        
        $_SESSION['id']             = $this->_getParam('id');
        $user                       = $this->user->getUser($_SESSION['id']);
        
        $this->view->form           = new Application_Form_UpdateUser();
        $this->view->user           = $user;
        
        $this->view->form->is_blocked->setValue($user['is_blocked']);
        
        if($this->_request->isPost()) {
            
            $req                = $this->getRequest();
            $is_blocked         = $req->getParam('is_blocked');
            
            $this->user->blockUser($_SESSION['id'], $is_blocked);
            
            if($is_blocked == 0) {
                
                $this->_redirect($this->view->url(array(
                    'controller'    => 'user', 
                    'action'        => 'users'), null, true
                ));
            }
            elseif($is_blocked == 1) {
                
                $this->_redirect($this->view->url(array(
                    'controller'    => 'user', 
                    'action'        => 'blocked'), null, true
                ));
            }
        }
    }
}