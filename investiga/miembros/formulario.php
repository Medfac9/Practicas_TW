<?php

require_once('../include/funciones.php');

if(!checkPermiso('MIEMB','escritura')){
    redirigir(_URL_.'/accesoDenegado.php');
}

require_once('../include/head.php');
require_once('../class/miembro.php');

$miembro = new Miembro();

$nombre = '';
$apellidos = '';
$categoria = '';
$email = '';
$clave = '';
$telefono = '';
$url = '';
$departamento = '';
$centro = '';
$universidad = '';
$direccion = '';
$foto = '';
$rol = '';

$titulo_web= "Nuevo Miembro";
$idMiembro = 0;
$director = 0;
$bloqueado = 0;
$activo = 1;
$mostrarMensaje = 0;
$fotomsg = '';

if(isset($_POST["accion"]) && $_POST["accion"] == "guardar"){
    $modificar = 0;
    if($_POST["idMiembro"] != 0)
        $modificar = 1;
    $miembro->idMiembro = $_POST["idMiembro"];
    $miembro->nombre = $_POST["nombre"];
    $miembro->apellidos = $_POST["apellidos"];
    $miembro->categoria = $_POST["categoria"];
    $miembro->director = $_POST["director"];
    $miembro->email = $_POST["email"];
    $miembro->clave = $_POST["clave"];
    $miembro->telefono = $_POST["telefono"];
    $miembro->url = $_POST["url"];
    $miembro->departamento = $_POST["departamento"];
    $miembro->centro = $_POST["centro"];
    $miembro->universidad = $_POST["universidad"];
    $miembro->direccion = $_POST["direccion"];
    $miembro->foto = $_FILES["foto"];
    $miembro->rol = $_POST["rol"];
    $miembro->bloqueado = $_POST["bloqueado"];
    $miembro->activo = $_POST["activo"];
    
    $resultado = $miembro->guardar($fotomsg);
    
    if($resultado === false){
        $mostrarMensaje = 1;
        $class = "alert alert-danger";
        $mensaje = "No se han podido guardar los datos";
    } else {
        $mostrarMensaje = 1;
        $class = "alert alert-success";
        $mensaje = "Miembro guardado correctamente";
        if($fotomsg != ''){
            $mensaje .= "<br/><br/>Se produjo un error subiendo la foto:<br/><br/>".$fotomsg;
        }
        $titulo_web = "Editar Miembro";
        if($modificar == 0)
            guardarLog($_SESSION["user_id"],"Nuevo Miembro Creado - ID: ".$miembro->idMiembro);
        else
            guardarLog($_SESSION["user_id"],"Miembro Editado - ID: ".$miembro->idMiembro);
    }
    
    $idMiembro = $miembro->idMiembro;
    $nombre = $miembro->nombre;
    $apellidos = $miembro->apellidos;
    $categoria = $miembro->categoria;
    $director = $miembro->director;
    $email = $miembro->email;
    $clave = $miembro->clave;
    $telefono = $miembro->telefono;
    $url = $miembro->url;
    $departamento = $miembro->departamento;
    $centro = $miembro->centro;
    $universidad = $miembro->universidad;
    $direccion = $miembro->direccion;
    $foto = $miembro->foto;
    $rol = $miembro->rol;
    $bloqueado = $miembro->bloqueado;
    $activo = $miembro->activo;
    
}

if(isset($_GET["idMiembro"]) && $_GET["idMiembro"] != 0){
    $idMiembro = $_GET["idMiembro"];
    $miembro = new Miembro($idMiembro);
    
    $nombre = $miembro->nombre;
    $apellidos = $miembro->apellidos;
    $categoria = $miembro->categoria;
    $director = $miembro->director;
    $email = $miembro->email;
    $clave = $miembro->clave;
    $telefono = $miembro->telefono;
    $url = $miembro->url;
    $departamento = $miembro->departamento;
    $centro = $miembro->centro;
    $universidad = $miembro->universidad;
    $direccion = $miembro->direccion;
    $foto = $miembro->foto;
    $rol = $miembro->rol;
    $bloqueado = $miembro->bloqueado;
    $activo = $miembro->activo;
    $formato = $miembro->formato;
    $titulo_web = "Editar Miembro";
}

?>

