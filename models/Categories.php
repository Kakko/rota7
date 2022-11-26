<?php
class Categories extends Model {

    public function addNewCategory($name) {
        $sql = $this->db->prepare("INSERT INTO categories SET name = :name, reg_date = NOW()");
        $sql->bindValue(":name", $name);
        $sql->execute();
    }

    public function fetchCategories() {
        $categories = array();

        $sql = $this->db->prepare("SELECT * FROM categories ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $categories = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $categories;

    }
}