<?php
//Creamos la clase base de datos
class BBDD{
    //Declaramos 4 variables para conectarnos a la bbdd
    private $host;
    private $bbdd;
    private $user;
    private $pass;
    
    //Constructor
    public function __construct($host, $bbdd, $user, $pass){
        $this->host = $host;
        $this->bbdd = $bbdd;
        $this->user = $user;
        $this->pass = $pass;
    }

    //Funcion para conectar a la base de datos
    public function conectar(){
        $link = mysqli_connect($this->host, $this->user, $this->pass, $this->bbdd);
        if(!$link){
            echo "HOST $this->host ";
            echo "USUARIO $this->user ";
            echo "PASS $this->pass ";
            echo "BBDD $this->bbdd ";
            die("No se pudo conectar a la BBDD");
        }
        return $link;
    }
    
    public function checkConexion(){
        $link = mysqli_connect($this->host, $this->user, $this->pass, $this->bbdd);
        if(!$link){
            return false;
        }
        return true;
        
    }

    //Pasar a la base de datos las instrucciones
    public function query($query){
        $link = $this->conectar();
        $resultados = $link->query($query);
        $link->close();
        return $resultados;
    }

    public function multi_query($query){
        $link = $this->conectar();
        $resultados = $link->multi_query($query);
        $link->close();
        return $resultados;
    }
}
?>