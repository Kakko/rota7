<?php

class Login extends Model {

    public function isLogged() {
        if(!empty($_SESSION['lgUser'])) {
            return true;
        } else {
            return false;
        }
    }

    public function doLogin($email, $password) {
        $sql = $this->db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", md5($password));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $logged = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['lgUser'] = $logged['id'];
            return true;
        } else {
            return false;
        }
    }
}