<div id="page-wrapper">
    <div class="row">
        <?php
        if($mostrarMensaje == 1){
            ?>
            <div class="col-lg-12">
                <div class="<?php echo $class;?>">
                    <?php echo $mensaje;?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $titulo_web;?></h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Datos del miembro
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form id="miembro_form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="accion" value="guardar">
                            <input type="hidden" name="idMiembro" value="<?php echo $idMiembro;?>">
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Enter text" value="<?php echo $nombre;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellidos:</label>
                                        <input type="text" class="form-control" placeholder="Enter text" name="apellidos" id="apellidos" value="<?php echo $apellidos;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Categoría:</label>
                                        <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Enter text" value="<?php echo $categoria;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Director del Grupo:</label>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="director" value="1" <?php if($director == 1) echo "checked";?>>Si
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="director" value="0" <?php if($director == 0) echo "checked";?>>No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter text" value="<?php echo $email;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Clave de acceso:</label>
                                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Enter text" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Teléfono:</label>
                                        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Enter text" value="<?php echo $telefono;?>">
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>URL personal:</label>
                                        <input type="url" class="form-control" id="url" name="url" placeholder="Enter text" value="<?php echo $url;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Universidad o Instituto de investigación:</label>
                                        <input type="text" class="form-control" id="universidad" name="universidad" placeholder="Enter text" value="<?php echo $universidad;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Centro:</label>
                                        <input type="text" class="form-control" id="centro" name="centro" placeholder="Enter text" value="<?php echo $centro;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Departamento:</label>
                                        <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Enter text" value="<?php echo $departamento;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dirección postal completa:</label>
                                        <textarea type="text" class="form-control" id="direccion" name="direccion" rows="3" placeholder="Enter text"><?php echo $direccion;?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>Rol:</label>
                                        <select class="form-control" name="rol">
                                            <option value="2" <?php if($rol == 2) echo "selected";?>>Usuario</option>
                                            <option value="3" <?php if($rol == 3) echo "selected";?>>Administrador</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usuario bloqueado:</label>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="bloqueado" id="bloqueado_si" value="1" <?php if($bloqueado == 1) echo "checked";?>>Si
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="bloqueado" id="bloqueado_no" value="0" <?php if($bloqueado == 0) echo "checked";?>>No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usuario Activo:</label>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="activo" id="activo_si" value="1" <?php if($activo == 1) echo "checked";?>>Si
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="activo" id="activo_no" value="0" <?php if($activo == 0) echo "checked";?>>No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <label>Fotografía:</label>
                                    <input type="file" name="foto">
                                    
                                    <?php
                                    $archivo = '';
                                    if(file_exists("../fotos/miembros/".$idMiembro.".jpg")){
                                        $archivo = "../fotos/miembros/".$idMiembro.".jpg";
                                    }
                                    if(file_exists("../fotos/miembros/".$idMiembro.".jpeg")){
                                        $archivo = "../fotos/miembros/".$idMiembro.".jpeg";
                                    }
                                    if(file_exists("../fotos/miembros/".$idMiembro.".png")){
                                        $archivo = "../fotos/miembros/".$idMiembro.".png";
                                    }
                                    if(file_exists("../fotos/miembros/".$idMiembro.".gif")){
                                        $archivo = "../fotos/miembros/".$idMiembro.".gif";
                                    }
                                    if($archivo != ''){
                                        ?>
                                        <img src='<?php echo $archivo;?>' style='width:120px;'>
                                        <?php
                                    }
                                    ?>
                                  
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="enviar" type="submit" style="margin-top: 15px" class="btn btn-primary" value="Enviar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- /#page-wrapper -->
        
<?php
    require_once('../include/footer.php');
?>

<script type="text/javascript">
    $("#enviar").click(function(event){
        event.preventDefault();
        // Validamos el formulario
        if($("#nombre").val() == ""){
            alert("Introduzca un nombre.");
            $("#nombre").focus();
            return;
        }else{
            var aux = $("#nombre").val();
            var reg = (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca un nombre válido.");
                $("#nombre").focus();
                return;
            }
        }
        if($("#apellidos").val() == ""){
            alert("Introduzca al menos un apellido.");
            $("#apellidos").focus();
            return;
        }else{
            var aux = $("#apellidos").val();
            var reg = (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca un apellido válido.");
                $("#apellidos").focus();
                return;
            }
        }
        if($("#email").val() == ""){
            alert("Introduzca el correo electrónico.");
            $("#email").focus();
            return;
        }
        if($("#clave").val() == ""){
            alert("Introduzca una clave.");
            $("#clave").focus();
            return;
        }else{
            var aux = $("#clave").val();
            var reg = (/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca una contraseña válida.");
                $("#clave").focus();
                return;
            }
        }
        if($("#telefono").val() == ""){
            alert("Introduzca el telefono.");
            $("#telefono").focus();
            return;
        }else{
            var aux = $("#telefono").val();
            var reg = (/^[0-9]{9}$/);
            if(! reg.test(aux)){
                alert("Introduzca un teléfono válido.");
                $("#telefono").focus();
                return;
            }
        }
        if($("#url").val() == ""){
            alert("Introduzca la url correctamente.");
            $("#url").focus();
            return;
        }
        if($("#universidad").val() == ""){
            alert("Introduzca la universidad.");
            $("#universidad").focus();
            return;
        }else{
            var aux = $("#universidad").val();
            var reg = (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca una universidad válida.");
                $("#universidad").focus();
                return;
            }
        }
        if($("#direccion").val() == ""){
            alert("Introduzca la dirección.");
            $("#direccion").focus();
            return;
        }else{
            var aux = $("#direccion").val();
            var reg = (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_/\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca una dirección válida.");
                $("#direccion").focus();
                return;
            }
        }
        if($("#tipo").val() == ""){
            alert("Introduzca el tipo de usuario.");
            $("#tipo").focus();
            return;
        }
        // Enviamos el formulario si todo ha ido bien
        $("#miembro_form").submit();
    });
</script>