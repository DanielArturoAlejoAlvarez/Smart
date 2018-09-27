<?php   

require_once "../models/Data.php";

$p=new Product();//Obj Product

$p->qty=$_POST['txtQty'];

if($p->qty > 0){
    $p->cod=$_POST['txtCod'];
    $p->name=$_POST['txtName'];
    $p->name=$_POST['txtSlug'];
    $p->price=$_POST['txtPrice'];
    $p->stock=$_POST['txtStock'];
    $p->picture=$_POST['txtPicture'];
    $p->state=$_POST['txtState'];
    $p->desc=$_POST['textAreaDesc'];
    $p->date=$_POST['txtDateRegister'];

    $p->subTotal=$p->price * $p->qty;    

    session_start();
    if (isset($_SESSION['cart'])) {
        $cart=$_SESSION['cart'];//Recovery cart
    }else{
        $cart=[];//Create new cart
    }

    $sumaQty=0;
    foreach ($cart as $pro) {
        if($pro->cod == $p->cod){
          $sumaQty += $pro->qty;  
        }
    }

    $sumaQty += $p->qty;

    if($p->stock >= $sumaQty){
        array_push($cart, $p);//Push obj in cart list
        $_SESSION['cart']=$cart;//Put list in session
        
        header('location: ../index.php');
    }else{
        header('location: ../index.php?m=1'); 
    }    

}else{
    header('location: ../index.php?m=2'); 
}


