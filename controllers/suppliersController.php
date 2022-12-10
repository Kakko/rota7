<?php

class suppliersController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();
        $users->setLoggedUser();
        $suppliers = new Suppliers();
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

            if($_POST['action'] == 'register' || $_POST['action'] == 'update') {

                $id = addslashes($_POST['id']);
                $name = addslashes($_POST['name']);
                $corporate_name = addslashes($_POST['corporate_name']);
                $cnpj = addslashes($_POST['cnpj']);
                $email = addslashes($_POST['email']);
                $address = addslashes($_POST['address']);
                $state_id = addslashes($_POST['state']);
                $city_id = addslashes($_POST['city']);
                $phone = addslashes($_POST['phone']);
                $obs = addslashes($_POST['obs']);

                if($_POST['action'] == 'register') {
                    $suppliers->register($name, $corporate_name, $cnpj, $email, $address, $state_id, $city_id, $phone, $obs);
                } else if($_POST['action'] == 'update') {
                    $suppliers->update($id, $name, $corporate_name, $cnpj, $email, $address, $state_id, $city_id, $phone, $obs);
                }
                header('Location: ' . BASE_URL . 'suppliers');
                exit;
            }

            if($_POST['action'] == 'edit_item') {

                $id = addslashes($_POST['id']);

                echo $suppliers->edit_supplier($id);
                exit;
            }
        }
        
        //UTILITIES
        if(!empty($_POST['utility_action']) && isset($_POST['utility_action'])) {
            //DELETE ITEM
            if($_POST['utility_action'] == 'delete_item') {
                $id = addslashes($_POST['id']);

                echo $suppliers->deleteBrand($id);
                exit;
            }
        }

        $data['suppliers'] = $suppliers->fetchSuppliers();
        $data['states'] = $util->fetchStates();
        $data['user_name'] = $users->getName();
        $this->loadTemplate('suppliers', $data);
    }

}