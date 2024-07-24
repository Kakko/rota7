<?php

class clientsController extends Controller {

    public function index() {

    }

    public function add_clients() {
        $data = array();
        $login = new Login();
        $utils = new Utils();
        $clients = new Clients();

        if($login->isLogged() == false) {
            header("Location:".BASE_URL."login");
        }
        
        if(!empty($_POST['action']) && isset($_POST['action'])) {
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
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $state_id = addslashes($_POST['state_id']);
                $city_id = addslashes($_POST['city_id']);

                echo $clients->updClient($id, $name, $address, $cpf, $email, $phone, $state_id, $city_id);
                exit;
            }

            if($_POST['action'] == 'fetchCities') {
                $id = addslashes($_POST['id']);

                echo $utils->fetchCities($id);
                exit;
            }

            if($_POST['action'] == 'search_client_name') {
                $client_name = addslashes($_POST['client_name']);

                echo $clients->search_client_name($client_name);
                exit;
            }

            if($_POST['action'] == 'fetchSearchedClientData') {
                $id = addslashes($_POST['id']);

                echo $clients->fetchSearchedClientData($id);
                exit;
            }

            if($_POST['action'] == 'deleteClient') {
                $id = addslashes($_POST['id']);

                echo $clients->deleteClient($id);
                exit;
            }


        }
        

        $data['clients'] = $clients->fetchClients();
        $this->loadTemplate('clients/search_clients', $data);
    }
}