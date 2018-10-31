<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: View/login.php");
} else {
    header("Location: View/home.php");
}