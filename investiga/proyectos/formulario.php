<?php

require_once('../include/funciones.php');

if(!checkPermiso('PUBLI','escritura')){
    redirigir(_URL_.'/accesoDenegado.php');
}

require_once('../include/head.php');
require_once('../class/proyecto.php');

$proyecto = new Proyecto();

$codigo = '';
$titulo = '';
$descripcion = '';
$fecha_ini = '';
$fecha_fin = '';
$entidad = '';
$cuantia = '';
$principal = '';
$colaborador = '';
$principal_otro = '';
$colaborador_otro = '';
$url = '';

$titulo_web = "Nuevo Proyecto";
$mostrarMensaje = 0;

$all_names_selected = '';
$all_names_selected_2 = '';
$all_names = array();

$bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
$link = $bbdd->conectar();
$stmt = $link->prepare("SELECT idMiembro, nombre, apellidos FROM miembro");
$stmt->execute();
$idMiembro = '';
$nombre = '';
$apellidos = '';
$stmt->bind_result($idMiembro,$nombre,$apellidos);
while($stmt->fetch()){
    $all_names[$idMiembro] = $nombre." ".$apellidos;
}

$remove_row_icon = '<i class="remove_row fa fa-remove btn btn-danger" onclick="removeRow(this)"></i>';
$add_row_icon  = '<i class="add_row fa fa-plus btn btn-success" onclick="newRow()" ></i>';
$add_row_icon_2  = '<i class="add_row fa fa-plus btn btn-success" onclick="newRow2()" ></i>';


if(isset($_POST["accion"]) && $_POST["accion"] == "guardar"){
    $modificar = 0;
    if($_POST["idProyecto"] != 0)
        $modificar = 1;
    
    $proyecto->idProyecto = $_POST["idProyecto"];
    $proyecto->codigo = $_POST["codigo"];
    $proyecto->titulo = $_POST["titulo"];
    $proyecto->descripcion = $_POST["descripcion"];
    $proyecto->fecha_ini = $_POST["fecha_ini"];
    $proyecto->fecha_fin = $_POST["fecha_fin"];
    $proyecto->entidad = $_POST["entidad"];
    $proyecto->cuantia = $_POST["cuantia"];
    $proyecto->principal_otro = $_POST["principal_otro"];
    $proyecto->colaborador_otro = $_POST["colaborador_otro"];
    $proyecto->url = $_POST["url"];
    $all_names_selected = $_POST["autores"];
    $proyecto->principal = $all_names_selected;
    $all_names_selected_2 = $_POST["autores2"];
    $proyecto->colaborador = $all_names_selected_2;
    
    $resultado = $proyecto->guardar();
    
    if($resultado === false){
        $mostrarMensaje = 1;
        $class = "alert alert-danger";
        $mensaje = "No se han podido guardar los datos";
    } else {
        $mostrarMensaje = 1;
        $class = "alert alert-success";
        $mensaje = "Proyecto guardado correctamente";
        $titulo_web = "Editar Proyecto";
        if($modificar == 0){
            guardarLog($_SESSION["user_id"],"Nuevo Proyecto Creado - ID: ".$proyecto->idProyecto);
            $proyecto->principal = array_unique($proyecto->principal);
            $proyecto->colaborador = array_unique($proyecto->colaborador);
            foreach ($proyecto->principal as $autor){
                $tipo = 'principal';
                $stmt = $link->prepare("INSERT INTO miembrosProyectos (idMiembro,idProyecto,tipo) VALUES (?,?,?)");
                $stmt->bind_param('iis', $autor, $proyecto->idProyecto,$tipo);
                $stmt->execute();
            }
            
            foreach ($proyecto->colaborador as $autor){
                $tipo = 'colaborador';
                $stmt = $link->prepare("INSERT INTO miembrosProyectos (idMiembro,idProyecto,tipo) VALUES (?,?,?)");
                $stmt->bind_param('iis', $autor, $proyecto->idProyecto,$tipo);
                $stmt->execute();
            }
        }
        else
            guardarLog($_SESSION["user_id"],"Proyecto Editado - ID: ".$proyecto->idProyecto);     
    }
    
    $idProyecto = $proyecto->idProyecto;
    $codigo = $proyecto->codigo;
    $titulo = $proyecto->titulo;
    $descripcion = $proyecto->descripcion;
    $fecha_ini = $proyecto->fecha_ini;
    $fecha_fin = $proyecto->fecha_fin;
    $entidad = $proyecto->entidad;
    $cuantia = $proyecto->cuantia;
    $principal = $proyecto->principal;
    $colaborador = $proyecto->colaborador;
    $principal_otro = $proyecto->principal_otro;
    $colaborador_otro = $proyecto->colaborador_otro;
    $url = $proyecto->url;
}

