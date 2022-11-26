<?php
class Clients extends Model {

    public function addClient($name, $address, $cpf, $email, $phone, $state_id, $city_id) {
        $sql = $this->db->prepare("INSERT INTO clients SET name = :name, address = :address, cpf = :cpf, email = :email, phone = :phone, state_id = :state_id, city_id = :city_id, reg_date = NOW()");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":state_id", $state_id);
        $sql->bindValue(":city_id", $city_id);
        $sql->execute();
    }

    public function fetchClients() {
        $clients = array();

        $sql = $this->db->prepare("SELECT * FROM clients ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $clients = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $clients;
    }
}