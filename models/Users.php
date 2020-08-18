<?php
class Users extends Model {
    
    public function isLogged() {
        if(isset($_SESSION['lgUser']) && !empty($_SESSION['lgUser'])){
            return true;
        } else {
            return false;
        }
    }

    public function doLogin($email, $password){
        $sql = $this->db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", md5($password));
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['lgUser'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }
}