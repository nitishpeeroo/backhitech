<?php

class CategoryController extends Zend_Controller_Action {
    
    public function init()              {
        
        parent::init();
        $this->_flashMessenger  = $this->_helper->getHelper('FlashMessenger');
        $this->category         = new Application_Model_Category();
        $this->rubrique_image   = new Application_Model_RubriqueImage();
    }
    
    public function categoriesAction()  {
        
        $this->view->headTitle('Catégories');
        $this->view->code_menu      = 'Categorie';
        $this->view->code_sous_menu = 'Categories';
        
        $this->view->resultat       = $this->category->getCategories();
    }
    
    public function addAction()         {
        
        $this->view->headTitle('Catégories');
        $this->view->code_menu      = 'Categorie';
        $this->view->code_sous_menu = 'Add';
        
        $this->view->form           = new Application_Form_AddCategory();
        $categories                 = $this->category->getCategories();
        
        foreach($categories as $category)   {
            
            $this->view->form->parent->addMultiOption($category['id_category'], $category['label_category']);
        }
        
        if($this->_request->isPost())       {
            
            $erreur                 = 0;
            $this->view->message    = "";
            
            $req                    = $this->getRequest();
            $label                  = $req->getParam('label_category');
            $parent                 = $req->getParam('parent');
            
            if(empty($label))       {
                
                $erreur++;
                $this->view->message .= "<div style='color:red'><strong>Veuillez mettre un label pour la nouvelle catégorie.</strong></div>";
            }
            
            if($erreur == 0)        {
            
                $this->category->addCategory(
                        $label, 
                        $parent
                );
                
                $laCategoryID = $this->category->getLaCategoryID($label);
                
                $this->rubrique_image->addImage(
                        $_FILES['image']['name'],
                        file_get_contents($_FILES['image']['tmp_name']),
                        $laCategoryID
                );
                
                $this->_redirect($this->view->url(array(
                    'controller'    => 'category',
                    'action'        => 'categories'), null, true
                ));
            }
        }
    }
    
    public function updateAction()      {
        
        if (count($this->_flashMessenger->getMessages()) > 0) {

            $this->view->messageValide = $this->_flashMessenger->getMessages();
        }
        
        $this->view->code_menu              = 'Categorie';
        $this->view->code_sous_menu         = 'Categories';
        
        $_SESSION['id']                     = $this->_getParam('id');
        $category                           = $this->category->getCategory($_SESSION['id']);
        $categories                         = $this->category->getCategories();
        
        $this->view->form                   = new Application_Form_UpdateCategory();
        
        foreach($categories as $laCategory) {
            
            $this->view->form->parent       ->addMultiOption($laCategory['id_category'], $laCategory['label_category']);
        }

        $this->view->form->label_category   ->setValue($category['label_category']);
        $this->view->form->parent           ->setValue($category['parent']);
        
        $category['img64']   = base64_encode($category['image']);
        $category['type']    = pathinfo($category['name_image'], PATHINFO_EXTENSION);
        
        $this->view->category = $category;
        
        if($this->_request->isPost()) {
            
            $category               = $this->category->getCategory($_SESSION['id']);
            
            $req                    = $this->getRequest();
            $label                  = $req->getParam('label_category');
            $parent                 = $req->getParam('parent');
            
            if(empty($label)) {
                
                $label = $category['label_category'];
            }
            
            if(empty($_FILES['image']['name'])) {
                
                $_FILES['image']['name'] = $category['name_image'];
                $blob                    = $category['image'];
            }
            else {
                
                $blob = file_get_contents($_FILES['image']['tmp_name']);
            }
            
            $this->category->updateCategory(
                    $_SESSION['id'], 
                    $label, 
                    $parent
            );
            
            $this->rubrique_image->updateImage(
                    $_FILES['image']['name'], 
                    $blob, 
                    $_SESSION['id']
            );
            
            $this->_flashMessenger->addMessage("<div style='color:green'><strong>Modification effectuée.</strong></div>");
            
            $this->_redirect($this->view->url(array(
                'controller'    => 'category', 
                'action'        => 'update', 
                'id'            => $_SESSION['id']), null, true
            ));
        }
    }
}