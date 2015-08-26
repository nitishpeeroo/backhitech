<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        parent::init();
        zend_session::start();
        $ns = new Zend_Session_Namespace('acteur');
        if (!empty($ns->data)) {
            $this->view->id = $ns->data['id_acteur'];
            $this->view->role = $ns->data['role'];
            $this->view->identifiant = $ns->data['identifiant'];
            $this->view->password = $ns->data['password'];
        }
    }

    public function indexAction() {

        $this->view->headTitle('Accueil');
    }
    public function accueilAction(){

    }

}
