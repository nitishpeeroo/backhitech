<?php

class Application_Model_Event extends Zend_Db_Table_Abstract {

    protected $_dbname = DB_NAME_HI_TECH_ONLINE;
    protected $_name = DB_TABLE_EVENEMENT;
    public $data = array();


    public function insertEvent($titre,$description,$debut,$fin) {
        try {

            $this->insert(array(
                'libelle_evenement' => $titre,
                'description_evenement'     => $description,
                'debut_evenement' => $debut,
                'fin_evenement' => $fin
            ));
        } catch (Exception $ex) {
            echo 'ERROR_insertEvent : ' . $ex->getMessage();
            return false;
        }

        return true;
    }

    /* Modifie une catégorie existante */

    public function updateCategory($id, $label, $parent) {

        try {

            $this->update(array(
                'label_category' => $label,
                'parent' => $parent,
                    ), 'id_category = ' . $id);
        } catch (Exception $ex) {

            echo 'ERROR_UPDATE_UPDATECATEGORY : ' . $ex->getMessage();
            return false;
        }

        return true;
    }

}
