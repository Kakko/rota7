<?php
class Products extends Model {

    public function fetchProducts(){
        $array = array();
        
        $sql = $this->db->prepare("SELECT type.type AS tipo_nome, type.tax as tax, products.* FROM products INNER JOIN type ON (products.type_id = type.id) ORDER BY products.id;");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function fetchProdType(){
        $data = array();
        $sql = $this->db->prepare("SELECT * FROM type ORDER BY type ASC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function addNewProductType($type, $tax, $reg_date){
        $array = array();

        $sql = $this->db->prepare("INSERT INTO type (type, tax, reg_date) VALUES (:type, :tax, :reg_date)");
        $sql->bindValue(":type", $type);
        $sql->bindValue(":tax", $tax);
        $sql->bindValue(":reg_date", $reg_date);
        $sql->execute();

        $sql = $this->db->prepare("SELECT * FROM type ORDER BY type ASC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $result ='
            <label>Tipo do Produto</label>
            <div class="input-group">
                <select class="form-control form-control-sm" name="product_type">
                        <option readonly>Selecione...</option>';
                    foreach($array as $s){
                        $result .='
                            <option value="'.$s['id'].'">'.$s['type'].'</option>';
                    }
                    $result .='
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-success btn-sm" type="button" onclick="addProdType()"><i class="fas fa-plus"></i></button>
                </div>
            </div>
        ';
        return $result;

    }

    public function addNewProduct($name, $type, $value, $qtd, $url, $reg_date){
        $new_name = '';

        if(!empty($url)){
            $ext = strtolower(substr($_FILES['product_image']['name'], -4));
            $new_name = md5(time(). rand(0,999)) . $ext;
            $dir = './assets/images/products/';

            move_uploaded_file($url['tmp_name'], $dir.$new_name);
        }


        $sql = $this->db->prepare("INSERT INTO products (name, type_id, value, qtd, reg_date, url) VALUES (:name, :type_id, :value, :qtd, :reg_date, :url)");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":type_id", $type);
        $sql->bindValue(":value", $value);
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":url", $new_name);
        $sql->bindValue(":reg_date", $reg_date);
        $sql->execute();

    }

    public function deleteProduct($id){
        $sql = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}