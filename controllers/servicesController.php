<?php

class servicesController extends Controller {
    
    public function index() {

    }

    public function add_service() {
        $data = array();
        $clients = new Clients();
        $services = new Services();
        $utils = new Utils();
        $bicicles = new Bicicles();

        if(!empty($_POST) && isset($_POST)) {

            if($_POST['action'] == 'fetchCities') {
                $id = addslashes($_POST['id']);

                echo $utils->fetchCities($id);
                exit;
            }
            
            if($_POST['action'] == 'search_client_bike') {
                $id = addslashes($_POST['id']);

                echo $services->search_client_bike($id);
                exit;
            }

            if($_POST['action'] == 'addClient') {
                $name = addslashes($_POST['name']);
                $address = addslashes($_POST['address']);
                $cpf = addslashes($_POST['cpf']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $state_id = addslashes($_POST['state_id']);
                $city_id = addslashes($_POST['city_id']);

                echo $clients->addClient($name, $address, $cpf, $email, $phone, $state_id, $city_id);
                exit;
            }

            if($_POST['action'] == 'addBike') {

                $client_id = addslashes($_POST['client_id']);
                $brand = addslashes($_POST['brand']);
                $model = addslashes($_POST['model']);
                $hoop = addslashes($_POST['hoop']);
                $color = addslashes($_POST['color']);
                $serial = addslashes($_POST['serial']);
                $basket = addslashes($_POST['basket']);
                $garupa = addslashes($_POST['garupa']);
                $garupa_almofada = addslashes($_POST['garupa_almofada']);
                $pedana = addslashes($_POST['pedana']);
                $bike_obs = addslashes($_POST['bike_obs']);

                echo $bicicles->addBike($client_id, $brand, $model, $hoop, $color, $serial, $basket, $garupa, $garupa_almofada, $pedana, $bike_obs);
                exit;
            }

            if($_POST['action'] == 'save_service') {
                $client_id = addslashes($_POST['client_id']);
                $bicicle_id = addslashes($_POST['bicicle_id']);
                $income_date = addslashes($_POST['income_date']);
                $income_hour = addslashes($_POST['income_hour']);
                $deliver_date = addslashes($_POST['deliver_date']);
                $deliver_hour = addslashes($_POST['deliver_hour']);
                $localizacao = addslashes($_POST['localizacao']);
                $status = addslashes($_POST['status']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $service_obs = addslashes($_POST['service_obs']);
                $valor = addslashes($_POST['valor']);
                $valor = str_replace(',','.', $valor);
                $paid = addslashes($_POST['paid']);
                
                echo $services->addService($client_id, $bicicle_id, $income_date, $income_hour, $deliver_date, $deliver_hour, $localizacao, $status, $internal_obs, $service_obs, $valor, $paid);
                exit;
            }
        }


        $data['clients'] = $clients;
        $data['states'] = $utils->fetchStates();
        $this->loadTemplate('services/add_service', $data);
    }

    public function search_services() {
        $data = array();
        $services = new Services();
        $clients = new Clients();

        if(!empty($_POST) && isset($_POST)) {
            
            if($_POST['action'] == 'search_service') {
                $client_id = addslashes($_POST['client']);
                $status = addslashes($_POST['status']);
                $income_date = addslashes($_POST['income_date']);
                $deliver_date = addslashes($_POST['deliver_date']);

                echo $services->fetchServices($client_id, $status, $income_date, $deliver_date);
                exit;
            }

            if($_POST['action'] == 'upd_service') { //FORMATAR AS DATAS
                $id = addslashes($_POST['id']);
                $client_id = addslashes($_POST['client_id']);
                $bicicle_id = addslashes($_POST['bicicle_id']);
                $income_date = addslashes($_POST['income_date']);
                $income_hour = addslashes($_POST['income_hour']);
                $deliver_date = addslashes($_POST['deliver_date']);
                $deliver_hour = addslashes($_POST['deliver_hour']);
                $localizacao = addslashes($_POST['localizacao']);
                $status = addslashes($_POST['status']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $service_obs = addslashes($_POST['service_obs']);
                $valor = addslashes($_POST['valor']);
                $valor = str_replace(',','.', $valor);
                $paid = addslashes($_POST['paid']);
                
                echo $services->updService($id, $client_id, $bicicle_id, $income_date, $income_hour, $deliver_date, $deliver_hour, $localizacao, $status, $internal_obs, $service_obs, $valor, $paid);
                exit;
            }

            if($_POST['action'] == 'upd_payment') {
                $id = addslashes($_POST['id']);
                echo $services->upd_payment($id);
                exit;
            }

            if($_POST['action'] == 'upd_client_payment') {
                $id = addslashes($_POST['id']);
                $paid_value = number_format(addslashes($_POST['paid_value']),2,'.',',');
                $original_value = number_format(addslashes($_POST['original_value']),2,'.',',');
                echo $services->set_payment($id, $paid_value, $original_value);
                exit;
            }

            if($_POST['action'] == 'edit_service') {
                $id = addslashes($_POST['id']);
                echo $services->editService($id);
                exit;
            }

            if($_POST['action'] == 'delete_service') {
                $id = addslashes($_POST['id']);
                echo $services->delete_service($id);
                exit;
            }

            if($_POST['action'] == 'finish_service') {
                $id = addslashes($_POST['id']);
                echo $services->finish_service($id);
                exit;
            }
        }

        $data['clients'] = $clients;
        $this->loadTemplate('services/search_services', $data);
    }
}