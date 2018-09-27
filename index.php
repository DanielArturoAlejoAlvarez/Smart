<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMART</title>
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="col-1">
            <h1>Products</h1>
           <div class="clearfix"></div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <!-- <th>SLUG</th> -->
                    <th>PRICE</th>
                    <th>STOCK</th>
                    <th>PICTURE</th>
                    <th>STATE</th>
                    <!-- <th>DESC</th> -->
                    <th>DATE</th>
                    <th>QTY</th>
                    <th class="bg-yellow black">ADD TO CART</th>
                </tr>
            <?php  

                require_once "models/Data.php";
                require_once "helpers/Helper.php";
                
                
                $d=new Data();

                $products=$d->getProducts();

                foreach ($products as $prod) {
                        echo '<tr>';
                        echo '<th>'.$prod->cod.'</th>';
                        echo '<td>'.$prod->name.'</td>';  
                        //echo '<td>'.Helper::slugify($prod->name).'</td>';                                                
                        echo '<td><strong>$'.$prod->price.'</strong></td>';
                        echo '<td><strong class="red">'.$prod->stock.'</strong></td>';
                        echo '<td><img width="100" src="'.$prod->picture.'"></td>';
                        echo '<td>';
                        
                        switch ($prod->state) {
                            case 'YES':
                                echo '<i class="green fas fa-check"></i>';
                                break;
                            case 'NOT':
                                echo '<i class="red fas fa-times"></i>';
                                break;
                        }
                        
                        echo '</td>';
                        //echo '<td>'.Helper::truncate($prod->desc).'</td>';
                        echo '<td>'.Helper::dateTime($prod->date).'</td>';
                        
                        echo '<td class="flex"><form action="controllers/Add.php" method="post">';


                        echo '<input type="hidden" name="txtCod" value="'.$prod->cod.'"/>';
                        echo '<input type="hidden" name="txtName" value="'.$prod->name.'"/>';
                        echo '<input type="hidden" name="txtSlug" value="'.$prod->slug.'"/>';                        
                        echo '<input type="hidden" name="txtPrice" value="'.$prod->price.'"/>';
                        echo '<input type="hidden" name="txtStock" value="'.$prod->stock.'"/>';
                        echo '<input type="hidden" name="txtPicture" value="'.$prod->picture.'"/>';
                        echo '<input type="hidden" name="txtState" value="'.$prod->state.'"/>'; 
                        echo '<input type="hidden" name="textAreaDesc" value="'.$prod->desc.'"/>';                       
                        echo '<input type="hidden" name="txtDateRegister" value="'.$prod->date.'"/>';



                        echo '<select name="txtQty" required>';
                         

                        for ($i=0; $i <= $prod->stock.length ; $i++) { 
                        
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        
                        echo '</select></td>';           
                        echo '<td><button type="submit" name="btnAdd"><i class="fas fa-cart-plus"></i></button></form></td>';

                        echo '</tr>';
                }

                    
                ?>
                
            
            </table>


            <a href="views/supermarket.php" class="badge bg-gray white">Market List&nbsp;<i class="fas fa-arrow-right"></i></a> 
            
            
            <?php  

                if(isset($_GET['m'])){
                    $m=$_GET['m'];
                    switch ($m) {
                        case '1':
                            echo 'Product has not stock!';
                            break;
                        case '2':
                            echo 'Quantity must be a positive number!';
                            break;
                        
                    }
                }
            ?>

            <?php   

                session_start();
                if(isset($_SESSION['cart'])){
                    $cart=$_SESSION['cart'];
                }

                if(isset($cart)){

                

                    echo '<h1>Shopping List</h1>';
                    echo '<table>';
                        echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>NAME</th>';
                            echo '<th>PRICE</th>';
                            echo '<th>STOCK</th>';
                            
                            echo '<th>QTY</th>';
                            echo '<th>SUBTOTAL</th>';
                            echo '<th>ACTIONS</th>';
                        echo '</tr>';

                        $total=0;
                        $i=0;

                        foreach ($cart as $prod) {
                            echo '<tr>';

                            echo '<th>'.$prod->cod.'</th>';
                            echo '<td>'.$prod->name.'</td>';
                            echo '<td>$'.$prod->price.'</td>';
                            echo '<td>'.$prod->stock.'</td>';                                   
                            echo '<td>'.$prod->qty.'</td>';
                            echo '<td><strong>$'.$prod->subTotal.'</strong></td>';
                            echo '<td class="center">
                                <a class="red big" href="controllers/Remove.php?id='.$i.'"><i class="fas fa-trash"></i></a>
                            </td>';

                            $total+=$prod->subTotal;
                            $i++;
                            echo '</tr>';
                        }
                        echo '<tr>';
                            echo '<th colspan="5">TOTAL:</th>';
                            echo '<td colspan="2" class="bg-yellow black center"><strong class="big">$'.$total.'</strong></td>';
                            $_SESSION['total']=$total;
                        echo '</tr>';

                        echo '<tr>';
                            echo '<td colspan="7">';
                                echo '<form action="controllers/GenerateMarket.php">';
                                    echo '<button class="" type="submit"><i class="fas fa-shopping-basket"></i>&nbsp;BUY NOW</button>';
                                echo '</form>';
                            echo '</td>';
                        echo '</tr>';
                    echo '</table>';

                }
            ?>
        </div>
    </div>
    
    
</body>
</html>