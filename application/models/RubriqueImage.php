<?php

class Application_Model_RubriqueImage extends Zend_Db_Table_Abstract {
    
    protected $_dbname  = DB_NAME_HI_TECH_ONLINE;
    protected $_name    = DB_TABLE_CATEGORY_IMAGE;
    public $data        = array();
    
    public function addImage($name, $blob, $id_category) {
        
        try {
            
            $this->insert(array(
                'name_image'    => $name,
                'image'         => $blob,
                'id_category'   => $id_category
            ));
        }
        catch(Exception $ex) {
            
            echo 'ERROR_INSERT_ADDIMAGE : ' . $ex->getMessage();
            return false;
        }
        
        return true;
    }
    
    public function updateImage($name, $blob, $id_category) {
        
        try {
            
            $this->update(array(
                'name_image'    => $name,
                'image'         => $blob
            ), 'id_category = ' . $id_category);
        }
        catch(Exception $ex) {
            
            echo 'ERROR_INSERT_ADDIMAGE : ' . $ex->getMessage();
            return false;
        }
        
        return true;
    }
}