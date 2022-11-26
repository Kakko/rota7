<?php
class Utils extends Model {

    public function fetchStates() {
        $sql = $this->db->prepare("SELECT * FROM estados ORDER BY estado ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $states = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $states;
    }

    public function fetchCities($id) {
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM cidades WHERE estado_id = :id ORDER BY cidade ASC");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $cities = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $data .='<option value="">Selecione...</option>';
        foreach($cities as $city) {
            $data .='<option value="'.$city['id'].'">'.$city['cidade'].'</option>';
        }

        return $data;
    }
    
}