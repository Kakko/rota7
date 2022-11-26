<?php
class Suppliers extends Model {

    public function fetchSuppliers() {
        $sql = $this->db->prepare("SELECT * FROM suppliers ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $suppliers = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            return $suppliers;
        } else {
            return array();
        }

    }

    public function register($name, $corporate_name, $cnpj, $email, $address, $state_id, $city_id, $phone, $obs) {
        $sql = $this->db->prepare("INSERT INTO suppliers SET name = :name, corporate_name = :corporate_name, cnpj = :cnpj, email = :email, address = :address, state_id = :state_id, city_id = :city_id, phone = :phone, obs = :obs, reg_date = NOW()");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":corporate_name", $corporate_name);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":state_id", $state_id);
        $sql->bindValue(":city_id", $city_id);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
    }
}
