<?php

class Application_Form_UpdateInfos extends Zend_Form {
    
    public function init() {
        
        $this->_view = Zend_Layout::getMvcInstance()->getView();
        
        $action = $this->_view->url(array(
            'controller'    => 'general',
            'action'        => 'update'
        ));
        
        $this->setAttribs(array(
            'method'        => 'post',
            'action'        => $action,
        ));
        
        $this->addElement('text', 'catchphrase', array(
            'label'         => 'Phrase d\'accroche :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'link_facebook', array(
            'label'         => 'Lien de la page Facebook :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'link_twitter', array(
            'label'         => 'Lien du compte Twitter :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'website_email', array(
            'label'         => 'Email de contact :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'website_address', array(
            'label'         => 'Adresse de l\'entreprise :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'website_code_postal', array(
            'label'         => 'Code postal :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'website_ville', array(
            'label'         => 'Ville :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'website_pays', array(
            'label'         => 'Pays :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'website_phone', array(
            'label'         => 'Numéro de téléphone de contact :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('text', 'website_limit_product_index', array(
            'label'         => 'Nombre d\'articles affichés sur la page d\'accueil :',
            'class'         => 'form-control',
            'style'         => 'width:500px'
        ));
        
        $this->addElement('submit', 'submit', array(
            'label'         => 'Modifier',
            'style'         => 'margin-top:20px;',
            'class'         => 'btn btn-primary btn-sm',
        ));
    }
}