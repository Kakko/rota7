<?php
class Users extends Model {

    private $userInfo;
    
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

    public function logout() {
        session_destroy();
    }

    public function setLoggedUser() {
        if(isset($_SESSION['lgUser']) && !empty($_SESSION['lgUser'])){
            $id = $_SESSION['lgUser'];
            
            $sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $this->userInfo = $sql->fetch(PDO::FETCH_ASSOC);
            }
        }
    }

    public function getName() {
        $this->setLoggedUser();

        if(isset($this->userInfo['name'])){
            return $this->userInfo['name'];
        } else {
            return 'Não tem nome';
        }
    }
}