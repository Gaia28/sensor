<?php
require_once __DIR__ . '/../config/db.php';

class UserModel {
   
    public function authenticate($username, $password) {
        $db = getDbConnection();
        
        $stmt = $db->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
}
?>