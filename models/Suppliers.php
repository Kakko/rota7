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

    public function update($id, $name, $corporate_name, $cnpj, $email, $address, $state_id, $city_id, $phone, $obs) {
        $sql = $this->db->prepare("UPDATE suppliers SET name = :name, corporate_name = :corporate_name, cnpj = :cnpj, email = :email, address = :address, state_id = :state_id, city_id = :city_id, phone = :phone, obs = :obs WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":corporate_name", $corporate_name);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":state_id", $state_id);
        $sql->bindValue(":city_id", $city_id);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":obs", $obs);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function edit_supplier($id) {
        $data = '';

        $util = new Utils();

        $sql = $this->db->prepare("SELECT estados.estado AS state_name, cidades.cidade AS city_name, suppliers.* 
                                    FROM suppliers 
                                    LEFT JOIN cidades ON (suppliers.city_id = cidades.id)
                                    LEFT JOIN estados ON (suppliers.state_id = estados.id)
                                    WHERE suppliers.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $supply = $sql->fetch(PDO::FETCH_ASSOC);

            $data .= '
                <div class="row">
                    <div class="col-sm">
                        <label>Nome: </label>
                        <input type="text" name="action" value="update" hidden>
                        <input type="text" name="id" value="'.$supply['id'].'" hidden>
                        <input type="text" class="form-control form-control-sm" name="name" value="'.$supply['name'].'" required>
                    </div>
                    <div class="col-sm">
                        <label>Razão Social:</label>
                        <input type="text" class="form-control form-control-sm" name="corporate_name" value="'.$supply['corporate_name'].'">
                    </div>
                    <div class="col-sm">
                        <label>CNPJ:</label>
                        <input type="text" class="form-control form-control-sm" name="cnpj" value="'.$supply['cnpj'].'">
                    </div>
                    <div class="col-sm">
                        <label>E-mail:</label>
                        <input type="mail" class="form-control form-control-sm" name="email" value="'.$supply['email'].'">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Endereço:</label>
                        <input type="text" class="form-control form-control-sm" name="address" value="'.$supply['address'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>Estado:</label>
                        <select class="form-control form-control-sm" name="state" onchange="fetchCities()">
                            <option value="'.$supply['state_id'].'">'.$supply['state_name'].'</option>
                            <option value="" disabled> ----------------------- </option>';
                            foreach($util->fetchStates() AS $states){
                                $data .='<option value="'.$states['id'].'">'.$states['estado'].'</option>';
                            }
                            $data .='
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label>Cidade:</label>
                        <select class="form-control form-control-sm" name="city" id="city">
                            <option value="'.$supply['city_id'].'">'.$supply['city_name'].'</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label>Telefone:</label>
                        <input type="text" class="form-control form-control-sm" name="phone" placeholder="(XX) X XXXX-XXXX" value="'.$supply['phone'].'">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label>Observações</label>
                        <textarea class="form-control form-control-sm" name="obs" style="resize: none; height: 100px">'.$supply['obs'].'</textarea>
                    </div>
                </div>
            ';

            return $data;

        }
    }

    public function deleteBrand($id) {
        $sql = $this->db->prepare("DELETE FROM suppliers WHERE id = :id");
        $sql->bindValue(":id", $id);
        if($sql->execute()) {
            return 'Item excluido com sucesso';
        }
    }
}
