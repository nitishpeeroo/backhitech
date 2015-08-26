<?php

class SellController extends Zend_Controller_Action {
    
    public function init()              {
        
        parent::init();
        $this->sell = new Application_Model_Sell();
    }
    
    public function checkedAction()     {
        
        $this->view->headTitle('Ventes en ligne');
        $this->view->code_menu      = 'Vente';
        $this->view->code_sous_menu = 'Checked';
        
        $this->view->resultat       = $this->sell->getSells(1);
    }
    
    public function uncheckedAction()   {
        
        $this->view->headTitle('Ventes en attente');
        $this->view->code_menu      = 'Vente';
        $this->view->code_sous_menu = 'Unchecked';
        
        $this->view->resultat       = $this->sell->getSells(0);
    }
    
    public function refusedAction()     {
        
        $this->view->headTitle('Ventes refusées');
        $this->view->code_menu      = 'Vente';
        $this->view->code_sous_menu = 'Refused';
        
        $this->view->resultat       = $this->sell->getSells(2);
    }
    
    public function updateAction()      {
        
        $this->view->headTitle('Modifier');
        $this->view->code_menu          = 'Vente';
        
        $_SESSION['id']                 = $this->_getParam("id");
        $sell                           = $this->sell->getSell($_SESSION['id']);
        $this->view->image              = base64_encode($sell['image']);
        $this->view->name_image         = pathinfo($sell['name_image'], PATHINFO_EXTENSION);
        $this->view->sell               = $sell;
        
        $this->view->form               = new Application_Form_UpdateSell();
        $this->view->form->is_checked   ->setValue($sell['is_checked']);
        
        if($this->_request->isPost()) {
            
            $erreur                 = 0;
            $this->view->message    = "";
            $req                    = $this->getRequest();
            $is_checked             = $req->getParam('is_checked');
            
            if($is_checked == 0)    {
                
                $erreur++;
                $this->view->message .= "<div style='color:red'><strong>Veuillez préciser si vous approuvez ou non cette vente.</strong></div>";
            }
            
            if($erreur == 0)        {
            
                $this->sell->updateSell(
                    $_SESSION['id'],
                    $is_checked
                );
                
                if($is_checked == 1)        {
                    
                    $this->_redirect($this->view->url(array(
                        'controller'    => 'sell', 
                        'action'        => 'checked'), null, true
                    ));
                }
                elseif($is_checked == 2)    {
                    
                    $this->_redirect($this->view->url(array(
                        'controller'    => 'sell', 
                        'action'        => 'refused'), null, true
                    ));
                }
            }
        }
    }
}