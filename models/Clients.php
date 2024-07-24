<?php
class Clients extends Model {

    public function addClient($name, $address, $cpf, $email, $phone, $state_id, $city_id) {

        $sql = $this->db->prepare("INSERT INTO clients SET name = :name, address = :address, cpf = :cpf, email = :email, phone = :phone1, state_id = :state_id, city_id = :city_id, reg_date = NOW()");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone1", $phone);
        $sql->bindValue(":state_id", $state_id);
        $sql->bindValue(":city_id", $city_id);
        if($sql->execute()) {
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
            
            return $clients;
        } else {
            return array();
        }

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
                    <div class="col-sm-6">
                        <label>E-mail:</label>
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="email@email.com.br" value="'.$client['email'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>Telefone 1:</label>
                        <input type="text" class="form-control form-control-sm phone_with_ddd" name="phone" placeholder="(47) 9 9999-9999" value="'.$client['phone'].'">
                    </div>
                    <div class="col-sm-2">
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
                    <div class="col-sm-2">
                        <label>Cidade:</label>
                        <select class="form-control form-control-sm" name="city" id="city">
                            <option value="'.$client['city_id'].'">'.$client['city'].'</option>
                            <option value="" readonly></option>
                        </select>
                    </div>
                </div>';
        } 
        return $data;
    }

    public function updClient($id, $name, $address, $cpf, $email, $phone, $state_id, $city_id) {

        $sql = $this->db->prepare("UPDATE clients SET name = :name, address = :address, cpf = :cpf, email = :email, phone = :phone, state_id = :state_id, city_id = :city_id WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":state_id", $state_id);
        $sql->bindValue(":city_id", $city_id);
        if($sql->execute()) {
            return 'Cliente editado com sucesso';
        } else {
            return 'Erro ao editar cliente. Favor entrar em contato com o administrador do sistema';
        }
    }

    public function search_client_name($client_name) {
        $data = '';

        $sql = $this->db->prepare("SELECT * FROM clients WHERE name LIKE :name ORDER BY name ASC");
        $sql->bindValue(":name", '%'.$client_name.'%');
        $sql->execute();

        if($sql->rowCount() > 0) {
            $clients = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($clients AS $name) {
                $data .='<div class="search_res" id="'.$name['id'].'" onclick="select_client(this)">'.$name['name'].'</div>';
            }
        }

        return $data;
    }

    public function fetchSearchedClientData($id) {
        $data = '';

        $sql = $this->db->prepare("SELECT cidades.cidade AS city_name, clients.* FROM clients
                                    LEFT JOIN cidades ON (cidades.id = clients.city_id)
                                    WHERE clients.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $client_info = $sql->fetch(PDO::FETCH_ASSOC);

            $data .= '
            <tr>
                <td>'.$client_info['name'].'</td>
                <td>'.$client_info['address'].'</td>
                <td>'.$client_info['phone'].'</td>
                <td>'.$client_info['city_name'].'</td>
                <th>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Opções
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#" onclick="openEditModal('.$client_info['id'].')">Editar</a></li>
                            <li><a class="dropdown-item" href="#">Excluir</a></li>
                        </ul>
                    </div>
                </th>
            </tr>
            ';
        }

        return $data;
    }

    public function deleteClient($id) {
        $sql = $this->db->prepare("DELETE FROM clients WHERE id = :id");
        $sql->bindValue(":id", $id);
        if($sql->execute()) {
            return 'Cliente excluído com sucesso';
        } else {
            return 'Erro ao excluir o cliente. Entre em contato com o administrador do sistema';
        }

    }
}