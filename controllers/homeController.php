<?php
class homeController extends Controller {

    public function index() {
        $data = array();
        $login = new Login();

        if($login->isLogged() == false) {
            header("Location:".BASE_URL."login");
        }
        
        $this->loadTemplate('home', $data);
    }

}