<?php 

    require_once "../models/Data.php";

    session_start();

    $cart=$_SESSION['cart'];

    $total=$_SESSION['total'];

    $d=new Data();

    $d->createMarket($cart, $total);

    //var_dump($d);

    session_unset($cart);
    session_unset($total);

    header('location: ../index.php');