if(isset($_GET["idProyecto"]) && $_GET["idProyecto"] != 0){
    $idProyecto = $_GET["idProyecto"];
    $proyecto = new Proyecto($idProyecto);
    
    $codigo = $proyecto->codigo;
    $titulo = $proyecto->titulo;
    $descripcion = $proyecto->descripcion;
    $fecha_ini = $proyecto->fecha_ini;
    $fecha_fin = $proyecto->fecha_fin;
    $entidad = $proyecto->entidad;
    $cuantia = $proyecto->cuantia;
    $url = $proyecto->url;
    $principal_otro = $proyecto->principal_otro;
    $colaborador_otro = $proyecto->colaborador_otro;
    $all_names_selected = $proyecto->principal;
    $all_names_selected_2 = $proyecto->colaborador;
    $titulo_web = "Editar Proyecto";
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
                    Datos del proyecto
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form id="proyecto_form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="accion" value="guardar">
                            <input type="hidden" name="idProyecto" value="<?php echo $idProyecto;?>">
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Código:</label>
                                        <input type="text" class="form-control" id="codigo"  name="codigo" placeholder="Enter text" value="<?php echo $codigo;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Título:</label>
                                        <input type="text" class="form-control" id="titulo"  name="titulo" placeholder="Enter text" value="<?php echo $titulo;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Descripción:</label>
                                        <textarea type="text" class="form-control" id="descripcion"  name="descripcion" rows="3" placeholder="Enter text"><?php echo "$descripcion";?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha de comienzo:</label>
                                        <input type="text" class="form-control" id="fecha_ini" name="fecha_ini" value="<?php echo $fecha_ini;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha de finalización:</label>
                                        <input type="text" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo $fecha_fin;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Entidades colaboradoras:</label>
                                        <input type="text" class="form-control" id="entidad"  name="entidad" placeholder="Enter text" value="<?php echo $entidad;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Investigador principal:</label>
                                        <table id="tableMiembros">
                                        <tr>
                                            <td><?php echo 'Nombre';?></td>
                                            <td><?php echo $add_row_icon;?></td>
                                        </tr>
                                        <?php 
                                        // Si hay alguno seleccionado (hemos enviado datos por POST)
                                        if($all_names_selected != ''){
                                            // Generamos la linea para cada seleccionado.
                                            foreach($all_names_selected as $a_name) { ?>
                                                <tr>
                                                <td>
                                                    <select name="autores[]">
                                                        <?php
                                                            // Generamos un select con todos, y seleccionamos el seleccionado
                                                            foreach($all_names as $key => $name){
                                                                ?>
                                                                    <option value="<?php echo $key;?>" <?php if($key == $a_name) echo "selected"; ?>><?php echo $name;?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td style="padding:5px;"><?php echo $remove_row_icon;?></td>
                                                </tr> <?php  
                                            }
                                        } else {
                                            // Aquí añadimos una linea, para empezar el formulario.
                                            ?>
                                            <tr>
                                            <td>
                                                <select name="autores[]">
                                                    <?php
                                                        foreach($all_names as $key => $name){
                                                        ?>
                                                            <option value="<?php echo $key;?>"><?php echo $name;?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                </select>
                                            </td>
                                            <td style="padding:5px;"><?php echo $remove_row_icon;?></td>
                                            </tr>
                                            <?php
                                        }?>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cuantía concedida:</label>
                                        <input type="text" class="form-control" id="cuantia"  name="cuantia" placeholder="Enter text" value="<?php echo $cuantia;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Investigadores colaboradores:</label>
                                        <table id="tableMiembros2">
                                        <tr>
                                            <td><?php echo 'Nombre';?></td>
                                            <td><?php echo $add_row_icon_2;?></td>
                                        </tr>
                                        <?php 
                                        // Si hay alguno seleccionado (hemos enviado datos por POST)
                                        if($all_names_selected_2 != ''){
                                            // Generamos la linea para cada seleccionado.
                                            foreach($all_names_selected_2 as $a_name) { ?>
                                                <tr>
                                                <td>
                                                    <select name="autores2[]">
                                                        <?php
                                                            // Generamos un select con todos, y seleccionamos el seleccionado
                                                            foreach($all_names as $key => $name){
                                                                ?>
                                                                    <option value="<?php echo $key;?>" <?php if($key == $a_name) echo "selected"; ?>><?php echo $name;?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td style="padding:5px;"><?php echo $remove_row_icon;?></td>
                                                </tr> <?php  
                                            }
                                        } else {
                                            // Aquí añadimos una linea, para empezar el formulario.
                                            ?>
                                            <tr>
                                            <td>
                                                <select name="autores2[]">
                                                    <?php
                                                        foreach($all_names as $key => $name){
                                                        ?>
                                                            <option value="<?php echo $key;?>"><?php echo $name;?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                </select>
                                            </td>
                                            <td style="padding:5px;"><?php echo $remove_row_icon;?></td>
                                            </tr>
                                            <?php
                                        }?>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>URL:</label>
                                        <input type="url" class="form-control" id="url"  name="url" placeholder="Enter text" value="<?php echo $url;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Otros autores principales:</label>
                                        <textarea type="text" class="form-control" id="principal_otro"  name="principal_otro" rows="3" placeholder="Enter text"> <?php echo $principal_otro;?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Otros autores colaboradores:</label>
                                        <textarea type="text" class="form-control" id="colaborador_otro"  name="colaborador_otro" rows="3" placeholder="Enter text"> <?php echo $colaborador_otro;?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Enviar" id="enviar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <table class="oculto" style="display: none;">
        <tbody id="filaMiembros">
        <tr>
            <td>
                <select name="autores[]">
                    <?php
                        foreach($all_names as $key => $name){
                        ?>
                            <option value="<?php echo $key;?>"><?php echo $name;?></option>
                        <?php
                        }
                        ?>
                </select>
            </td>
            <td style="padding:5px;"><?php echo $remove_row_icon;?></td>
        </tr>
        </tbody>
    </table>
    <table class="oculto" style="display: none;">
        <tbody id="filaMiembros2">
        <tr>
            <td>
                <select name="autores2[]">
                    <?php
                        foreach($all_names as $key => $name){
                        ?>
                            <option value="<?php echo $key;?>"><?php echo $name;?></option>
                        <?php
                        }
                        ?>
                </select>
            </td>
            <td style="padding:5px;"><?php echo $remove_row_icon;?></td>
        </tr>
        </tbody>
    </table>
</div>
<!-- /#page-wrapper -->
        
<?php
    require_once('../include/footer.php');
?>

<script type="text/javascript">
    $("#enviar").click(function(event){
        event.preventDefault();
        // Validamos el formulario
        if($("#codigo").val() == ""){
            alert("Introduzca un código.");
            $("#codigo").focus();
            return;
        }else{
            var aux = $("#codigo").val();
            var reg = (/^[0-9]+$/);
            if(! reg.test(aux)){
                alert("Introduzca un código válido.");
                $("#codigo").focus();
                return;
            }
        }

        if($("#titulo").val() == ""){
            alert("Introduzca un título.");
            $("#titulo").focus();
            return;
        }else{
            var aux = $("#titulo").val();
            var reg = (/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca un titulo válido.");
                $("#titulo").focus();
                return;
            }
        }
        if($("#descripcion").val() == ""){
            alert("Introduzca la descripción.");
            $("#descripcion").focus();
            return;
        }else{
            var aux = $("#descripcion").val();
            var reg = (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca una descripción válida.");
                $("#descripcion").focus();
                return;
            }
        }
        if($("#fecha_ini").val() == ""){
            alert("Introduzca la fecha de inicio.");
            $("#fecha_ini").focus();
            return;
        }
        if($("#fecha_fin").val() == ""){
            alert("Introduzca la fecha de finalización.");
            $("#fecha_fin").focus();
            return;
        }
        if($("#entidad").val() == ""){
            alert("Introduzca las entidades colaboradoras.");
            $("#entidad").focus();
            return;
        }else{
            var aux = $("#entidad").val();
            var reg = (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca una entidad válida.");
                $("#entidad").focus();
                return;
            }
        }
        if($("#cuantia").val() == ""){
            alert("Introduzca la cuantía.");
            $("#cuantia").focus();
            return;
        }else{
            var aux = $("#cuantia").val();
            var reg = (/^[0-9]+$/);
            if(! reg.test(aux)){
                alert("Introduzca una cuantia válida.");
                $("#cuantia").focus();
                return;
            }
        }
        
        if($("#url").val() == ""){
            alert("Introduzca la web.");
            $("#url").focus();
            return;
        }
        // Enviamos el formulario si todo ha ido bien
        $("#proyecto_form").submit();
    });
</script>

<script type="text/javascript">
    
var dias =  [ "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ]; 
var diasMin = [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ];
var diasShort = [ "Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb" ];
var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
var mesesShort = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
    
/**
* Lo habitual en estos casos es hacer un jQuery(document).ready(function(){ ... });
* ¿Cuál es el problema? Que cada vez que añadimos una nueva linea, es posterior a ese momento, es
* posterior a document.ready, y por tanto, no funciona el javascript con esas nuevas líneas.
* Lo ideal es hacer funciones y llamarlas con el onclick de cada elemento.
*/
function newRow(){
    var fila = jQuery("#filaMiembros").html();
    console.log(fila);
    jQuery("#tableMiembros").append(fila);
}

function newRow2(){
    var fila = jQuery("#filaMiembros2").html();
    console.log(fila);
    jQuery("#tableMiembros2").append(fila);
}

function removeRow(element){
    // element es el objeto <i class='remove_row fa fa-remove' onclick='removeRow(this)'>
    // La función closest('tr') elige la linea (tr) en la que está incluido el i, y la borra.
    element.closest('tr').remove();
}
    
jQuery(document).ready(function(){
    
    jQuery("#fecha_ini").datepicker({
        firstDay: 1,
        dayNames: dias,
        dayNamesMin: diasMin,
        dayNamesShort: diasShort,
        monthNames: meses,
        monthNamesShort: mesesShort,
        dateFormat: "dd-mm-yy"
    });
    
    jQuery("#fecha_fin").datepicker({
        firstDay: 1,
        dayNames: dias,
        dayNamesMin: diasMin,
        dayNamesShort: diasShort,
        monthNames: meses,
        monthNamesShort: mesesShort,
        dateFormat: "dd-mm-yy"
    });    
    
});

</script>

