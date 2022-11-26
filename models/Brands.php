<?php
class Brands extends Model {

    public function addNewBrand($name) {
        $sql = $this->db->prepare("INSERT INTO brands SET name = :name, reg_date = NOW()");
        $sql->bindValue(":name", $name);
        $sql->execute();
    }

    public function fetchBrands() {
        $brands = array();
        $sql = $this->db->prepare("SELECT * FROM brands ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $brands = $sql->fetchAll(PDO::FETCH_ASSOC);  
        } 

        return $brands;

    }
}