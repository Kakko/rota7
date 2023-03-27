<?php
class loginController extends Controller {

    public function index() {
        $data = array();
        $login = new Login();
        
        if(!empty($_POST)) {
            if(!empty($_POST['email']) && isset($_POST['email'])){
                $email = addslashes($_POST['email']);
                $password = addslashes($_POST['password']);
    
                if($login->doLogin($email, $password)){
                    header("Location: ".BASE_URL);
                }
            }
        }
        
        $this->loadView('login', $data);
    }
}