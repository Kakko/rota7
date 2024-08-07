<?php
class Utils extends Model {

    public function fetchStates() {
        $sql = $this->db->prepare("SELECT * FROM estados ORDER BY estado ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function fetchCities($id) {
        
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM cidades WHERE estado_id = :id ORDER BY cidade ASC");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $cities = $sql->fetchAll(PDO::FETCH_ASSOC);
            $data .='<option value="">Selecione ...</option>';
            foreach($cities as $city) {
                $data .='
                    <option value="'.$city['id'].'">'.$city['cidade'].'</option>
                ';
            }
        }

        return $data;
    }

    public function verifySupplier($cnpj) {
        $sql = $this->db->prepare("SELECT * FROM suppliers WHERE cnpj = :cnpj");
        $sql->bindValue(":cnpj", $cnpj);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyBrand($name) {

        $sql = $this->db->prepare("SELECT * FROM brands WHERE name = :name");
        $sql->bindValue(":name", $name);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyCat($name) {

        $sql = $this->db->prepare("SELECT * FROM categories WHERE name = :name");
        $sql->bindValue(":name", $name);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyCPF($cpf) {
        $sql = $this->db->prepare("SELECT * FROM clients WHERE cpf = :cpf");
        $sql->bindValue(":cpf", $cpf);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}