<?php
require __DIR__ . '/../config.php';
session_destroy();
header('Location: ' . BASE_URL . 'view/Login.php');
exit;

