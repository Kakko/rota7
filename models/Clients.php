<?php
class Clients extends Model {

    public function addClient($name, $address, $cpf, $birth_date, $email, $phone, $phone2, $state_id, $city_id, $brand, $model, $hoop, $color, $serial_number, $basket, $garupa, $garupa_almofada, $pedana, $obs) {

        $sql = $this->db->prepare("INSERT INTO clients SET name = :name, address = :address, cpf = :cpf, birth_date = :birth_date, email = :email, phone1 = :phone1, phone2 = :phone2, state_id = :state_id, city_id = :city_id, reg_date = NOW()");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":birth_date", $birth_date);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone1", $phone);
        $sql->bindValue(":phone2", $phone2);
        $sql->bindValue(":state_id", $state_id);
        $sql->bindValue(":city_id", $city_id);
        if($sql->execute()) {
            if(!empty($brand) || !empty($model)) {
                $client_id = $this->db->lastInsertId();

                $sql = $this->db->prepare("INSERT INTO bicicles SET brand = :brand, model = :model, hoop = :hoop, color = :color, serial_number = :serial_number, basket = :basket, garupa = :garupa, garupa_almofada = :garupa_almofada, pedana = :pedana, obs = :obs, client_id = :client_id, reg_date = NOW()");
                $sql->bindValue(":brand", $brand);
                $sql->bindValue(":model", $model);
                $sql->bindValue(":hoop", $hoop);
                $sql->bindValue(":color", $color);
                $sql->bindValue(":serial_number", $serial_number);
                $sql->bindValue(":basket", $basket);
                $sql->bindValue(":garupa", $garupa);
                $sql->bindValue(":garupa_almofada", $garupa_almofada);
                $sql->bindValue(":pedana", $pedana);
                $sql->bindValue(":obs", $obs);
                $sql->bindValue(":client_id", $client_id);
                $sql->execute();
            }

            return 'Cliente cadastrado com sucesso';
        } else {
            return 'Erro ao cadastrar cliente. Favor entrar em contato com o administrador do sistema';
        }
    }

    public function fetchClients() {
        $sql = $this->db->prepare("SELECT cidades.cidade as city_name, clients.* 
                                    FROM clients 
                                    LEFT JOIN cidades ON (clients.city_id = cidades.id)
                                    ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $clients = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $clients;
    }

    public function fetchClient($id) {
        $data = '';
        $utils = new Utils();

        $sql = $this->db->prepare("SELECT * FROM bicicles WHERE client_id = :client_id");
        $sql->bindValue(":client_id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $bicicles = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $bicicles = array();
        }

        $sql = $this->db->prepare("SELECT estados.estado AS state, cidades.cidade AS city, clients.* 
                                    FROM clients 
                                    LEFT JOIN estados ON (estados.id = clients.state_id)
                                    LEFT JOIN cidades ON (cidades.id = clients.city_id)
                                    WHERE clients.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $client = $sql->fetch(PDO::FETCH_ASSOC);
            
            $data .='
                <div class="row">
                    <div class="col-sm-5">
                        <label>Nome:</label>
                        <input type="text" value="edit" name="action" hidden>
                        <input type="text" value="'.$client['id'].'" name="id" hidden>
                        <input type="text" class="form-control form-control-sm" name="name" required value="'.$client['name'].'">
                    </div>
                    <div class="col-sm-5">
                        <label>Endereço:</label>
                        <input type="text" class="form-control form-control-sm" name="address" value="'.$client['address'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>CPF:</label>
                        <input type="text" class="form-control form-control-sm cpf" name="cpf" placeholder="000.000.000-00" value="'.$client['cpf'].'">
                    </div>
                </div>
                <div class="row">  
                    <div class="col-sm-3">
                        <span>Data de Nascimento</span>
                        <input type="date" class="form-control form-control-sm" name="birth_date" value="'.$client['birth_date'].'">
                    </div>
                    <div class="col-sm-6">
                        <label>E-mail:</label>
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="email@email.com.br" value="'.$client['email'].'">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label>Telefone 1:</label>
                        <input type="text" class="form-control form-control-sm phone_with_ddd" name="phone" placeholder="(47) 9 9999-9999" value="'.$client['phone1'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>Telefone 2:</label>
                        <input type="text" class="form-control form-control-sm phone_with_ddd" name="phone2" placeholder="(47) 9 9999-9999" value="'.$client['phone2'].'">
                    </div>
                    <div class="col-sm-4">
                        <label>Estado:</label>
                        <select class="form-control form-control-sm" name="state" onchange="fetchCities()">
                            <option value="'.$client['state_id'].'">'.$client['state'].'</option>
                            <option value="" readonly></option>';
                                foreach($utils->fetchStates() as $state) {
                                    $data .='
                                        <option value="'.$state['id'].'">'.$state['estado'].'</option>
                                    ';
                                }
                            $data .='
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Cidade:</label>
                        <select class="form-control form-control-sm" name="city" id="city">
                            <option value="'.$client['city_id'].'">'.$client['city'].'</option>
                            <option value="" readonly></option>
                        </select>
                    </div>
                </div>
                <hr/>
                <div class="row">';
                    if(!empty($bicicles)) {
                        $data .='<h5>Bicicletas Cadastradas</h5>';
                    }
                    $data.='
                </div>';
                    foreach($bicicles as $bike) {
                        ($bike['basket'] == 'S') ? $basket = 'checked' : $basket = '';
                        ($bike['garupa'] == 'S') ? $garupa = 'checked' : $garupa = '';
                        ($bike['garupa_almofada'] == 'S') ? $garupaAlm = 'checked' : $garupaAlm = '';
                        ($bike['pedana'] == 'S') ? $pedana = 'checked' : $pedana = '';

                        $data .='
                            <div class="row">
                                <div class="col-sm-2">
                                    <span>Marca</span>
                                    <input type="text" class="form-control form-control-sm" name="b_brand" value="'.$bike['brand'].'">
                                    <input type="text" value="'.$bike['id'].'" name="b_id" hidden>
                                </div>
                                <div class="col-sm-2">
                                    <span>Modelo</span>
                                    <input type="text" class="form-control form-control-sm" name="b_model" value="'.$bike['model'].'">
                                </div>
                                <div class="col-sm-1">
                                    <span>Aro</span>
                                    <input type="text" class="form-control form-control-sm" name="b_hoop" value="'.$bike['hoop'].'">
                                </div>
                                <div class="col-sm-2">
                                    <span>Cor</span>
                                    <input type="text" class="form-control form-control-sm" name="b_color" value="'.$bike['color'].'">
                                </div>
                                <div class="col-sm-2">
                                    <span>Nº de Série</span>
                                    <input type="text" class="form-control form-control-sm" name="b_serial" value="'.$bike['serial_number'].'">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-sm-12">
                                    <span><b>Acessórios</b></span>
                                </div>
                                <div class="col-sm-2">
                                    <label for="b_basket">Cestinha</label>
                                    <input class="form-check-input" type="checkbox" id="b_basket" name="b_basket" '.$basket.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="b_garupa">Garupeira</label>
                                    <input class="form-check-input" type="checkbox" id="b_garupa" name="b_garupa" '.$garupa.'>
                                </div>
                                <div class="col-sm-3">
                                    <label for="b_garupa_almofada">Garupeira com Almofadinha</label>
                                    <input class="form-check-input" type="checkbox" id="b_garupa_almofada" name="b_garupa_almofada" '.$garupaAlm.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="b_pedana">Pedana</label>
                                    <input class="form-check-input" type="checkbox" id="b_pedana" name="b_pedana" '.$pedana.'>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-sm-12">
                                    <span><b>Observações</b></span><br/>
                                    <textarea name="b_obs" style="height: 150px; width: 100%; resize: none; padding: 10px; border: 1px solid #CCC; border-radius: 5px">'.$bike['obs'].'</textarea>
                                </div>
                            </row>
                        ';
                    }
                $data .='
            ';
        }
        return $data;
    }

    public function updClient($id, $name, $address, $cpf, $birth_date, $email, $phone, $phone2, $state_id, $city_id, $b_id, $brand, $model, $hoop, $color, $serial_number, $basket, $garupa, $garupa_almofada, $pedana, $obs) {

        $sql = $this->db->prepare("UPDATE clients SET name = :name, address = :address, cpf = :cpf, birth_date = :birth_date, email = :email, phone1 = :phone1, phone2 = :phone2, state_id = :state_id, city_id = :city_id WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":birth_date", $birth_date);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone1", $phone);
        $sql->bindValue(":phone2", $phone2);
        $sql->bindValue(":state_id", $state_id);
        $sql->bindValue(":city_id", $city_id);
        if($sql->execute()) {
            if(!empty($brand) || !empty($model)) {

                $sql = $this->db->prepare("UPDATE bicicles SET brand = :brand, model = :model, hoop = :hoop, color = :color, serial_number = :serial_number, basket = :basket, garupa = :garupa, garupa_almofada = :garupa_almofada, pedana = :pedana, obs = :obs, client_id = :client_id WHERE id = :b_id");
                $sql->bindValue(":b_id", $b_id);
                $sql->bindValue(":brand", $brand);
                $sql->bindValue(":model", $model);
                $sql->bindValue(":hoop", $hoop);
                $sql->bindValue(":color", $color);
                $sql->bindValue(":serial_number", $serial_number);
                $sql->bindValue(":basket", $basket);
                $sql->bindValue(":garupa", $garupa);
                $sql->bindValue(":garupa_almofada", $garupa_almofada);
                $sql->bindValue(":pedana", $pedana);
                $sql->bindValue(":obs", $obs);
                $sql->bindValue(":client_id", $id);
                $sql->execute();
            }

            return 'Cliente editado com sucesso';
        } else {
            return 'Erro ao editar cliente. Favor entrar em contato com o administrador do sistema';
        }
    }
}