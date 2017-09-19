<?php

class Miembro {
    
    // Variables
    public $idMiembro = 0;
    public $nombre = '';
    public $apellidos = '';
    public $categoria = '';
    public $director = 0;
    public $email = '';
    public $clave = '';
    public $telefono = '';
    public $url = '';
    public $departamento = '';
    public $centro = '';
    public $universidad = '';
    public $direccion = '';
    public $foto = '';
    public $rol = 1;
    public $bloqueado = 0;
    public $activo = 1;
    
    function __construct($idMiembro = 0){
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        if($idMiembro != 0){
            $stmt = $link->prepare("SELECT * FROM miembro WHERE idMiembro = ?");
            $stmt->bind_param('i',$idMiembro);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $row = $resultado->fetch_assoc();
            $this->idMiembro = $row["idMiembro"];
            $this->nombre = $row["nombre"];
            $this->apellidos = $row["apellidos"];
            $this->categoria = $row["categoria"];
            $this->director = $row["director"];
            $this->email = $row["email"];
            $this->telefono = $row["telefono"];
            $this->url = $row["url"];
            $this->departamento = $row["departamento"];
            $this->centro = $row["centro"];
            $this->universidad = $row["universidad"];
            $this->direccion = $row["direccion"];
            $this->formato = $row["formato"];
            $this->rol = $row["rol"];
            $this->bloqueado = $row["bloqueado"];
            $this->activo = $row["activo"];
        }
    }
    
    public function guardar(&$fotomsg = ''){
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        if($this->idMiembro == 0){
            // Insertar Nuevo Registro
            $stmt = $link->prepare("INSERT INTO miembro (nombre, apellidos, categoria, director, email, clave, telefono,"
            . " url, departamento, centro, universidad, direccion, rol, bloqueado, activo) "
            . "VALUES (?,?,?,?,?,MD5(?),?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('sssissssssssiii', $this->nombre, $this->apellidos, $this->categoria, $this->director,
                    $this->email,$this->clave,$this->telefono,$this->url,$this->departamento,$this->centro,$this->universidad,
                    $this->direccion,$this->rol,$this->bloqueado,$this->activo);
            if($stmt->execute()){
                $id = mysqli_stmt_insert_id($stmt);
                $this->idMiembro = $id;
            }
            else{
                debugArr(mysqli_error($link));
                return false;
            }
        } else {
            // Actualizar Registro Existente
            
            if($this->clave != ''){
                $stmt = $link->prepare("UPDATE miembro SET nombre = ?, apellidos = ?, categoria = ?, director = ?, email = ?,"
                        . " clave = MD5(?), telefono = ?, url = ?, departamento = ?, centro = ?, universidad = ?,"
                        . " direccion = ?, rol = ?, bloqueado = ?, activo = ? WHERE idMiembro = ? ");
                $stmt->bind_param('sssissssssssiiii', $this->nombre, $this->apellidos, $this->categoria, $this->director,
                        $this->email,$this->clave,$this->telefono,$this->url,$this->departamento,$this->centro,$this->universidad,
                        $this->direccion,$this->rol,$this->bloqueado,$this->activo,$this->idMiembro);
            } else {
                $stmt = $link->prepare("UPDATE miembro SET nombre = ?, apellidos = ?, categoria = ?, director = ?, email = ?,"
                        . " telefono = ?, url = ?, departamento = ?, centro = ?, universidad = ?,"
                        . " direccion = ?, rol = ?, bloqueado = ?, activo = ? WHERE idMiembro = ? ");
                $stmt->bind_param('sssisssssssiiii', $this->nombre, $this->apellidos, $this->categoria, $this->director,
                        $this->email,$this->telefono,$this->url,$this->departamento,$this->centro,$this->universidad,
                        $this->direccion,$this->rol,$this->bloqueado,$this->activo,$this->idMiembro);
            }
            if(!$stmt->execute()){
                debugArr(mysqli_error($link));
                return false;
            }
        }
        
        
        if($_FILES["foto"]["size"] > 0 && $_FILES["foto"]["error"] == 0){
            $target_dir = "../fotos/miembros/";
            $target_file = $target_dir . $this->idMiembro;
            $uploadOk = 1;
            $fotomsg = '';
            $imageFileType = pathinfo($_FILES["foto"]["name"],PATHINFO_EXTENSION);
            $target_file .= ".".$imageFileType;
            // Comprobamos si la foto subida es una imagen realmente.
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["foto"]["tmp_name"]);
                if($check !== false) {
                    //$fotomsg = "El archivo es una imagen - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $fotomsg .= "El archivo no es una imagen.<br/>";
                    $uploadOk = 0;
                }
            }
            // Comprobamos si la foto ya existe y la borramos.
            if (file_exists($target_file)) {
                unlink($target_file);
            }
            // Comprobamos el tamaño del archivo
            if ($_FILES["foto"]["size"] > 1000000) {
                $fotomsg .= "La imagen es demasiado pesada.<br/>";
                $uploadOk = 0;
            }
            // Se permiten solo ciertos tipos de archivo
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $fotomsg .= "Sólo se admiten archivos de tipo JPG, JPEG, PNG y GIF.<br/>";
                $uploadOk = 0;
            }
            // Comprobamos si $uploadOk es 0 porque ha ocurrido un error
            if ($uploadOk == 0) {
                $fotomsg .= "El archivo no se subió.<br/>";
            // Si todo es correcto, intentamos subir el archivo.
            } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    //$fotomsg = "El archivo ". basename( $_FILES["foto"]["name"]). " ha sido subido.";
                    $stmt = $link->prepare("UPDATE miembro SET formato = ? WHERE idMiembro = ?");
                    $stmt->bind_param('si',$imageFileType,$this->idMiembro);
                    $stmt->execute();
                } else {
                    $fotomsg .= "Se produjo un error subiendo el archivo.";
                }
            }
        }
        
        return $this->idMiembro;
    }
    
}
?>
