<?php  

class Conexion extends mysqli{

    public function __construct($host, $user, $pass, $nameDB) {
        parent::__construct($host, $user, $pass, $nameDB);

        if (mysqli_connect_error()) {
            die('Error de Conexión (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
    }

    public function execute($query){
        $res=$this->query($query);
        return $res;
    }
}