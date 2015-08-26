<?php

class GeneralController extends Zend_Controller_Action {
    
    public function init()          {
        
        parent::init();
        $this->_flashMessenger  = $this->_helper->getHelper('FlashMessenger');
        $this->general          = new Application_Model_General();
    }
    
    public function infosAction()   {
        
        $this->view->headTitle('Informations');
        $this->view->code_menu              = 'General';
        $this->view->code_sous_menu         = 'Infos';
        
        $this->view->resultat               = $this->general->getInformations();
    }
    
    public function updateAction()  {
        
        if (count($this->_flashMessenger->getMessages()) > 0) {

            $this->view->messageValide = $this->_flashMessenger->getMessages();
        }
        
        $this->view->headTitle('Modifier les informations');
        $this->view->code_menu                          = 'General';
        $this->view->code_sous_menu                     = 'Infos';
        
        $this->view->form                               = new Application_Form_UpdateInfos();
        $infos                                          = $this->general->getInformations();
        
        $this->view->form->catchphrase                  ->setValue($infos['catchphrase']);
        $this->view->form->link_facebook                ->setValue($infos['link_facebook']);
        $this->view->form->link_twitter                 ->setValue($infos['link_twitter']);
        $this->view->form->website_email                ->setValue($infos['website_email']);
        $this->view->form->website_address              ->setValue($infos['website_address']);
        $this->view->form->website_code_postal          ->setValue($infos['website_code_postal']);
        $this->view->form->website_ville                ->setValue($infos['website_ville']);
        $this->view->form->website_pays                 ->setValue($infos['website_pays']);
        $this->view->form->website_phone                ->setValue($infos['website_phone']);
        $this->view->form->website_limit_product_index  ->setValue($infos['website_limit_product_index']);
        
        if($this->_request->isPost()) {
            
            $infos                      = $this->general->getInformations();
            
            $req                        = $this->getRequest();
            $catchphrase                = $req->getParam('catchphrase');
            $link_facebook              = $req->getParam('link_facebook');
            $link_twitter               = $req->getParam('link_twitter');
            $email                      = $req->getParam('website_email');
            $address                    = $req->getParam('website_address');
            $code_postal                = $req->getParam('website_code_postal');
            $ville                      = $req->getParam('website_ville');
            $pays                       = $req->getParam('website_pays');
            $phone                      = $req->getParam('website_phone');
            $limit                      = $req->getParam('website_limit_product_index');
            
            if(empty($catchphrase))     {
                
                $catchphrase = $infos['catchphrase'];
            }
            
            if(empty($link_facebook))   {
                
                $link_facebook = $infos['link_facebook'];
            }
            
            if(empty($link_twitter))    {
                
                $link_twitter = $infos['link_twitter'];
            }
            
            if(empty($email))           {
                
                $email = $infos['website_email'];
            }
            
            if(empty($address))         {
                
                $address = $infos['website_address'];
            }
            
            if(empty($code_postal))     {
                
                $code_postal = $infos['website_code_postal'];
            }
            
            if(empty($ville))           {
                
                $ville = $infos['website_ville'];
            }
            
            if(empty($pays))            {
                
                $pays = $infos['website_pays'];
            }
            
            if(empty($phone))           {
                
                $phone = $infos['website_phone'];
            }
            
            if(empty($limit))           {
                
                $limit = $infos['website_limit_product_index'];
            }

            $this->general->updateInformations(
                    $infos['id'], 
                    $catchphrase, 
                    $link_facebook, 
                    $link_twitter, 
                    $email, 
                    $limit
            );

            $this->_flashMessenger->addMessage("<div style='color:green'><strong>Modification effectuée.</strong></div>");

            $this->_redirect($this->view->url(array(
                'controller'    => 'general', 
                'action'        => 'update',
                'id'            => $_SESSION['id']), null, true
            ));
        }
    }
}