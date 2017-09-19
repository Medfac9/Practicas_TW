<?php

class Publicacion {
    
    // Variables
    public $idPublicacion = 0;
    public $tipo = '';
    public $doi = '';
    public $titulo = '';
    public $autor = '';
    public $fecha = '';
    public $resumen = '';
    public $palabras = '';
    public $url = '';
    public $proyecto = '';
    public $nombre_r = '';
    public $volumen = '';
    public $paginas = '';
    public $editorial = '';
    public $editor = '';
    public $isbn = '';
    public $titulo_l = '';
    public $nombre_c = '';
    public $lugar = '';
    public $resena = '';
    public $otro = '';
    
    function __construct($idPublicacion = 0){
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        if($idPublicacion != 0){
            $stmt = $link->prepare("SELECT * FROM publicacion WHERE idPublicacion = ?");
            $stmt->bind_param('i',$idPublicacion);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $row = $resultado->fetch_assoc();
            $this->idPublicacion = $row["idPublicacion"];
            $this->tipo = $row["tipo"];
            $this->doi = $row["doi"];
            $this->titulo = $row["titulo"];
            $this->autor = $row["autor"];
            $link->close();
            
            $link = $bbdd->conectar();
            $stmt = $link->prepare("SELECT idMiembro FROM miembrosPublicaciones WHERE idPublicacion = ?");
            $stmt->bind_param('i',$this->idPublicacion);
            $stmt->execute();
            $autores = array();
            $idMiembro = '';
            $stmt->bind_result($idMiembro);
            while($stmt->fetch()){
                $autores[] = $idMiembro;
            }
            $this->autor = $autores;
            $link->close();
            
            $this->fecha = $row["fecha"];
            $this->resumen = $row["resumen"];
            $this->palabras = $row["palabras"];
            $this->url = $row["url"];
            $this->proyecto = $row["proyecto"];
            $this->nombre_r = $row["nombre_r"];
            $this->volumen = $row["volumen"];
            $this->paginas = $row["paginas"];
            $this->editorial = $row["editorial"];
            $this->editor = $row["editor"];
            $this->isbn = $row["isbn"];
            $this->titulo_l = $row["titulo_l"];
            $this->nombre_c = $row["nombre_c"];
            $this->lugar = $row["lugar"];
            $this->resena = $row["resena"];
            $this->otro = $row["otro"];
        }
    }
    
    public function guardar(){
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        date_default_timezone_set("Europe/Madrid");
        if($this->idPublicacion == 0){
            
            $this->autor = array_unique($this->autor);
            
            foreach ($this->autor as $autor){
                $stmt = $link->prepare("INSERT INTO miembrosPublicaciones (idMiembro,idPublicacion) VALUES (?,?)");
                $stmt->bind_param('ii', $autor, $this->idPublicacion);
                $stmt->execute();
            }
            
            //$this->autor = serialize($this->autor);
            
            // Insertar Nuevo Registro
            $fecha = date("Y-m-d", strtotime($this->fecha));
            $stmt = $link->prepare("INSERT INTO publicacion (tipo, doi, titulo, fecha, resumen, palabras,"
            . " url, proyecto, nombre_r, volumen, paginas, editorial, editor, isbn, titulo_l, nombre_c, lugar, resena,otro) "
            . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('sisssssississssssss', $this->tipo, $this->doi, $this->titulo,
                    $fecha,$this->resumen,$this->palabras,$this->url,$this->proyecto,$this->nombre_r,$this->volumen,
                    $this->paginas,$this->editorial,$this->editor,$this->isbn,$this->titulo_l,$this->nombre_c,$this->lugar,
                    $this->resena,$this->otro);
            if($stmt->execute()){
                $id = mysqli_stmt_insert_id($stmt);
                $this->idPublicacion = $id;
            }
            else{
                debugArr(mysqli_error($link));
                return false;
            }
        } else {
            // Actualizar Registro Existente
            $stmt = $link->prepare("DELETE FROM miembrosPublicaciones WHERE idPublicacion = ?");
            $stmt->bind_param('i', $this->idPublicacion);
            $stmt->execute();
            $link->close();            
            
            $this->autor = array_unique($this->autor);
            foreach ($this->autor as $autor){
                $link = $bbdd->conectar();
                $stmt = $link->prepare("INSERT INTO miembrosPublicaciones (idMiembro,idPublicacion) VALUES (?,?)");
                $stmt->bind_param('ii', $autor, $this->idPublicacion);
                $stmt->execute();
                $link->close();
            }            
            
            $link = $bbdd->conectar();
            //$this->autor = serialize($this->autor);
            $fecha = date("Y-m-d", strtotime($this->fecha));
            $stmt = $link->prepare("UPDATE publicacion SET tipo = ?, doi = ?, titulo = ?, fecha = ?,"
                    . " resumen = ?, palabras = ?, url = ?, proyecto = ?, nombre_r = ?, volumen = ?,"
                    . " paginas = ?, editorial = ?, editor = ?, isbn = ?, titulo_l = ?, nombre_c = ?, lugar = ?,"
                    . " resena = ?, otro = ? WHERE idPublicacion = ? ");
            $stmt->bind_param('sisssssississssssssi', $this->tipo, $this->doi, $this->titulo,
                    $fecha,$this->resumen,$this->palabras,$this->url,$this->proyecto,$this->nombre_r,$this->volumen,
                    $this->paginas,$this->editorial,$this->editor,$this->isbn,$this->titulo_l,$this->nombre_c,$this->lugar,
                    $this->resena, $this->otro, $this->idPublicacion);
            if(!$stmt->execute()){
                debugArr(mysqli_error($link));
                return false;
            }
        }
        return $this->idPublicacion;
    }
    
}
?>