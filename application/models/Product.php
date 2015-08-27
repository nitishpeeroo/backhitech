<?php

class Application_Model_Product extends Zend_Db_Table_Abstract {

    protected $_dbname = DB_NAME_HI_TECH_ONLINE;
    protected $_name = DB_TABLE_PRODUIT;
    public $data = array();

    public function insertProduct($nom, $description, $quantite) {
        try {

            $this->insert(array(
                'nom' => $nom,
                'quantite' => $quantite,
                'description' => $description
            ));
        } catch (Exception $ex) {
            echo 'ERROR_insertProduct : ' . $ex->getMessage();
            return false;
        }
        $product = $this->selectProduct("last");

        return $product[0];
    }

    public function selectProduct($last = "") {
        if ($last == "") {
                $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(DB_TABLE_PRODUIT);

        } else {
            $select = $this->select()
                    ->setIntegrityCheck(false)
                    ->from(DB_TABLE_PRODUIT)
                    ->order('created_at DESC')
                    ->limit(1);
        }

        try {
            $tab = $this->fetchAll($select)->toArray();
        } catch (Exception $ex) {

            echo 'selectProduct : ' . $ex->getMessage();
            return false;
        }

        $this->data = $tab;
        return $this->data;
    }

    public function updateProductImage($id, $image) {

        try {

            $this->update(array(
                'image' => $image,
                    ), 'id = ' . $id);
        } catch (Exception $ex) {

            echo 'updateProductImage : ' . $ex->getMessage();
            return false;
        }

        return true;
    }

}
