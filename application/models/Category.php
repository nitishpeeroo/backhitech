<?php

class Application_Model_Category extends Zend_Db_Table_Abstract {
    
    protected $_dbname  = DB_NAME_HI_TECH_ONLINE;
    protected $_name    = DB_TABLE_CATEGORIE;
    public $data        = array();
    
    /* Retourne la liste des catégories d'article */
    public function getCategories()                                   {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('c' => DB_TABLE_CATEGORY), array(
                           'c.id_categorie',
                           'c.label',
                           'c.parent',
                       ));
        
        try {
            
            $tab = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETCATEGORIES : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $tab;
        return $this->data;
    }
    
    /* Retourne la catégorie souhaitée */
    public function getCategory($id)                                  {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('c' => DB_TABLE_CATEGORY), array(
                           'c.id_category',
                           'c.label_category',
                           'c.parent',
                       ))
                       ->joinInner(array('i' => DB_TABLE_CATEGORY_IMAGE), 'c.id_category = i.id_category', array(
                           'i.id_image',
                           'i.name_image',
                           'i.image',
                           'i.id_category'
                       ))
                       ->where('c.id_category = ?', $id);
        
        try {
            
            $row = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETCATEGORY : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $row[0];
        return $this->data;
    }
    
    /* Retourne la catégorie souhaitée */
    public function getLaCategoryID($label)                           {
        
        $select = $this->select()
                       ->distinct()
                       ->setIntegrityCheck(false)
                       ->from(DB_TABLE_CATEGORY)
                       ->where('label_category = ?', $label);
        
        try {
            
            $row = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETCATEGORY : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $row[0]['id_category'];
        return $this->data;
    }
    
    /* Ajoute une nouvelle catégorie */
    public function addCategory($label, $parent)                      {
        
        try {
            
            $this->insert(array(
                'label_category' => $label,
                'parent'         => $parent,
            ));
        }
        catch(Exception $ex) {
            
            echo 'ERROR_INSERT_ADDCATEGORY : ' . $ex->getMessage();
            return false;
        }
        
        return true;
    }
    
    /* Modifie une catégorie existante */
    public function updateCategory($id, $label, $parent)              {
        
        try {
            
            $this->update(array(
                'label_category' => $label,
                'parent' => $parent,
            ), 'id_category = ' . $id);
        } 
        catch (Exception $ex) {

            echo 'ERROR_UPDATE_UPDATECATEGORY : ' . $ex->getMessage();
            return false;
        }
        
        return true;
    }
}