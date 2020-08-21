<?php
class salesController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();
        $products = new Products();
        $sales = new Sales();
        $users->setLoggedUser();

        if(!empty($_POST['sale_action'])){
            if($_POST['sale_action'] == 'add') {
                $name = addslashes($_POST['name']);
                $qtd = addslashes($_POST['qtd']);

                echo $sales->addSale($name, $qtd);
                exit;
            }
        }


        $data['setSales'] = $sales->setSale();
        $data['user_name'] = $users->getName();
        $this->loadTemplate('sales', $data);
    }
}