<?php
class pdvController extends Controller {

    public function index() {

    }

    public function new_sale() {
        $data = array();
        $users = new Users();
        $pdv = new Pdv();

        if(!empty($_POST) && isset($_POST)) {
            if($_POST['pdv_action'] == 'fetch_pdv_products') {
                $name = addslashes($_POST['name']);

                echo $pdv->fetch_pdv_products($name);
                exit;
            }
            if($_POST['pdv_action'] == 'fetch_pdv_products') {
                $name = addslashes($_POST['name']);

                echo $pdv->fetch_pdv_products($name);
                exit;
            }
            if($_POST['pdv_action'] == 'fetch_pdv_product_info') {
                $id = addslashes($_POST['id']);

                echo $pdv->fetch_pdv_product_info($id);
                exit;
            }
            if($_POST['pdv_action'] == 'fetch_pdv_product_img') {
                $id = addslashes($_POST['id']);

                echo $pdv->fetch_pdv_product_img($id);
                exit;
            }
        }

        $data['user_data'] = $users->fetchUserData();
        $this->loadTemplate('pdv/new_sale', $data);
    }
}