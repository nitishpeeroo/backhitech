<?php

class EventController extends Zend_Controller_Action {

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

        $this->view->headTitle('Evènement');
    }

    public function creationAction() {
        
    }

    public function convertDate($date, $time) {

        $explode = explode(" ", $date);
        $jour = intval($explode[0]);
        if ($jour < 10) {
            $jour = "0" . $jour;
        }
        switch ($explode[1]) {
            case'January,':
                $mois = "01";
                break;
            case'Frebruary,':
                $mois = "02";
                break;
            case 'March,':
                $mois = "03";
                break;
            case'April,':
                $mois = "04";
                break;
            case 'May,':
                $mois = "05";
                break;
            case'June,':
                $mois = "06";
                break;
            case 'July,':
                $mois = "07";
                break;
            case'August,':
                $mois = "08";
                break;
            case"September,":
                $mois = "09";
                break;
            case "October,":
                $mois = "10";
                break;
            case "November":
                $mois = "11";
                break;
            case'December':
                $mois = "12";
                break;
        }
        $date = $explode[2] . "-" . $mois . "-" . $jour;
        $datetime .= $date . " " . $time . ":00:00";
        return $datetime;
    }

    public function createAction() {
        if ($this->_request->isPost()) {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $debut = $_POST['debut'];
            $debutHeure = $_POST['debutHeure'];
            $fin = $_POST['debut'];
            $finHeure = $_POST['finHeure'];
            $debut = $this->convertDate($debut, $debutHeure);
            $fin = $this->convertDate($fin, $finHeure);
            $event = new Application_Model_Event();
            $save = $event->insertEvent($titre, $description, $debut, $fin);
                $this->_redirect($this->view->url(array('controller' => 'event', 'action' => 'liste'), null, true));
            // sign up
        }
    }
    
    public function listeAction(){
        
    }

}
