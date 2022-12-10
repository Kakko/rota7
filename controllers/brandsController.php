<?php

class brandsController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();
        $users->setLoggedUser();

        $brand = new Brands();

        //VERIFY IF THE USER IS LOGGED, IF NOT, REDIRECT TO LOGIN PAGE
        if($users->isLogged() == false){
            header("Location:".BASE_URL."login");
        }

        if(!empty($_POST['action']) && isset($_POST['action'])) {
            if($_POST['action'] == 'add') {
                $name = addslashes($_POST['name']);
                
                echo $brand->addNewBrand($name);

                header("Location: " . BASE_URL . "brands");
                exit;
            }
        }
        //UTILITIES
        if(!empty($_POST['utility_action']) && isset($_POST['utility_action'])) {
            //DELETE ITEM
            if($_POST['utility_action'] == 'delete_item') {
                $id = addslashes($_POST['id']);

                echo $brand->deleteBrand($id);
                exit;
            }
        }

        $data['brands'] = $brand->fetchBrands();
        $data['user_name'] = $users->getName();
        $this->loadTemplate('brands', $data);
    }

}