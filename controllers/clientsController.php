<?php

class clientsController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();
        $users->setLoggedUser();
        $client = new Clients();
        $util = new Utils();

        //VERIFY IF THE USER IS LOGGED, IF NOT, REDIRECT TO LOGIN PAGE
        if($users->isLogged() == false){
            header("Location:".BASE_URL."login");
        }
        
        if(!empty($_POST['action']) && isset($_POST['action'])) {
            if($_POST['action'] == 'fetchCities') {
                $id = addslashes($_POST['id']);

                echo $util->fetchCities($id);
                exit;
            }

            if($_POST['action'] == 'add') {
                $name = addslashes($_POST['name']);
                $address = addslashes($_POST['address']);
                $cpf = addslashes($_POST['cpf']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $state_id = addslashes($_POST['state']);
                $city_id = addslashes($_POST['city']);

                $client->addClient($name, $address, $cpf, $email, $phone, $state_id, $city_id);
                header('Location: ' . BASE_URL . 'clients');
                exit;
            }
        }

        $data['clients'] = $client->fetchClients();
        $data['states'] = $util->fetchStates();
        $data['user_name'] = $users->getName();
        $this->loadTemplate('clients', $data);
    }

}