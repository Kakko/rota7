<?php

class clientsController extends Controller {

    public function index() {

    }

    public function add_clients() {
        $data = array();
        $login = new Login();
        $utils = new Utils();
        $clients = new Clients();
        $bicicles = new Bicicles();

        if($login->isLogged() == false) {
            header("Location:".BASE_URL."login");
        }
        
        if(!empty($_POST['action']) && isset($_POST['action'])) {
            if($_POST['action'] == 'addClient') {
                $name = addslashes($_POST['name']);
                $address = addslashes($_POST['address']);
                $cpf = addslashes($_POST['cpf']);
                $birth_date = addslashes($_POST['birth_date']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $phone2 = addslashes($_POST['phone2']);
                $state_id = addslashes($_POST['state_id']);
                $city_id = addslashes($_POST['city_id']);
                $brand = addslashes($_POST['brand']);
                $model = addslashes($_POST['model']);
                $hoop = addslashes($_POST['hoop']);
                $color = addslashes($_POST['color']);
                $serial_number = addslashes($_POST['serial']);
                $basket = addslashes($_POST['basket']);
                $garupa = addslashes($_POST['garupa']);
                $garupa_almofada = addslashes($_POST['garupa_almofada']);
                $pedana = addslashes($_POST['pedana']);
                $obs = addslashes($_POST['obs']);

                echo $clients->addClient($name, $address, $cpf, $birth_date, $email, $phone, $phone2, $state_id, $city_id, $brand, $model, $hoop, $color, $serial_number, $basket, $garupa, $garupa_almofada, $pedana, $obs);
                exit;
            }

            if($_POST['action'] == 'fetchCities') {
                $id = addslashes($_POST['id']);

                echo $utils->fetchCities($id);
                exit;
            }
        }

        $data['states'] = $utils->fetchStates();
        $this->loadTemplate('clients/add_clients', $data);
    }

    public function search_clients() {
        $data = array();
        $clients = new Clients();
        $utils = new Utils();

        if(!empty($_POST['action']) && isset($_POST['action'])){
            if($_POST['action'] == 'editClient') {
                $id = addslashes($_POST['id']);
    
                echo $clients->fetchClient($id);
                exit;
            }

            if($_POST['action'] == 'updClient') {

                $id = addslashes($_POST['id']);
                $name = addslashes($_POST['name']);
                $address = addslashes($_POST['address']);
                $cpf = addslashes($_POST['cpf']);
                $birth_date = addslashes($_POST['birth_date']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $phone2 = addslashes($_POST['phone2']);
                $state_id = addslashes($_POST['state_id']);
                $city_id = addslashes($_POST['city_id']);
                $b_id = addslashes($_POST['b_id']);
                $brand = addslashes($_POST['brand']);
                $model = addslashes($_POST['model']);
                $hoop = addslashes($_POST['hoop']);
                $color = addslashes($_POST['color']);
                $serial_number = addslashes($_POST['serial']);
                $basket = addslashes($_POST['basket']);
                $garupa = addslashes($_POST['garupa']);
                $garupa_almofada = addslashes($_POST['garupa_almofada']);
                $pedana = addslashes($_POST['pedana']);
                $obs = addslashes($_POST['obs']);

                echo $clients->updClient($id, $name, $address, $cpf, $birth_date, $email, $phone, $phone2, $state_id, $city_id, $b_id, $brand, $model, $hoop, $color, $serial_number, $basket, $garupa, $garupa_almofada, $pedana, $obs);
                exit;
            }

            if($_POST['action'] == 'fetchCities') {
                $id = addslashes($_POST['id']);

                echo $utils->fetchCities($id);
                exit;
            }
        }
        

        $data['clients'] = $clients->fetchClients();
        $this->loadTemplate('clients/search_clients', $data);
    }
}