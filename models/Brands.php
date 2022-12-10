<?php
class Brands extends Model {

    public function addNewBrand($name) {
        $sql = $this->db->prepare("SELECT * FROM brands WHERE name = :name");
        $sql->bindValue(":name", $name);
        $sql->execute();

        if($sql->rowCount() == 0) {
            $sql = $this->db->prepare("INSERT INTO brands SET name = :name, reg_date = NOW()");
            $sql->bindValue(":name", $name);
            $sql->execute();
        } else {
            return 'Marca já Cadastrada';
        }
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

    public function deleteBrand($id) {
        
        $sql = $this->db->prepare("DELETE FROM brands WHERE id = :id");
        $sql->bindValue(":id", $id);
        if($sql->execute()) {
            return 'Item excluido com sucesso';
        }
    }
}