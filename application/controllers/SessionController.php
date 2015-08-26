<?php

class SessionController extends Zend_Controller_Action {

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

    public function connectAction() {
        if ($this->_request->isPost()) {
            $login = $_POST['identifiant'];
            $mdp = $_POST['password'];
            $user = new Application_Model_Acteur();
            $connection = $user->getUser($login, $mdp);
            if (!isset($connection['id_acteur'])) {
                echo "vous n'exister pas";
            } else {
                $this->sess = new Zend_Session_Namespace('acteur');
                $this->sess->data = $connection;
                $this->_redirect($this->view->url(array('controller' => 'index', 'action' => 'accueil'), null, true));
            }
            // sign up
        }
    }

    public function deconnexionAction() {
        Zend_Session:: namespaceUnset("acteur");
        Zend_Session::destroy(true);
        $this->_redirect($this->view->url(array('controller' => 'index', 'action' => 'index'), null, true));
    }

}
