<?php
// components/header.php
require __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'Fatec Meet' ?></title>

  <!-- Font Awesome (mesmo do index.php) -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
  >

  <!-- CSS global opcional -->
  <link rel="stylesheet" href="<?= BASE_URL ?>view/css/global.css">

  <!-- CSS da navbar -->
  <link rel="stylesheet" href="<?= BASE_URL ?>components/navbar.css">
</head>
<body>
  <?php include __DIR__ . '/navbar.php'; ?>
