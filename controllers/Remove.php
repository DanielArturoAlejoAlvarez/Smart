<?php   


$index=$_GET['id'];

session_start();

if(isset($_SESSION['cart'])){
    $cart=$_SESSION['cart'];

    unset($cart[$index]);
    $cart=array_values($cart);

    $_SESSION['cart']=$cart;

    if(count($cart)==0){
        session_unset($cart);
    }
}

header('location: ../index.php');
