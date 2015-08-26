<?php

class Application_Model_Contact extends Zend_Db_Table_Abstract {
    
    protected $_dbname  = DB_NAME_HI_TECH_ONLINE;
    protected $_name    = DB_TABLE_CONTACT;
    public $data        = array();
    
    public function getMessages() {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('c' => DB_TABLE_CONTACT), array(
                           'c.id_contact',
                           'c.object',
                           'c.message',
                           'c.firstname_contact',
                           'c.lastname_contact',
                           'c.mail_contact',
                           'c.dt_send',
                       ))
                       ->order('c.dt_send DESC');
        
        try {
            
            $tab = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETMESSAGES : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $tab;
        return $this->data;
    }
    
    public function getMessage($id) {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('c' => DB_TABLE_CONTACT), array(
                           'c.id_contact',
                           'c.object',
                           'c.message',
                           'c.firstname_contact',
                           'c.lastname_contact',
                           'c.mail_contact',
                           'c.dt_send',
                       ))
                       ->where('c.id_contact = ?', $id);
        
        try {
            
            $tab = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETMESSAGES : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $tab[0];
        return $this->data;
    }
}