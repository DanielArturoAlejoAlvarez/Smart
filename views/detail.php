<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMART</title>
    <link rel="stylesheet" href="../public/css/app.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="col-1">
            <h1>Details Market</h1>
            <div class="clearfix"></div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCT</th>                    
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>Subtotal</th>
                    </tr>


                    <?php  

                        require_once "../models/Data.php";
                        $marketId=$_GET['id'];
                        $d=new Data();
                        
                        $details=$d->getDetails($marketId);

                        $total=0;

                        foreach ($details as $dt) {
                            echo '<tr>';
                                echo '<th>'.$dt->cod.'</th>';
                                echo '<td>'.$dt->product.'</td>';
                                echo '<td><strong>$'.$dt->price.'</strong></td>';
                                echo '<td>'.$dt->qty.'</td>';
                                echo '<td>$'.$dt->subTotal.'</td>';
                                $total += $dt->subTotal;
                            echo '</tr>';
                        }

                        echo '<tr>';
                            echo '<th colspan="4">TOTAL:</th>';
                            echo '<td class="bg-yellow black big center"><strong>$'.$total.'</strong></td>';
                        echo '</tr>';
                    ?>

                   
                </table>
                
            </div>
            <a href="supermarket.php" class="badge bg-gray white"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
        </div>
    </div>
</body>
</html>

