<?php
class Brands extends Model {

    public function add_brand($name) {
        $sql = $this->db->prepare("INSERT INTO brands SET name = :name, reg_date = NOW()");
        $sql->bindValue(":name", $name);
        $sql->execute();
    }

    public function fetchBrands() {
        $sql = $this->db->prepare("SELECT * FROM brands ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $brands = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $brands;
    }

    public function reloadBrands() {
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM brands ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $brands = $sql->fetchAll(PDO::FETCH_ASSOC);

            $data .='<option value="">Selecione...</option>';

            foreach($brands AS $brand) {
                $data .='<option value="'.$brand['id'].'">'.$brand['name'].'</option>';
            }
        }

        return $data;
    }

    public function delete_brand($id) {
        $sql = $this->db->prepare("DELETE FROM brands WHERE id = :id");
        $sql->bindValue(":id", $id);
        if($sql->execute()) {
            return 'REGISTRO EXCLUÍDO COM SUCESSO';
        } else {
            return 'ERRO AO EXCLUIR REGISTRO. FAVOR ENTRAR EM CONTATO COM O ADMINISTRADOR DO SISTEMA';
        }
    }
}