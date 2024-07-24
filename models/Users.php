<?php
class Users extends Model {

    public function fetchUserData() {
        $sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $sql->bindValue(":id", $_SESSION['lgUser']);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $user = $sql->fetch(PDO::FETCH_ASSOC);
        }

        return $user;
    }
}