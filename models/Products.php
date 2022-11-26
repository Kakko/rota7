<?php
class Products extends Model {

    public function fetchAllProducts() {
        $sql = $this->db->prepare("SELECT suppliers.name AS supplier, 
                                    categories.name AS category, 
                                    brands.name AS brand,
                                    (SELECT url FROM product_images WHERE products.id = product_images.product_id LIMIT 1) AS url,
                                    products.* FROM products 
                                    LEFT JOIN suppliers ON (suppliers.id = products.supplier_id)
                                    LEFT JOIN categories ON (categories.id = products.category_id)
                                    LEFT JOIN brands ON (brands.id = products.brand_id)
                                    ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $products = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        } else {
            return array();
        }
    }

    public function addNewProd($name, $supplier_id, $category_id, $brand_id, $ean, $color, $qtd, $buy_cost, $sale_cost, $obs, $url) {
        
        $sql = $this->db->prepare("INSERT INTO products SET name = :name, supplier_id = :supplier_id, category_id = :category_id, brand_id = :brand_id, ean = :ean, color = :color, qtd = :qtd, buy_cost = :buy_cost, sale_cost = :sale_cost, obs = :obs, reg_date = now()");

        $sql->bindValue(":name", $name);
        $sql->bindValue(":supplier_id", $supplier_id);
        $sql->bindValue(":category_id", $category_id);
        $sql->bindValue(":brand_id", $brand_id);
        $sql->bindValue(":ean", $ean);
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

    public function deleteProduct($id) {
        $sql = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $sql->bindValue(":id", $id);
        if($sql->execute()) {
            return 'Item excluido com sucesso';
        }
    }

}