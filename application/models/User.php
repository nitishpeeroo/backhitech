<?php

class Application_Model_User extends Zend_Db_Table_Abstract {
    
    protected $_dbname      = DB_NAME_HI_TECH_ONLINE;
    protected $_name        = DB_TABLE_USER;
    public $data            = array();
    
    public function getUsers()                  {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('u' => DB_TABLE_USER), array(
                           'u.id_user',
                           'u.login_user',
                           'u.password_user',
                           'u.lastname_user',
                           'u.firstname_user',
                           'u.mail_user',
                           'u.phone_user',
                           'u.address_user',
                           'u.codepostal_user',
                           'u.ville_user',
                           'u.sexe_user',
                           'u.level_user',
                           'u.is_blocked',
                       ))
                       ->where('u.is_blocked = 0');
        
        try {
            
            $tab = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETUSERS : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $tab;
        return $this->data;
    }
    
    public function getUsersBlocked()           {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('u' => DB_TABLE_USER), array(
                           'u.id_user',
                           'u.login_user',
                           'u.password_user',
                           'u.lastname_user',
                           'u.firstname_user',
                           'u.mail_user',
                           'u.phone_user',
                           'u.address_user',
                           'u.codepostal_user',
                           'u.ville_user',
                           'u.sexe_user',
                           'u.level_user',
                           'u.is_blocked',
                       ))
                       ->where('u.is_blocked = 1');
        
        try {
            
            $tab = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETUSERS : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $tab;
        return $this->data;
    }
    
    public function getUser($id)                {
        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('u' => DB_TABLE_USER), array(
                           'u.id_user',
                           'u.login_user',
                           'u.password_user',
                           'u.lastname_user',
                           'u.firstname_user',
                           'u.mail_user',
                           'u.is_blocked',
                           'u.phone_user',
                           'u.address_user',
                           'u.codepostal_user',
                           'u.ville_user',
                           'u.sexe_user',
                           'u.level_user',
                       ))
                       ->where('u.id_user = ?', $id);
        
        try {
            
            $row = $this->fetchAll($select)->toArray();
        } 
        catch (Exception $ex) {

            echo 'ERROR_SELECT_GETUSER : ' . $ex->getMessage();
            return false;
        }
        
        $this->data = $row[0];
        return $this->data;
    }
    
    public function blockUser($id, $value)      {
        
        try {
            
            $this->update(array(
                'is_blocked' => $value
            ), 'id_user = ' . $id);
        }
        catch(Exception $ex) {
            
            echo 'ERROR_UPDATE_BLOCKUSER : ' . $ex->getMessage();
            return false;
        }
        
        return true;
    }
}