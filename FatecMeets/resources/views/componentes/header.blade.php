<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Fatec Meet' }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- CSS Global -->
    <link rel="stylesheet" href="/css/global.css">

    <!-- Componentes -->
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/estiloLogin.css">
    <link rel="stylesheet" href="/css/estiloToken.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('componentes.navbar')
