<?php
class suppliersController extends Controller {

    public function index() {
        
    }

    public function add_supplier() {
        $data = array();
        $login = new Login();
        $utils = new Utils();
        $suppliers = new Suppliers();

        if($login->isLogged() == false) {
            header("Location:".BASE_URL."login");
        }

        if(!empty($_POST) && isset($_POST)) {
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
                header('Location: ' . BASE_URL . 'suppliers/add_supplier');
                exit;
            }


            if($_POST['action'] == 'fetchCities') {
                $id = addslashes($_POST['id']);
    
                echo $utils->fetchCities($id);
                exit;
            }
        }

        $data['states'] = $utils->fetchStates();
        $this->loadTemplate('suppliers/add_supplier', $data);
    }

    public function search_suppliers() {
        $data = array();
        $suppliers = new Suppliers();
        $login = new Login();
        
        if($login->isLogged() == false) {
            header("Location:".BASE_URL."login");
        }

        if(!empty($_POST) && isset($_POST)) {

            if($_POST['action'] == 'update') {
                
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

                $suppliers->update($id, $name, $corporate_name, $cnpj, $email, $address, $state_id, $city_id, $phone, $obs);
                header('Location: ' . BASE_URL . 'suppliers/search_suppliers');
                exit;
            }

            if($_POST['action'] == 'editSupplier') {
                $id = addslashes($_POST['id']);

                echo $suppliers->edit_supplier($id);
                exit;
            }
        }

        $data['suppliers'] = $suppliers->fetchSuppliers();
        $this->loadTemplate('suppliers/search_suppliers', $data);
    }
}