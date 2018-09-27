<?php  

require_once "Conexion.php";
require_once "Product.php";
require_once "Market.php";
require_once "Detail.php";

class Data{

    private $con;

    public function __construct(){
        $this->con=new Conexion('127.0.0.1','root','Br1tney$2=','smartdb');

    }

    public function getProducts(){
        $products=[];

        $SQL="SELECT * FROM products";        
        $res=$this->con->execute($SQL);
        while ($reg=mysqli_fetch_array($res)) {
            $p=new Product();
            $p->cod=$reg[0];
            $p->name=$reg[1];
            $p->slug=$reg[2];
            $p->price=$reg[3];
            $p->stock=$reg[4];
            $p->picture=$reg[5];
            $p->state=$reg[6];
            $p->desc=$reg[7];
            $p->date=$reg[8];

            array_push($products,$p);
        }

        return $products;
    }

    public function createMarket($productList, $total){
        $SQL="INSERT INTO markets VALUES (NULL, NOW(), $total)";
        $this->con->execute($SQL);

        $SQL2="SELECT max(MARK_Code) FROM markets";
        
        $res=$this->con->execute($SQL2);
        
        $lastIdMarket=0;

        if($reg=mysqli_fetch_array($res)){
            $lastIdMarket=$reg[0];
        }

        foreach ($productList as $p) {
            $SQL3="INSERT INTO details VALUES (NULL, '".$lastIdMarket."', '".$p->cod."', '".$p->qty."', '".$p->subTotal."')";
            $this->con->execute($SQL3);
            $this->updateStock($p->cod, $p->qty);
        }        
    }

    public function updateStock($id, $stockToDiscount){
        $SQL="SELECT PROD_Stock FROM products WHERE PROD_Code=$id";
        
        $res=$this->con->execute($SQL);

        $currentStock=0;
        if($reg=mysqli_fetch_array($res)){
            $currentStock=$reg[0];
        }

        $currentStock -= $stockToDiscount;

        $SQL2="UPDATE products SET PROD_Stock=$currentStock WHERE PROD_Code=$id";
        
        $this->con->execute($SQL2);
    }

    public function getMarkets(){
        $markets=[];

        $SQL="SELECT * FROM markets";        
        $res=$this->con->execute($SQL);
        while ($reg=mysqli_fetch_array($res)) {
            $mk=new Market();
            $mk->cod=$reg[0];
            $mk->date=$reg[1];
            $mk->total=$reg[2];

            array_push($markets,$mk);
        }

        return $markets;
    }

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
}