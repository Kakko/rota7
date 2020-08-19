<?php
class loginController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();

        //VERIFY IF THE EMAIL AND PASSWORD WAS CORRECT. IF TRUE, DO THE LOGIN
        if(isset($_POST['email']) && !empty($_POST['email'])){

            //use addslashes to protect against hackers (simple way)
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);

            if($users->doLogin($email, $password)){
                header("Location: ".BASE_URL);
            }

        }

        $this->loadView('login', $data);
    }

    public function logout() {
        $users = new Users();
        $users->setLoggedUser();

        $users->logout();
        header("Location: ".BASE_URL);
        exit;

    }
}