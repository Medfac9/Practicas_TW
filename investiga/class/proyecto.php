<?php

class Proyecto {
    // Variables
    public $idProyecto = 0;
    public $codigo = '';
    public $titulo = '';
    public $descripcion = '';
    public $fecha_ini = '';
    public $fecha_fin = '';
    public $entidad = '';
    public $cuantia = '';
    public $principal = '';
    public $colaborador = '';
    public $url = '';
    
    function __construct($idProyecto = 0){
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        if($idProyecto != 0){
            $stmt = $link->prepare("SELECT * FROM proyecto WHERE idProyecto = ?");
            $stmt->bind_param('i',$idProyecto);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $row = $resultado->fetch_assoc();
            $this->idProyecto = $row["idProyecto"];
            $this->codigo = $row["codigo"];
            $this->titulo = $row["titulo"];
            $this->descripcion = $row["descripcion"];
            $this->fecha_ini = $row["fecha_ini"];
            $this->fecha_fin = $row["fecha_fin"];
            $this->fecha_ini = str_replace("-","/",$this->fecha_ini);
            $this->fecha_fin = str_replace("-","/",$this->fecha_fin);
            $this->entidad = $row["entidad"];
            $this->cuantia = $row["cuantia"];
            $this->principal_otro = $row["principal"];
            $this->colaborador_otro = $row["colaborador"];
            $link->close();
            
            $link = $bbdd->conectar();
            // Un solo SELECT devuelve todos los miembros asociados a un proyecto, de ambos tipos.
            $stmt = $link->prepare("SELECT idMiembro,tipo FROM miembrosProyectos WHERE idProyecto = ?");
            $stmt->bind_param('i',$this->idProyecto);
            $stmt->execute();
            $autoresPrincipales = array();
            $autoresColaboradores = array();
            $idMiembro = '';
            $tipo = '';
            $stmt->bind_result($idMiembro,$tipo);
            while($stmt->fetch()){
                // Dependiendo de $tipo, metemos al miembro en un array u otro.
                if($tipo == 'principal'){
                    $autoresPrincipales[] = $idMiembro;
                } else {
                    $autoresColaboradores[] = $idMiembro;
                }    
            }
            // Guardamos cada array en su sitio.
            $this->principal = $autoresPrincipales;
            $this->colaborador = $autoresColaboradores;
            $link->close();
            
            //$this->principal = unserialize($this->principal);
            //$this->colaborador = unserialize($this->colaborador);
            $this->url = $row["url"];
        }
    }
    
    public function guardar(){
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        date_default_timezone_set("Europe/Madrid");
        if($this->idProyecto == 0){
//            $this->principal = array_unique($this->principal);
//            $this->colaborador = array_unique($this->colaborador);
            
            //$this->principal = serialize($this->principal);
            //$this->colaborador = serialize($this->colaborador);
//            foreach ($this->principal as $autor){
//                $tipo = 'principal';
//                $stmt = $link->prepare("INSERT INTO miembrosProyectos (idMiembro,idProyecto,tipo) VALUES (?,?,?)");
//                $stmt->bind_param('iis', $autor, $this->idProyecto,$tipo);
//                $stmt->execute();
//            }
//            
//            foreach ($this->colaborador as $autor){
//                $tipo = 'colaborador';
//                $stmt = $link->prepare("INSERT INTO miembrosProyectos (idMiembro,idProyecto,tipo) VALUES (?,?,?)");
//                $stmt->bind_param('iis', $autor, $this->idProyecto,$tipo);
//                $stmt->execute();
//            }
            // Insertar Nuevo Registro
            $fecha_ini = date("Y-m-d", strtotime($this->fecha_ini));
            $fecha_fin = date("Y-m-d", strtotime($this->fecha_fin));
            $stmt = $link->prepare("INSERT INTO proyecto (codigo, titulo, descripcion, fecha_ini, fecha_fin, entidad,"
            . " cuantia, url,principal,colaborador) "
            . "VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssisss', $this->codigo, $this->titulo, $this->descripcion, $fecha_ini,
                    $fecha_fin,$this->entidad,$this->cuantia,$this->url,$this->principal_otro,$this->colaborador_otro);
            if($stmt->execute()){
                $id = mysqli_stmt_insert_id($stmt);
                $this->idProyecto = $id;
            }
            else{
                debugArr(mysqli_error($link));
                return false;
            }
        } else {
            // Actualizar Registro Existente
            $stmt = $link->prepare("DELETE FROM miembrosProyectos WHERE idProyecto = ?");
            $stmt->bind_param('i', $this->idProyecto);
            $stmt->execute();
            $link->close();
            
            $this->principal = array_unique($this->principal);
            $tipo = 'principal';
            foreach ($this->principal as $autor){
                $link = $bbdd->conectar();
                $stmt = $link->prepare("INSERT INTO miembrosProyectos (idMiembro,idProyecto,tipo) VALUES (?,?,?)");
                $stmt->bind_param('iis', $autor, $this->idProyecto,$tipo);
                $stmt->execute();
                $link->close();
            } 
            $this->colaborador = array_unique($this->colaborador);
            $tipo = 'colaborador';
            foreach ($this->colaborador as $autor){
                $link = $bbdd->conectar();
                $stmt = $link->prepare("INSERT INTO miembrosProyectos (idMiembro,idProyecto,tipo) VALUES (?,?,?)");
                $stmt->bind_param('iis', $autor, $this->idProyecto,$tipo);
                $stmt->execute();
                $link->close();
            } 
            //$this->principal = serialize($this->principal);
            //$this->colaborador = serialize($this->colaborador);
            $link = $bbdd->conectar();
            $fecha_ini = date("Y-m-d", strtotime($this->fecha_ini));
            $fecha_fin = date("Y-m-d", strtotime($this->fecha_fin));
            
            $stmt = $link->prepare("UPDATE proyecto SET codigo = ?, titulo = ?, descripcion = ?, fecha_ini = ?, fecha_fin = ?,"
                    . " entidad = ?, cuantia = ?, url = ?, principal = ?, colaborador = ? WHERE idProyecto = ? ");
            $stmt->bind_param('ssssssisssi', $this->codigo, $this->titulo, $this->descripcion, $fecha_ini,
                    $fecha_fin,$this->entidad,$this->cuantia,$this->url, $this->principal_otro, $this->colaborador_otro,
                    $this->idProyecto);
            if(!$stmt->execute()){
                debugArr(mysqli_error($link));
                return false;
            }
        }
        
        return $this->idProyecto;
    }
}
?>