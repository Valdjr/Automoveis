<?php 
require_once "cabecalho.php";
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}
?>
<style>
    textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    select[type="text"]:focus,
    .uneditable-input:focus {
        border-color: rgba(52, 58, 64, 0.4);
        box-shadow: inset 1px 1px rgba(0, 0, 0, 0), 0 0 0 3px rgba(52, 58, 64, 0.4);
    }
</style>
</head>
<body>
<nav class="navbar navbar-light bg-light pt-4 pb-4">
    <img src="img/logo.png" alt="" width="50" height="50" onclick="window.location.href = 'home.php'" style="cursor: pointer;">
    <div class="container justify-content-center">
        <div class="form-inline">
            <a href="/Automoveis/View/home.php"><button class="btn btn-outline-success btn-menu" type="button">Home</button></a>
            <a href="/Automoveis/View/form.veiculos.php"><button class="btn btn-outline-dark btn-menu" type="button">Veículos</button></a>
            <a href="/Automoveis/View/form.marcas.php"><button class="btn btn-outline-dark btn-menu" type="button">Marcas</button></a>
            <a href="/Automoveis/View/form.adicionais.php"><button class="btn btn-outline-dark btn-menu" type="button">Adicionais</button></a>
            <!-- <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown btn-menu" aria-expanded="false" disabled>Relatórios</button>
                <div class="dropdown-menu" >
                    <a class="dropdown-item" href="#">Veículos</a>
                </div>
            </div> -->
        </div>
    </div>
    <div class="float-right">
        <a href="/Automoveis/View/form.perfil.php"><button class="btn btn-outline-dark" type="button btn-menu">Perfil</button></a>
        <button class="btn btn-outline-danger btn-menu" type="button" onclick="sair()">Sair</button>
    </div>
    <script src="login.js"></script>
</nav>