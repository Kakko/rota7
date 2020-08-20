<?php
class registerController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();
        $products = new Products();
        $users->setLoggedUser();

        if(!empty($_POST['reg_action'])){
            if($_POST['reg_action'] == 'addNewProdType'){
                $type = addslashes($_POST['type']);
                $reg_date = date("Y-m-d");

                echo $products->addNewProductType($type, $reg_date);
                exit;
            }

            if($_POST['reg_action'] == 'addNewProd'){

                $name = addslashes($_POST['product_name']);
                $type = addslashes($_POST['product_type']);
                $tax = addslashes($_POST['product_tax']);
                $value = addslashes($_POST['product_value']);
                $qtd = addslashes($_POST['product_qtd']);
                $reg_date = date("Y-m-d");

                if(!empty($_FILES)){
                    $url = $_FILES['product_image'];
                } else {
                    $url = '';
                }

                $products->addNewProduct($name, $type, $tax, $value, $qtd, $url, $reg_date);
                header("Location: ".BASE_URL."register");
            }
        }

        $data['products'] = $products->fetchProducts();
        $data['prod_type'] = $products->fetchProdType();
        $data['user_name'] = $users->getName();
        $this->loadTemplate('productRegister', $data);
    }
}