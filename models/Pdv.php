<?php

class Pdv extends Model {
    
    public function fetch_pdv_products($name) {
        $data = '';

        $sql = $this->db->prepare("SELECT * FROM products WHERE name LIKE '%' :name '%' ORDER BY name ASC");
        $sql->bindValue(":name", $name);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $products =  $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($products AS $product) {
                $data .='
                    <div class="prod_item" id="'.$product['id'].'" onclick="select_item(this)">'.$product['name'].'</div>
                ';
            }
        }

        return $data;
    }

    public function fetch_pdv_product_info($id) {
        $data = '';

        $sql = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $info = $sql->fetch(PDO::FETCH_ASSOC);

            $data .='
                <div class="info_area">
                    <div class="info_desc">
                        <label>Em Estoque:</label><br/>';
                        if($info['qtd'] <= 0) {
                            $data .='<span style="color: red; font-weight: bold">SEM ESTOQUE</span>';
                        } else {
                            $data .='<span>'.$info['qtd'].'</span>';
                        }
                        $data .='
                    </div>
                    <div class="info_desc">
                        <label>Valor de Compra:</label><br/>
                        <span>R$ '.number_format($info['buy_cost'],2,',','.').'</span>
                    </div>
                    <div class="info_desc">
                        <label>Valor de Venda:</label><br/>
                        <span>R$ '.number_format($info['sale_cost'],2,',','.').'</span>
                    </div>
                </div>
                <div class="info_area">
                    <div class="info_desc">
                        <label>Quantidade</label>';
                        $info['qtd'] <= 0 ? $data .='<input type="number" class="form-control form-control-sm" placeholder="0" disabled>': $data .='<input type="number" class="form-control form-control-sm" placeholder="0">';
                        $data .='
                    </div>
                    <div class="info_desc">
                        <label>Desconto (R$)</label>';
                        $info['qtd'] <= 0 ? $data .='<input type="number" class="form-control form-control-sm" placeholder="0.00" disabled>': $data .='<input type="number" class="form-control form-control-sm" placeholder="0.00">';
                        $data .='
                    </div>
                </div>
            ';
        }
        
        return $data;
    }

    public function fetch_pdv_product_img($id) {
        $data = '';

        $sql = $this->db->prepare("SELECT * FROM product_images WHERE product_id = :product_id");
        $sql->bindValue(":product_id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $img = $sql->fetch(PDO::FETCH_ASSOC);

            $data .='<img src="'.BASE_URL.'assets/images/products/'.$img['url'].'">';
        }

        return $data;
    }
}