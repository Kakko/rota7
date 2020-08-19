<?php
class homeController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();
        $users->setLoggedUser();

        //VERIFY IF THE USER IS LOGGED, IF NOT, REDIRECT TO LOGIN PAGE
        if($users->isLogged() == false){
            header("Location:".BASE_URL."login");
        }
        
        $data['user_name'] = $users->getName();
        $this->loadTemplate('home', $data);
    }

}