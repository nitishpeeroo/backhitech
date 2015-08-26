<?php

class Application_Model_Sell extends Zend_Db_Table_Abstract {
    
    protected $_dbname  = DB_NAME_HI_TECH_ONLINE;
    protected $_name    = DB_TABLE_SELL;
    public $data        = array();
    
    public function getSells($is_checked) {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(DB_TABLE_SELL)
                       ->where('is_checked = ?', $is_checked);
        
        try {
            
            $tab = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETSELLS : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $tab;
        return $this->data;
    }
    
    public function getSell($id) {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('s' => DB_TABLE_SELL), array(
                           's.id_sell',
                           's.id_user',
                           's.id_category',
                           's.description',
                           's.price',
                           's.quantity',
                           's.is_checked',
                           's.title',
                           's.dt_creation',
                           's.dt_modification',
                           's.description_courte',
                       ))
                       ->joinInner(array('i' => DB_TABLE_IMAGE), 'i.id_sell = s.id_sell', array(
                           'i.id_image',
                           'i.name_image',
                           'i.image',
                           'i.id_sell',
                       ))
                       ->where('s.id_sell = ?', $id);
                       
        
        try {
            
            $tab = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETSELL : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $tab;
        return $this->data[0];
    }
    
    public function updateSell($id, $is_checked) {
        
        try {
            
            $this->update(array(
                'is_checked'        => $is_checked,
            ), 'id_sell = ' . $id);
        }
        catch(Exception $ex) {
            
            echo 'ERROR_UPDATE_UPDATESELL : ' . $ex->getMessage();
            return false;
        }
        
        return true;
    }
}