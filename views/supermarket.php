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
            <h1>Market List</h1>
            <div class="clearfix"></div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>DATE</th>                    
                        <th>TOTAL</th>
                        <th>DETAIL</th>
                    </tr>


                    <?php  

                        require_once "../models/Data.php";
                        require_once "../helpers/Helper.php";
                    
                        $d=new Data();
                        $markets=$d->getMarkets(); 

                        foreach ($markets as $mk) {
                            echo '<tr>';
                                echo '<th>'.$mk->cod.'</th>';
                                echo '<td>'.Helper::dateTime($mk->date).'</td>';
                                echo '<td><strong class="middle">$'.$mk->total.'</strong></td>';
                                echo '<td class="center"><a href="detail.php?id='.$mk->cod.'"><span class="badge bg-red white small">DETAIL</span></a></td>';

                            echo '</tr>';
                        }
                    ?>
                </table>

                
            </div>
            <a href="../index.php" class="badge bg-gray white"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
        </div>
    </div>
</body>
</html>

