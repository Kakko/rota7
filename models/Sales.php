<?php
class Sales extends Model {

    public function setSale(){
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM products WHERE qtd > 0");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function addSale($name, $qtd){
        $array = array();

        $sql = $this->db->prepare("SELECT type.type AS tipo, type.tax as tax, products.* FROM products 
                                    INNER JOIN type ON(type.id = products.type_id)
                                    WHERE products.id = :name");
        $sql->bindValue(":name", $name);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $result ='
            <tr>
                <th>'.$array['name'].'</th>
                <th>'.$array['tipo'].'</th>
                <th class="tottax">'.number_format((($array['value'] * $array['tax']) / 100) * $qtd,2).'</th>
                <th class="totProd">'.number_format($array['value'] * $qtd,2).'</th>
                <th>'.$qtd.'</th>
                <th></th>
            </tr>
        ';

        return $result;
    }
}