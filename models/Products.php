<?php
class Products extends Model {

    public function addNewProd($name, $supplier_id, $category_id, $buy_date, $brand_id, $cod, $color, $qtd, $buy_cost, $sale_cost, $obs, $url) {
        
        $sql = $this->db->prepare("INSERT INTO products SET name = :name, supplier_id = :supplier_id, category_id = :category_id, buy_date = :buy_date, brand_id = :brand_id, cod = :cod, color = :color, qtd = :qtd, buy_cost = :buy_cost, sale_cost = :sale_cost, obs = :obs, reg_date = now()");

        $sql->bindValue(":name", $name);
        $sql->bindValue(":supplier_id", $supplier_id);
        $sql->bindValue(":category_id", $category_id);
        $sql->bindValue(":buy_date", $buy_date);
        $sql->bindValue(":brand_id", $brand_id);
        $sql->bindValue(":cod", $cod);
        $sql->bindValue(":color", $color);
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":buy_cost", $buy_cost);
        $sql->bindValue(":sale_cost", $sale_cost);
        $sql->bindValue(":obs", $obs);
        $sql-> execute(); 

        $id = $this->db->lastInsertId();

        if(!empty($url)){
            for($i = 0; $i < count($_FILES['product_img']['name']); $i++) {
                $ext = strtolower(substr($_FILES['product_img']['name'][$i], -4));
                $new_name = md5(time(). rand(0,999)) . $ext;
                
                $dir = './assets/images/products/';

                move_uploaded_file($url['tmp_name'][$i], $dir.$new_name);

                $sql = $this->db->prepare("INSERT INTO product_images SET url = :url, product_id = :product_id, reg_date = NOW()");
                $sql->bindValue(":url", $new_name);
                $sql->bindValue(":product_id", $id);
                $sql->execute();

            }
        }
    }

    public function edit_product($id) {
        $data = '';

        $suppliers = new Suppliers();
        $categories = new Categories();
        $brands = new Brands();

        //FETCH ALL IMAGES FROM PRODUCT
        $sql = $this->db->prepare("SELECT id, url FROM product_images WHERE product_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $images = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $images = array();
        }

        //FETCH PRODUCT INFO
        $sql = $this->db->prepare("SELECT suppliers.name AS supplier, 
                                    categories.name AS category, 
                                    brands.name AS brand,
                                    (SELECT url FROM product_images WHERE products.id = product_images.product_id LIMIT 1) AS url,
                                    products.* FROM products 
                                    LEFT JOIN suppliers ON (suppliers.id = products.supplier_id)
                                    LEFT JOIN categories ON (categories.id = products.category_id)
                                    LEFT JOIN brands ON (brands.id = products.brand_id)
                                    WHERE products.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $item = $sql->fetch(PDO::FETCH_ASSOC);

            $data .='
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Código</label>
                            <input type="number" class="form-control form-control-sm" name="product_cod" value="'.$item['cod'].'">
                        </div>
                        <div class="col-sm-2">
                            <label>Fornecedor</label>
                            <select class="form-control form-control-sm" name="product_supplier">
                                <option value="'.$item['supplier_id'].'">'.$item['supplier'].'</option>
                                <option value="" disabled>--------------</option>';
                                foreach($suppliers->fetchSuppliers() as $supplier) {
                                    $data .='<option value="'.$supplier['id'].'">'.$supplier['name'].'</option>';
                                }
                                $data .='
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Nome</label>
                            <input type="text" value="editProduct" name="action" hidden>
                            <input type="text" value="'.$item['id'].'" name="product_id" hidden>
                            <input type="text" class="form-control form-control-sm" name="product_name" value="'.$item['name'].'">
                        </div>
                        <div class="col-sm-2">
                            <label>Categoria</label>
                            <select class="form-control form-control-sm" name="product_category">
                                <option value="'.$item['category_id'].'">'.$item['category'].'</option>
                                <option value="" disabled>--------------</option>';
                                foreach($categories->fetchCategories() as $category) {
                                    $data .='<option value="'.$category['id'].'">'.$category['name'].'</option>';
                                }
                                $data .='
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Data de compra</label>
                            <input type="date" class="form-control form-control-sm" name="buy_date" value="'.$item['buy_date'].'">
                        </div>
                        <div class="col-sm-2">
                            <label>Marca</label>
                            <select class="form-control form-control-sm" name="brand">
                                <option value="'.$item['brand_id'].'">'.$item['brand'].'</option>
                                <option value="" disabled>--------------</option>';
                                foreach($brands->fetchBrands() as $brand) {
                                    $data .='<option value="'.$brand['id'].'">'.$brand['name'].'</option>';
                                }
                                $data .='
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Cor</label>
                            <input type="text" class="form-control form-control-sm" name="product_color" value="'.$item['color'].'">
                        </div>
                        <div class="col-sm-2">
                            <label>Quantidade</label>
                            <input type="number" class="form-control form-control-sm" name="product_qtd" value="'.$item['qtd'].'" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Preço de Custo</label>
                            <input type="text" class="form-control form-control-sm money" name="product_bprice" value="'.number_format($item['buy_cost'],2,',','.').'" placeholder="R$" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Preço de Venda</label>
                            <input type="text" class="form-control form-control-sm money" name="product_sprice" value="'.number_format($item['sale_cost'],2,',','.').'" placeholder="R$" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Descrição</label>
                            <textarea name="obs" class="form-control form-control-sm" style="resize: none" placeholder="Digite a descrição do produto">'.$item['obs'].'</textarea>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12" style="display: flex; flex-direction: row" id="product_image_area">';
                        foreach($images as $image) {
                            $data .='
                                <div style="width: 80px; height: 100px; border: 1px solid #CCC; border-radius: 2px; margin: 2px; position: relative">
                                    <img src="'.BASE_URL.'assets/images/products/'.$image['url'].'" style="max-width: 100%">
                                    <div style="width: 25%; height: 20px; position:absolute; top: 2px; right: 2px; cursor: pointer" onclick="delete_product_image('.$image['id'].')">
                                        <img src="'.BASE_URL.'assets/icons/close.png" style="width: 100%">
                                    </div>
                                </div>
                            ';
                        }
                        $data .='
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label style="display: block">Imagens do produto</label>
                            <input type="FILE" name="product_img[]" multiple>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    </div>
                </form>
            ';
        }

        return $data;
    }

    public function editProd($id, $name, $supplier_id, $category_id, $buy_date, $brand_id, $cod, $color, $qtd, $buy_cost, $sale_cost, $obs, $url) {
        
        $sql = $this->db->prepare("UPDATE products SET 
            name = :name, 
            supplier_id = :supplier_id, 
            category_id = :category_id, 
            brand_id = :brand_id, 
            buy_date = :buy_date,
            cod = :cod, 
            color = :color, 
            qtd = :qtd, 
            buy_cost = :buy_cost, 
            sale_cost = :sale_cost, 
            obs = :obs
            WHERE id = :id");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":supplier_id", $supplier_id);
        $sql->bindValue(":category_id", $category_id);
        $sql->bindValue(":buy_date", $buy_date);
        $sql->bindValue(":brand_id", $brand_id);
        $sql->bindValue(":cod", $cod);
        $sql->bindValue(":color", $color);
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":buy_cost", $buy_cost);
        $sql->bindValue(":sale_cost", $sale_cost);
        $sql->bindValue(":obs", $obs);
        $sql-> execute(); 

        if(!empty($url)){
            for($i = 0; $i < count($_FILES['product_img']['name']); $i++) {
                $ext = strtolower(substr($_FILES['product_img']['name'][$i], -4));
                $new_name = md5(time(). rand(0,999)) . '.'.$ext;
                $dir = './assets/images/products/';

                move_uploaded_file($url['tmp_name'][$i], $dir.$new_name);

                $sql = $this->db->prepare("INSERT INTO product_images SET url = :url, product_id = :product_id, reg_date = NOW()");
                $sql->bindValue(":url", $new_name);
                $sql->bindValue(":product_id", $id);
                $sql->execute();

            }
        }
    }

    public function delete_product_image($id) {
        $data ='';

        $sql = $this->db->prepare("SELECT product_id FROM product_images WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $product_id = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $sql = $this->db->prepare("DELETE FROM product_images WHERE id = :id");
        $sql->bindValue(":id", $id);
        if($sql->execute()){
            
            $sql = $this->db->prepare("SELECT * FROM product_images WHERE product_id = :product_id");
            $sql->bindValue(":product_id", $product_id['product_id']);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $images = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($images as $image) {
                    $data .='
                        <div style="width: 80px; height: 100px; border: 1px solid #CCC; border-radius: 2px; margin: 2px; position: relative">
                            <img src="'.BASE_URL.'assets/images/products/'.$image['url'].'" style="max-width: 100%">
                            <div style="width: 25%; height: 20px; position:absolute; top: 2px; right: 2px; cursor: pointer" onclick="delete_product_image('.$image['id'].')">
                                <img src="'.BASE_URL.'assets/icons/close.png" style="width: 100%">
                            </div>
                        </div>
                    ';
                }

                return $data;
            }   
        }
    }

    public function fetchAllProducts() {
        $sql = $this->db->prepare("SELECT suppliers.name AS supplier, 
                                    categories.name AS category, 
                                    brands.name AS brand,
                                    (SELECT url FROM product_images WHERE products.id = product_images.product_id LIMIT 1) AS url,
                                    products.* FROM products 
                                    LEFT JOIN suppliers ON (suppliers.id = products.supplier_id)
                                    LEFT JOIN categories ON (categories.id = products.category_id)
                                    LEFT JOIN brands ON (brands.id = products.brand_id)
                                    ORDER BY name ASC LIMIT 5");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $products = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        } else {
            return array();
        }
    }

    public function fetchProductCount() {
        $sql = $this->db->prepare("SELECT * FROM products");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $count = count($sql->fetchAll(PDO::FETCH_ASSOC));
        } else {
            $count = 0;
        }

        return $count;
    }
    
    public function verify_product($product_code, $supplier_id) {
        $sql = $this->db->prepare("SELECT * FROM products WHERE cod = :cod AND supplier_id = :supplier_id");
        $sql->bindValue(":cod", $product_code);
        $sql->bindValue(":supplier_id", $supplier_id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}