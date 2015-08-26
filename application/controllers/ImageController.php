<?php

class ImageController extends Zend_Controller_Action {

    public function init()          {
        
        parent::init();
        $this->image = new Application_Model_Image();
    }
    
    public function indexAction()   {
        
        $this->view->image = $this->image->getImage();
        
        foreach($this->view->image as &$TheImage) {
        
            $TheImage['img64']   = base64_encode($TheImage['image']);
            $TheImage['type']    = pathinfo($TheImage['name_image'], PATHINFO_EXTENSION);
        }
    }
    
    public function addAction()     {
        
        $this->view->form = new Application_Form_AddImage();
        
        if($this->_request->isPost()) {
            
            $this->image->addImage(
                    $_FILES['image']['name'], 
                    @file_get_contents($_FILES['image']['tmp_name'])
            );
        }
    }
}
