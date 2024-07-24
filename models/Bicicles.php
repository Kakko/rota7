<?php
class Bicicles extends Model {

    public function addBike($client_id, $brand, $model, $hoop, $color, $serial, $basket, $garupa, $garupa_almofada, $pedana, $bike_obs) {
        $sql = $this->db->prepare("INSERT INTO bicicles SET brand = :brand, model = :model, hoop = :hoop, color = :color, serial_number = :serial_number, basket = :basket, garupa = :garupa, garupa_almofada = :garupa_almofada, pedana = :pedana, obs = :obs, client_id = :client_id, reg_date = NOW()");
        $sql->bindValue(":client_id", $client_id);
        $sql->bindValue(":brand", $brand);
        $sql->bindValue(":model", $model);
        $sql->bindValue(":hoop", $hoop);
        $sql->bindValue(":color", $color);
        $sql->bindValue(":serial_number", $serial);
        $sql->bindValue(":basket", $basket);
        $sql->bindValue(":garupa", $garupa);
        $sql->bindValue(":garupa_almofada", $garupa_almofada);
        $sql->bindValue(":pedana", $pedana);
        $sql->bindValue(":obs", $bike_obs);
        if($sql->execute()) {
            return 'Bicicleta cadastrada com sucesso';
        } else {
            return 'Erro ao cadastrar bicicleta';
        }
    }
}