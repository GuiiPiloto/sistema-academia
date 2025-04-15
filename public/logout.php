<?php
session_start();
require_once __DIR__ . '/../src/controllers/LoginController.php';
$loginCtrl = new LoginController();
$loginCtrl->logout();
?>