<?php

class Services extends Model {
    
    public function search_client_bike($id) {
        $data = '';

        $sql = $this->db->prepare("SELECT * FROM bicicles WHERE client_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $bicicles = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($bicicles as $bike) {
                if(empty($bike['brand'])){
                    $bike_data = $bike['model'];
                } else if(empty($bike['model'])) {
                    $bike_data = $bike['brand'];
                } else if(!empty($bike['model'] && !empty($bike['brand']))){
                    $bike_data = $bike['brand'].' - '.$bike['model'];
                }
                $data .= '
                    <option value="'.$bike['id'].'">'.$bike_data.'</option>
                ';
            }
        } else {
            $data = '<option value="">Sem Bicicleta Cadastrada</option>';
        }

        return $data;
    }

    public function addService($client_id, $bicicle_id, $income_date, $income_hour, $deliver_date, $deliver_hour, $localizacao, $status, $internal_obs, $service_obs, $valor, $paid) {
        $sql = $this->db->prepare("INSERT INTO services SET client_id = :client_id, bicicle_id = :bicicle_id, income_date = :income_date, income_hour = :income_hour, deliver_date = :deliver_date, deliver_hour = :deliver_hour, localizacao = :localizacao, status = :status, internal_obs = :internal_obs, service_obs = :service_obs, valor = :valor, paid = :paid, reg_date = NOW()");
        $sql->bindValue(":client_id", $client_id);
        $sql->bindValue(":bicicle_id", $bicicle_id);
        $sql->bindValue(":income_date", $income_date);
        $sql->bindValue(":income_hour", $income_hour);
        $sql->bindValue(":deliver_date", $deliver_date);
        $sql->bindValue(":deliver_hour", $deliver_hour);
        $sql->bindValue(":localizacao", $localizacao);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":internal_obs", $internal_obs);
        $sql->bindValue(":service_obs", $service_obs);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":paid", $paid);
        if($sql->execute()) {
            return 'Serviço Cadastrado com Sucesso';
        } else {
            return false;
        }
    }

    public function fetchServices($client_id, $status, $income_date, $deliver_date) {
        $data = '';

        $client_query = '';
        $status_query = '';
        $income_query = '';
        $deliver_query = '';
        $between_query = '';

        !empty($client_id) ? $client_query = "AND services.client_id = :client_id" : '';
        !empty($status) ? $status_query = "AND status = :status" : '';
        !empty($income_date) ? $income_query = "AND income_date = :income_date" : '';
        !empty($deliver_date) ? $deliver_query = "AND deliver_date = :deliver_date" : '';

        if(!empty($income_date) && !empty($deliver_date)) {
            $income_query = '';
            $deliver_query = '';
            $between_query = 'AND income_date BETWEEN :income_date AND :deliver_date AND deliver_date BETWEEN :income_date AND :deliver_date';
        }

        $sql = $this->db->prepare("SELECT clients.name AS client_name, 
                                            bicicles.brand AS bicicle, 
                                            services.id AS id,
                                            services.localizacao AS location, 
                                            services.valor AS value, 
                                            services.paid AS paid ,
                                            services.deliver_date AS deliver_date,
                                            services.status AS status,
                                            services.paid_value AS paid_value
                                            FROM services 
                                            LEFT JOIN clients ON (clients.id = services.client_id)
                                            LEFT JOIN bicicles ON (bicicles.id = services.bicicle_id)
                                            WHERE services.client_id IS NOT NULL $client_query $status_query $income_query $deliver_query $between_query ORDER BY deliver_date DESC");
        !empty($client_id) ? $sql->bindValue(":client_id", $client_id) : '';
        !empty($status) ? $sql->bindValue(":status", $status) : '';
        !empty($income_date) ? $sql->bindValue(":income_date", $income_date) : '';
        !empty($deliver_date) ? $sql->bindValue(":deliver_date", $deliver_date) : '';
        $sql->execute();

        if($sql->rowCount() > 0) {
            $services = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($services AS $service) {
                $date = date_create($service['deliver_date']);
                $service['status'] == 'Entregue' ? $data .='<tr id="'.$service['id'].'" style="background-color: #caffc2">' : $data .='<tr id="'.$service['id'].'">';
                $data .='
                        <td>'.$service['client_name'].'</td>
                        <td>'.$service['bicicle'].'</td>
                        <td>'.$service['location'].'</td>
                        <td>'.date_format($date, "d/m/Y").'</td>
                        <td>'.$service['status'].'</td>';
                        if($service['paid_value'] === $service['value'] && $service['paid'] == 'S') {
                            $data .='<td style="color: green; font-weight: bold">R$ '.number_format($service['value'],2,',','.').'</td>';
                        } else if($service['paid_value'] !== $service['value'] && $service['paid'] == 'S') {
                            $data .='<td style="color: #ff7024; font-weight: bold" title="ATENÇÃO - VALOR PAGO DIFERENTE DO TOTAL">R$ '.number_format($service['value'],2,',','.').'*</td>';
                        } else if($service['paid'] == 'N') {
                            $data .='<td style="color: red; font-weight: bold">R$ '.number_format($service['value'],2,',','.').'</td>';
                        }
                        $data .='
                        <td>
                            <button class="btn btn-outline-success" onclick="updPayment('.$service['id'].')"><i class="fa-regular fa-money-bill"></i></button>
                            <button class="btn btn-outline-warning" onclick="openEditModal('.$service['id'].')"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="btn btn-outline-danger" onclick="deleteService('.$service['id'].')"><i class="fa-regular fa-trash"></i></button>';
                            if($service['status'] !== 'Entregue') {
                                $data .='<button class="btn btn-outline-primary" onclick="finishService('.$service['id'].')" style="margin-left: 4px"><i class="fa-solid fa-check"></i></button>';
                            } else {
                                $data .='<button class="btn btn-outline-secondary" onclick="openService('.$service['id'].')" style="margin-left: 4px"><i class="fa-solid fa-check"></i></button>';
                            }
                            $data .='
                            
                        </td>
                    </tr>
                ';
            }
        }
        return $data;
    }

    public function upd_payment($id) {
        $data = '';

        $sql = $this->db->prepare("SELECT id, valor, paid FROM services WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $paid_info = $sql->fetch(PDO::FETCH_ASSOC);

            $data .='
                <div class="row">
                    <div class="col-sm">
                        <label>Atualizar Pagamento:</label>
                        <input type="text" class="form-control form-control-sm money" name="paid_value" value="'.number_format($paid_info['valor'],2,',','.').'">
                        <input type="text" name="original_value" value="'.$paid_info['valor'].'" hidden>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-sm">
                        <button class="btn btn-success w-100" onclick="upd_payment('.$paid_info['id'].')">Atualizar Pagamento</button>
                    </div>
                </div>
            ';
        }

        return $data;
    }

    public function set_payment($id, $paid_value, $original_value) {

        $sql = $this->db->prepare("UPDATE services SET paid_value = :paid_value, valor = :original_value, paid = 'S', user_id = :user_id WHERE id = :id");
        $sql->bindValue(":paid_value", $paid_value);
        $sql->bindValue(":original_value", $original_value);
        $sql->bindValue(":user_id", $_SESSION['lgUser']);
        $sql->bindValue(":id", $id);
        if($sql->execute()){
            return true;
        };
    }

    public function editService($id) {
        $data = '';

        $sql = $this->db->prepare("SELECT clients.name AS client_name, 
                                            bicicles.model AS bicicle_model,
                                            bicicles.brand AS bicicle_brand,
                                            services.* 
                                    FROM services 
                                    INNER JOIN clients ON (clients.id = services.client_id)
                                    INNER JOIN bicicles ON (bicicles.id = services.bicicle_id)
                                    WHERE services.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $service = $sql->fetch(PDO::FETCH_ASSOC);

            $data .='
                <div class="row">
                    <div class="col-sm">
                        <label>Nome do Cliente</label>
                        <input type="text" class="form-control form-control-sm" value="'.$service['client_name'].'" readonly>
                        <input type="text" name="client_id" value="'.$service['client_id'].'" hidden>
                    </div>
                    <div class="col-sm">
                        <label>Marca da Bicicleta</label>
                        <input type="text" name="bicicle_id" value="'.$service['bicicle_id'].'" hidden>
                        <input type="text" class="form-control form-control-sm" name="bicicle_brand" value="'.$service['bicicle_brand'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Modelo da Bicicleta</label>
                        <input type="text" class="form-control form-control-sm" name="bicicle_model" value="'.$service['bicicle_model'].'" readonly>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm">
                        <label>Data de Entrada:</label>
                        <input type="date" class="form-control form-control-sm" name="income_date" value="'.$service['income_date'].'">
                    </div>
                    <div class="col-sm">
                        <label>Hora de Entrada:</label>
                        <input type="hour" class="form-control" name="income_hour" value="'.$service['income_hour'].'">
                    </div>
                    <div class="col-sm">
                        <label>Previsão de Entrega:</label>
                        <input type="date" class="form-control form-control-sm" name="deliver_date" value="'.$service['deliver_date'].'">
                    </div>
                    <div class="col-sm">
                        <label>Hora:</label>
                        <input type="hour" class="form-control" name="deliver_hour" value="'.$service['deliver_hour'].'">
                    </div>
                    <div class="col-sm">
                        <label>Localização:</label>
                        <select class="form-select" name="localizacao">
                            <option>'.$service['localizacao'].'</option>
                            <option value=""> ---------------- </option>
                            <option>Oficina</option>
                            <option>Depósito</option>
                            <option>Loja</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <label>Status do Serviço:</label>
                        <select class="form-select" name="status">
                            <option>'.$service['status'].'</option>
                            <option value=""> ---------------- </option>
                            <option>Aguardando Mecânico</option>
                            <option>Aguardando Peça</option>
                            <option>Aguardando Retirada</option>
                            <option>Entregue</option>
                            <option>Cancelado</option>
                            <option>Abandonado</option>
                            <option>Outros</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label>Observações Internas</label>
                        <textarea class="form-control" name="internal_obs" style="resize: none">'.$service['internal_obs'].'</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label>Observações para o cliente</label>
                        <textarea class="form-control" name="service_obs" style="resize: none">'.$service['service_obs'].'</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label>Total:</label>';
                        if($service['paid'] == 'N') {
                            $data .='<input type="text" class="form-control form-control-sm money" name="valor" value="'.number_format($service['valor'],2,',', '.').'" style="color: red; font-weight: bold">';
                        } else if($service['paid_value'] !== $service['valor']){
                            $data .='<input type="text" class="form-control form-control-sm money" name="valor" value="'.number_format($service['valor'],2,',', '.').'" style="color: #ff7024; font-weight: bold">';
                        } else {
                            $data .='<input type="text" class="form-control form-control-sm money" name="valor" value="'.number_format($service['valor'],2,',', '.').'" style="color: green; font-weight: bold" readonly>';
                        }

                        $data .='
                    </div>
                    <div class="col-sm-2">
                        <label>Pago?</label></br>';
                        if($service['paid'] == 'S') {
                            $data .='<input type="checkbox" class="form-check-input" name="paid" value="S" checked>';
                        } else {
                            $data .='<input type="checkbox" class="form-check-input" name="paid" value="N">';
                        }
                        $data .='
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-sm">
                        <button class="btn btn-sm btn-success w-100" onclick="updService('.$service['id'].')">Salvar</button>
                    </div>
                </div>
            ';
        }

        return $data;
    }

    public function updService($id, $client_id, $bicicle_id, $income_date, $income_hour, $deliver_date, $deliver_hour, $localizacao, $status, $internal_obs, $service_obs, $valor, $paid) {
        $sql = $this->db->prepare("UPDATE services SET client_id = :client_id, bicicle_id = :bicicle_id, income_date = :income_date, income_hour = :income_hour, deliver_date = :deliver_date, deliver_hour = :deliver_hour, localizacao = :localizacao, status = :status, internal_obs = :internal_obs, service_obs = :service_obs, valor = :valor, paid = :paid WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":client_id", $client_id);
        $sql->bindValue(":bicicle_id", $bicicle_id);
        $sql->bindValue(":income_date", $income_date);
        $sql->bindValue(":income_hour", $income_hour);
        $sql->bindValue(":deliver_date", $deliver_date);
        $sql->bindValue(":deliver_hour", $deliver_hour);
        $sql->bindValue(":localizacao", $localizacao);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":internal_obs", $internal_obs);
        $sql->bindValue(":service_obs", $service_obs);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":paid", $paid);
        if($sql->execute()) {
            return 'Serviço Atualizado com Sucesso';
        } else {
            return false;
        }
    }

    public function delete_service($id) {

        $sql = $this->db->prepare("SELECT paid FROM services WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $paid = $sql->fetch(PDO::FETCH_ASSOC)['paid'];
        }

        if($paid !== 'S') {
            $sql = $this->db->prepare("DELETE FROM services WHERE id = :id");
            $sql->bindValue(":id", $id);
            if($sql->execute()){
                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }

    public function finish_service($id) {
        $sql = $this->db->prepare("UPDATE services SET status = 'Entregue' WHERE id = :id");
        $sql->bindValue(":id", $id);
        if($sql->execute()){
            return true;
        };
    }
}