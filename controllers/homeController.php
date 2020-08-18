<?php
class homeController extends Controller {

    public function index() {
        $users = new Users();
        $data = array();

        //VERIFY IF THE USER IS LOGGED, IF NOT, REDIRECT TO LOGIN PAGE
        if($users->isLogged() == false){
            header("Location:".BASE_URL."login");
        }

        $this->loadTemplate('home', $data);
    }

}