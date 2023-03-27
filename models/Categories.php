<?php
class Categories extends Model {

    public function fetchCategories() {
        $sql = $this->db->prepare("SELECT * FROM categories ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $categories = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $categories;
    }

    public function addCategory($name) {

        $sql = $this->db->prepare("INSERT INTO categories SET name = :name, reg_date = now()");
        $sql->bindValue(":name", $name);
        if($sql->execute()){
            return true;
        } else {
            return false;
        };
    }

    public function reloadCategory() {
        $data = '';

        $sql = $this->db->prepare("SELECT * FROM categories ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $categories = $sql->fetchAll(PDO::FETCH_ASSOC);
            $data .='<option value="">Selecione...</option>';
            foreach($categories AS $cat) {
                $data .='<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
            }
        }

        return $data;
    }
}