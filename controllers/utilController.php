<?php

class utilController extends Controller {

    public function index() {

    }

    public function verifying() {
        $utils = new Utils();
        
        if(!empty($_POST) && isset($_POST)) {

            //VERIFY CATEGORIES
            if($_POST['action'] == 'verifyCat') {
                $name = addslashes($_POST['name']);

                echo $utils->verifyCat($name);
                exit;
            }

            //VERIFY SUPPLIERS
            if($_POST['action'] == 'verifySupplier') {
                $cnpj = addslashes($_POST['cnpj']);
    
                echo $utils->verifySupplier($cnpj);
                exit;
            }

            //VERIFY BRANDS
            if($_POST['action'] == 'verifyBrand') {
                $name = addslashes($_POST['name']);

                echo $utils->verifyBrand($name);
                exit;
            }

            //VERIFY CPF
            if($_POST['action'] == 'verifyCPF') {
                $cpf = addslashes($_POST['cpf']);

                echo $utils->verifyCPF($cpf);
                exit;
            }
        }
    }
}