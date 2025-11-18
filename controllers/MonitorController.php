<?php
require_once __DIR__ . '/../models/DataModel.php';

class MonitorController {
    public function showMonitor() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header('Location: ?route=login');
            exit;
        }

        $username = $_SESSION['username'];
        
        require __DIR__ . '/../views/monitor.php';
    }
}
?>