<?php
class brandsController extends Controller {

    public function index() {

    }

    public function add_brand() {
        $data = array();
        $login = new Login();
        $brands = new Brands();
        $utils = new Utils();
        
        if($login->isLogged() == false) {
            header("Location:".BASE_URL."login");
        }

        if(!empty($_POST) && isset($_POST)) {
            if($_POST['action'] == 'add') {
                $name = addslashes($_POST['brand_name']);

                $brands->add_brand($name);
                header('Location: ' . BASE_URL . 'brands/search_brands');
                exit;
            }

            if($_POST['action'] == 'verifyBrand') {
                $name = addslashes($_POST['name']);

                echo $utils->verifyBrand($name);
                exit;
            }
        }
        
        
        $this->loadTemplate('brands/add_brand', $data);
    }

    public function search_brands() {
        $data = array();
        $brands = new Brands();
        $login = new Login();

        if($login->isLogged() == false) {
            header("Location:".BASE_URL."login");
        }

        if(!empty($_POST) && isset($_POST)) {
            if($_POST['action'] == 'delete') {
                $id = addslashes($_POST['id']);
                echo $brands->delete_brand($id);
                exit;
            }
        }

        $data['brands'] = $brands->fetchBrands();
        $this->loadTemplate('brands/search_brands', $data);
    }
}