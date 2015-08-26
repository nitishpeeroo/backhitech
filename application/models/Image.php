<?php

class Application_Model_Image extends Zend_Db_Table_Abstract {
    
    protected $_dbname      = DB_NAME_TELEMAQUE;
    protected $_name        = DB_TABLE_IMAGE;
    public $data            = array();   
    
    public function addImage($name, $image) {
        
        $this->insert(array(
            'id_image' => 1,
            'name_image' => $name,
            'image' => $image
        ));
    }
    
    public function getImage() {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(DB_TABLE_IMAGE);
        
        return $this->fetchAll($select)->toArray();
    }
}