<?php

class Application_Model_General extends Zend_Db_Table_Abstract {
    
    protected $_dbname  = DB_NAME_HI_TECH_ONLINE;
    protected $_name    = DB_TABLE_GENERAL;
    public $data        = array();
    
    /* Retourne les informations */
    public function getInformations() {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(DB_TABLE_GENERAL);
        
        try {
            
            $tab = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETINFORMATIONS : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $tab;
        return $this->data[0];
    }
    
    /* Modifie une catégorie existante */
    public function updateInformations($id, $catchphrase, $link_facebook, $link_twitter, $email, $limit) {
        
        try {
            
            $this->update(array(
                'catchphrase'                   => $catchphrase,
                'link_facebook'                 => $link_facebook,
                'link_twitter'                  => $link_twitter,
                'website_email'                 => $email,
                'website_limit_product_index'   => $limit,
            
            ), 'id = ' . $id);
        } 
        catch (Exception $ex) {

            echo 'ERROR_UPDATE_UPDATEINFORMATIONS : ' . $ex->getMessage();
            return false;
        }
        
        return true;
    }
}