<?php
class productsController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();
        $users->setLoggedUser();

        $supply = new Suppliers();
        $brand = new Brands();
        $category = new Categories();
        $product = new Products();

        //VERIFY IF THE USER IS LOGGED, IF NOT, REDIRECT TO LOGIN PAGE
        if($users->isLogged() == false){
            header("Location:".BASE_URL."login");
        }

        if(!empty($_POST['product_action']) && isset($_POST['product_action'])) {
            if($_POST['product_action'] == 'addProduct') {
                $name = addslashes($_POST['product_name']);
                $supplier_id = addslashes($_POST['product_supplier']);
                $category_id = addslashes($_POST['product_category']);
                $brand_id = addslashes($_POST['brand']);
                $ean = addslashes($_POST['product_ean']);
                $color = addslashes($_POST['product_color']);
                $qtd = addslashes($_POST['product_qtd']);
                $buy_cost = addslashes($_POST['product_bprice']);
                $buy_cost = str_replace(',','.', $buy_cost);

                $sale_cost = addslashes($_POST['product_sprice']);
                $sale_cost = str_replace(',','.', $sale_cost);

                $obs = addslashes($_POST['obs']);
                
                if(!empty($_FILES)) {
                    $url = $_FILES['product_img'];
                } else {
                    $url = '';
                }


                $product->addNewProd($name, $supplier_id, $category_id, $brand_id, $ean, $color, $qtd, $buy_cost, $sale_cost, $obs, $url);
                header("Location: ".BASE_URL."products");
            }
        }

        if(!empty($_POST['utility_action']) && isset($_POST['utility_action'])) {
            if($_POST['utility_action'] == 'delete_item') {
                $id = addslashes($_POST['id']);

                echo $product->deleteProduct($id);
                exit;
            }
        }
        
        $data['products'] = $product->fetchAllProducts();
        $data['suppliers'] = $supply->fetchSuppliers();
        $data['brands'] = $brand->fetchBrands();
        $data['categories'] = $category->fetchCategories();
        $data['user_name'] = $users->getName();
        $this->loadTemplate('products', $data);
    }

}