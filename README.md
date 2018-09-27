# SMART
## Description

This repository is a Application software with PHP and MYSQL - Shopping Cart.

## Installation
Using PHP7 preferably.

## DataBase
Using MYSQL preferably.

## Usage
```html
$ git clone https://github.com/DanielArturoAlejoAlvarez/Smart.git [NAME APP] 

```
Follow the following steps and you're good to go! Important:


![alt text](https://mattstauffer.com/assets/images/content/allautocomplete.gif)


## Coding

### Models

```php
...
public function getDetails($marketId){
$SQL="SELECT d.DETA_Code,p.PROD_Name,p.PROD_Price,d.DETA_Qty,d.DETA_Subtotal FROM details d, products p WHERE d.PROD_Code=p.PROD_Code AND d.MARK_Code=$marketId";
$res=$this->con->execute($SQL);

$details=[];
if($reg=mysqli_fetch_array($res)){
    $d=new Detail();
    $d->cod=$reg[0];
    $d->product=$reg[1];
    $d->price=$reg[2];
    $d->qty=$reg[3];
    $d->subTotal=$reg[4];

    array_push($details, $d);

}

return $details;
}
...   
```


### Helpers

```php
public static function slugify($text){
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
    }

}
```

### Controllers

```php
...
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
...
```

### Views

```php
...
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
...
```


## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/DanielArturoAlejoAlvarez/Smart. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.


## License

The gem is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).