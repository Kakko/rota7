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
            if($_POST['product_action'] == 'addProduct' || $_POST['product_action'] == 'editProduct') {
                
                $_POST['product_action'] == 'editProduct' ? $id = addslashes($_POST['product_id']) : '' ;
                $name = addslashes($_POST['product_name']);
                $supplier_id = addslashes($_POST['product_supplier']);
                $category_id = addslashes($_POST['product_category']);
                $buy_date = addslashes($_POST['buy_date']);
                $brand_id = addslashes($_POST['brand']);
                $ean = addslashes($_POST['product_ean']);
                $color = addslashes($_POST['product_color']);
                $qtd = addslashes($_POST['product_qtd']);
                $buy_cost = addslashes($_POST['product_bprice']);
                $buy_cost = str_replace(',','.', $buy_cost);

                $sale_cost = addslashes($_POST['product_sprice']);
                $sale_cost = str_replace(',','.', $sale_cost);

                $obs = addslashes($_POST['obs']);
                
                if(!empty($_FILES['product_img']['name'][0])) {
                    $url = $_FILES['product_img'];
                } else {
                    $url = '';
                }

                try {
                    $this->db->beginTransaction();

                    if ($_POST['product_action'] == 'addProduct') {
                        $product->addNewProd($name, $supplier_id, $category_id, $buy_date, $brand_id, $ean, $color, $qtd, $buy_cost, $sale_cost, $obs, $url);
                    } elseif ($_POST['product_action'] == 'editProduct') {
                        $product->editProd($id, $name, $supplier_id, $category_id, $buy_date, $brand_id, $ean, $color, $qtd, $buy_cost, $sale_cost, $obs, $url);
                    }

                    $this->db->commit();
                } catch (Exception $e) {
                    $this->db->rollback();
                }


                // $product->addNewProd($name, $supplier_id, $category_id, $brand_id, $ean, $color, $qtd, $buy_cost, $sale_cost, $obs, $url);
                header("Location: ".BASE_URL."products");
            }

            if($_POST['product_action'] == 'search_item') {
                $name = addslashes($_POST['name']);

                echo $product->searchItem($name);
                exit;
            }

            if($_POST['product_action'] == 'edit_item') {
                $id = addslashes($_POST['id']);

                echo $product->edit_product($id);
                exit;
            }

            if($_POST['product_action'] == 'delete_product_image') {
                $id = addslashes($_POST['id']);

                echo $product->delete_product_image($id);
                exit;
            }
        }

        //UTILITIES
        if(!empty($_POST['utility_action']) && isset($_POST['utility_action'])) {
            
            //DELETE ITEM
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