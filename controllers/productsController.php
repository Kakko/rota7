<?php
class productsController extends Controller {

    public function index() {
        
    }

    public function add_products() {
        $data = array();
        $supplier = new Suppliers();
        $product = new Products();
        $category = new Categories();
        $brands = new Brands();
        $util = new Utils();

        if(!empty($_POST) && isset($_POST)) {

            if($_POST['product_action'] == 'addProduct' || $_POST['product_action'] == 'editProduct') {
                
                $_POST['product_action'] == 'editProduct' ? $id = addslashes($_POST['product_id']) : '' ;
                $name = addslashes($_POST['product_name']);
                $supplier_id = addslashes($_POST['product_supplier']);
                $category_id = addslashes($_POST['product_category']);
                $buy_date = addslashes($_POST['buy_date']);
                $brand_id = addslashes($_POST['brand']);
                $cod = addslashes($_POST['product_cod']);
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
                        $product->addNewProd($name, $supplier_id, $category_id, $buy_date, $brand_id, $cod, $color, $qtd, $buy_cost, $sale_cost, $obs, $url);
                    } elseif ($_POST['product_action'] == 'editProduct') {
                        $product->editProd($id, $name, $supplier_id, $category_id, $buy_date, $brand_id, $cod, $color, $qtd, $buy_cost, $sale_cost, $obs, $url);
                    }

                    $this->db->commit();
                } catch (Exception $e) {
                    $this->db->rollback();
                }

                header("Location: ".BASE_URL."products/add_products");
                exit;
            }

            if($_POST['action'] == 'verify_product') {
                $product_code = addslashes($_POST['product_code']);
                $supplier_id = addslashes($_POST['supplier_id']);

                echo $product->verify_product($product_code, $supplier_id);
                exit;
            }

            if($_POST['action'] == 'fetchCities') {
                $id = addslashes($_POST['id']);

                echo $util->fetchCities($id);
                exit;
            }
            
            //CADASTRAR FORNECEDORES
            if($_POST['action'] == 'addSupplier') {
                $name = addslashes($_POST['name']);
                $corporate_name = addslashes($_POST['corporate_name']);
                $cnpj = addslashes($_POST['cnpj']);
                $email = addslashes($_POST['email']);
                $address = addslashes($_POST['address']);
                $state_id = addslashes($_POST['state_id']);
                $city_id = addslashes($_POST['city_id']);
                $phone = addslashes($_POST['phone']);
                $obs = addslashes($_POST['obs']);
                
                echo $supplier->register($name, $corporate_name, $cnpj, $email, $address, $state_id, $city_id, $phone, $obs);
                exit;
            }
            
            if($_POST['action'] == 'reloadSupplier') {

                echo $supplier->reloadSupplier();
                exit;
            }

            //CADASTRAR CATEGORIAS
            if($_POST['action'] == 'addCategory') {
                $name = addslashes($_POST['name']);

                echo $category->addCategory($name);
                exit;
            }

            if($_POST['action'] == 'reloadCategory') {

                echo $category->reloadCategory();
                exit;
            }

            //CADASTRAR MARCAS
            if($_POST['action'] == 'addBrands') {
                $name = addslashes($_POST['name']);

                echo $brands->add_brand($name);
                exit;
            }

            if($_POST['action'] == 'reloadBrands') {

                echo $brands->reloadBrands();
                exit;
            }
        }

        $data['states'] = $util->fetchStates();
        $data['suppliers'] = $supplier->fetchSuppliers();
        $data['categories'] = $category->fetchCategories();
        $data['brands'] = $brands->fetchBrands();
        $this->loadTemplate('products/add_products', $data);
    }

    public function search_products() {
        $data = array();
        $product = new Products();
        
        if(!empty($_GET['page'])) {
            print_r($_GET);
            exit;
        }

        if(!empty($_POST['action']) && isset($_POST['action'])){
            if($_POST['action'] == 'edit_item') {
                $id = addslashes($_POST['id']);

                echo $product->edit_product($id);
                exit;
            }

            if($_POST['action'] == 'editProduct') {
                
                $id = addslashes($_POST['product_id']);
                $name = addslashes($_POST['product_name']);
                $supplier_id = addslashes($_POST['product_supplier']);
                $category_id = addslashes($_POST['product_category']);
                $buy_date = addslashes($_POST['buy_date']);
                $brand_id = addslashes($_POST['brand']);
                $cod = addslashes($_POST['product_cod']);
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

                    $product->editProd($id, $name, $supplier_id, $category_id, $buy_date, $brand_id, $cod, $color, $qtd, $buy_cost, $sale_cost, $obs, $url);

                    $this->db->commit();
                } catch (Exception $e) {
                    $this->db->rollback();
                }

                header("Location: ".BASE_URL."products/search_products");
                exit;
            }

            if($_POST['action'] == 'delete_product_image') {
                $id = addslashes($_POST['id']);

                echo $product->delete_product_image($id);
                exit;
            }
        }

        $data['count'] = $product->fetchProductCount();
        $data['products'] = $product->fetchAllProducts();
        $this->loadTemplate('products/search_products', $data);
    }
}