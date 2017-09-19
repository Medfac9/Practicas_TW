<?php

require_once('../include/funciones.php');

if(!checkPermiso('PUBLI','escritura')){
    redirigir(_URL_.'/accesoDenegado.php');
}

require_once('../include/head.php');
require_once('../class/publicacion.php');

$publicacion = new Publicacion();

$tipo = '';
$doi = '';
$titulo = '';
$autor = '';
$fecha = '';
$resumen = '';
$palabras = '';
$url = '';
$proyecto = '';
$nombre_r = '';
$volumen = '';
$paginas = '';
$editorial = '';
$editor = '';
$isbn = '';
$titulo_l = '';
$nombre_c = '';
$lugar = '';
$resena = '';
$otro = '';

$titulo_web = "Nueva Publicación";
$mostrarMensaje = 0;

$all_names_selected = '';
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

$tipoInicial = 'articulo';

$remove_row_icon = '<i class="remove_row fa fa-remove btn btn-danger" onclick="removeRow(this)"></i>';
$add_row_icon  = '<i class="add_row fa fa-plus btn btn-success" onclick="newRow()" ></i>';

if(isset($_POST["accion"]) && $_POST["accion"] == "guardar"){
    $modificar = 0;
    if($_POST["idPublicacion"] != 0)
        $modificar = 1;
    
    $publicacion->idPublicacion = $_POST["idPublicacion"];
    $publicacion->tipo = $_POST["tipo"];
    $publicacion->doi = $_POST["doi"];
    $publicacion->titulo = $_POST["titulo"];
    $publicacion->fecha = $_POST["fecha"];
    $publicacion->resumen = $_POST["resumen"];
    $publicacion->palabras = $_POST["palabras"];
    $publicacion->url = $_POST["url"];
    $publicacion->proyecto = $_POST["proyecto"];
    $publicacion->nombre_r = $_POST["nombre_r"];
    $publicacion->volumen = $_POST["volumen"];
    $publicacion->paginas = $_POST["paginas"];
    $publicacion->editorial = $_POST["editorial"];
    $publicacion->editor = $_POST["editor"];
    $publicacion->isbn = $_POST["isbn"];
    $publicacion->titulo_l = $_POST["titulo_l"];
    $publicacion->nombre_c = $_POST["nombre_c"];
    $publicacion->lugar = $_POST["lugar"];
    $publicacion->resena = $_POST["resena"];
    $publicacion->otro = $_POST["otro"];
    $all_names_selected = $_POST["autores"];
    $publicacion->autor = $all_names_selected;
    $tipoInicial = $publicacion->tipo;
    
    $resultado = $publicacion->guardar();
    
    if($resultado === false){
        $mostrarMensaje = 1;
        $class = "alert alert-danger";
        $mensaje = "No se han podido guardar los datos";
    } else {
        $mostrarMensaje = 1;
        $class = "alert alert-success";
        $mensaje = "Publicación guardada correctamente"; 
        $titulo_web = "Editar Publicación";
        if($modificar == 0)
            guardarLog($_SESSION["user_id"],"Nueva Publicación Creada - ID: ".$publicacion->idPublicacion);
        else
            guardarLog($_SESSION["user_id"],"Publicación Editada - ID: ".$publicacion->idPublicacion);
    }
    
    $idPublicacion = $publicacion->idPublicacion;
    $tipo = $publicacion->tipo;
    $doi = $publicacion->doi;
    $titulo = $publicacion->titulo;
    $autor = $publicacion->autor;
    $fecha = $publicacion->fecha;
    $resumen = $publicacion->resumen;
    $palabras = $publicacion->palabras;
    $url = $publicacion->url;
    $proyecto = $publicacion->proyecto;
    $nombre_r = $publicacion->nombre_r;
    $volumen = $publicacion->volumen;
    $paginas = $publicacion->paginas;
    $editorial = $publicacion->editorial;
    $editor = $publicacion->editor;
    $isbn = $publicacion->isbn;
    $titulo_l = $publicacion->titulo_l;
    $nombre_c = $publicacion->nombre_c;
    $lugar = $publicacion->lugar;
    $resena = $publicacion->resena;
    $otro = $publicacion->otro;
    
}

if(isset($_GET["idPublicacion"]) && $_GET["idPublicacion"] != 0){
    $idPublicacion = $_GET["idPublicacion"];
    $publicacion = new Publicacion($idPublicacion);
    
    $tipo = $publicacion->tipo;
    $doi = $publicacion->doi;
    $titulo = $publicacion->titulo;
    $all_names_selected = $publicacion->autor;
    $fecha = $publicacion->fecha;
    $resumen = $publicacion->resumen;
    $palabras = $publicacion->palabras;
    $url = $publicacion->url;
    $proyecto = $publicacion->proyecto;
    $nombre_r = $publicacion->nombre_r;
    $volumen = $publicacion->volumen;
    $paginas = $publicacion->paginas;
    $editorial = $publicacion->editorial;
    $editor = $publicacion->editor;
    $isbn = $publicacion->isbn;
    $titulo_l = $publicacion->titulo_l;
    $nombre_c = $publicacion->nombre_c;
    $lugar = $publicacion->lugar;
    $resena = $publicacion->resena;
    $otro = $publicacion->otro;
    $titulo_web = "Editar Publicación";
    $tipoInicial = $publicacion->tipo;
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
                    Datos de la publicación
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form id="publicacion_form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="accion" value="guardar">
                            <input type="hidden" name="idPublicacion" value="<?php echo $idPublicacion;?>">
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipos:</label>
                                        <select id = "tipo" name="tipo" class="form-control">
                                            <option id="1" value="articulo" <?php if($tipoInicial == "articulo") echo "selected";?>>Artículos en revistas</option>
                                            <option id="2" value="libro" <?php if($tipoInicial == "libro") echo "selected";?>>Libros</option>
                                            <option id="3" value="capitulo" <?php if($tipoInicial == "capitulo") echo "selected";?>>Capítulos de libro</option>
                                            <option id="4" value="conferencia" <?php if($tipoInicial == "conferencia") echo "selected";?>>Participación en conferencias</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DOI:</label>
                                        <input type="text" class="form-control" id="doi" name="doi" placeholder="Enter text" value="<?php echo $doi;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Título del trabajo:</label>
                                        <input type="text" class="form-control" id="titulo"  name="titulo" placeholder="Enter text" value="<?php echo $titulo;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha de la publicación:</label>
                                        <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lista de autores:</label>
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
                                        <label>Otros autores:</label>
                                        <textarea type="text" class="form-control" id="otro"  name="otro" rows="3" placeholder="Enter text"> <?php echo $otro;?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Resumen:</label>
                                    <textarea type="text" class="form-control" rows="3" id="resumen"  name="resumen" placeholder="Enter text"> <?php echo $resumen;?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Proyecto vinculado:</label>
                                        <select name="proyecto" class="form-control">
                                            <?php
                                                $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
                                                $link = $bbdd->conectar();
                                                $stmt = $link->prepare("SELECT idProyecto, titulo, codigo FROM proyecto ORDER BY titulo");
                                                $idProyecto = 0;
                                                $tituloProyecto = '';
                                                $codigo = '';
                                                $stmt->execute();
                                                $stmt->bind_result($idProyecto,$tituloProyecto, $codigo);
                                                while($stmt->fetch()){
                                                    ?>
                                                    <option value='<?php echo $idProyecto;?>'><?php echo $codigo." - ".$tituloProyecto;?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Palabras clave:</label>
                                        <textarea type="text" class="form-control" id="palabras"  name="palabras" rows="3" placeholder="Enter text"> <?php echo $palabras;?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>URL para descargas:</label>
                                        <input type="url" class="form-control" id="url" name="url" placeholder="Enter text" value="<?php echo $url;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre de la revista:</label>
                                        <input type="text" class="form-control" id="nombre_r" name="nombre_r" placeholder="Enter text" value="<?php echo $nombre_r;?>" <?php if($tipoInicial != "articulo") echo "disabled";?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Volumen:</label>
                                        <input type="text" class="form-control" id="volumen" name="volumen" placeholder="Enter text" value="<?php echo $volumen;?>"  <?php if($tipoInicial != "articulo") echo "disabled";?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Páginas:</label>
                                        <input type="text" class="form-control" id="paginas" name="paginas" placeholder="Enter text" value="<?php echo $paginas;?>"  <?php if($tipoInicial != "articulo" && $tipoInicial != "capitulo") echo "disabled";?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Editorial:</label>
                                        <input type="text" class="form-control" id="editorial" name="editorial" placeholder="Enter text" value="<?php echo $editorial;?>"  <?php if($tipoInicial != "libro" && $tipoInicial != "capitulo") echo "disabled";?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Editor:</label>
                                        <input type="text" class="form-control" id="editor" name="editor" placeholder="Enter text" value="<?php echo $editor;?>" <?php if($tipoInicial != "libro" && $tipoInicial != "capitulo") echo "disabled";?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ISBN:</label>
                                        <input type="number" class="form-control" id="isbn" name="isbn" placeholder="Enter text" value="<?php echo $isbn;?>" <?php if($tipoInicial != "libro" && $tipoInicial != "capitulo") echo "disabled";?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Título del libro:</label>
                                        <input type="text" class="form-control" id="titulo_l" name="titulo_l" placeholder="Enter text" value="<?php echo $titulo_l;?>" <?php if($tipoInicial != "capitulo") echo "disabled";?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre de la conferencia:</label>
                                        <input type="text" class="form-control" id="nombre_c" name="nombre_c" placeholder="Enter text" value="<?php echo $nombre_c;?>" <?php if($tipoInicial != "conferencia") echo "disabled";?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row-border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lugar:</label>
                                        <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Enter text" value="<?php echo $lugar;?>" <?php if($tipoInicial != "conferencia") echo "disabled";?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reseña de la publicación:</label>
                                        <input type="text" class="form-control" id="resena" name="resena" placeholder="Enter text" value="<?php echo $resena;?>" <?php if($tipoInicial != "conferencia") echo "disabled";?>>
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
</div>
<!-- /#page-wrapper -->
        
<?php
    require_once('../include/footer.php');
?>

<script type="text/javascript">
    $("#enviar").click(function(event){
        event.preventDefault();
        // Validamos el formulario
        if($("#doi").val() == ""){
            alert("Introduzca un DOI.");
            $("#doi").focus();
            return;
        }else{
            var aux = $("#doi").val();
            var reg = (/^[0-9]+$/);
            if(! reg.test(aux)){
                alert("Introduzca un DOI válido.");
                $("#doi").focus();
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

        if($("#fecha").val() == ""){
            alert("Introduzca la fecha.");
            $("#fecha").focus();
            return;
        }
        if($("#resumen").val() == ""){
            alert("Introduzca un resumen.");
            $("#resumen").focus();
            return;
        }
        else{
            var aux = $("#resumen").val();
            var reg = (/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_,\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca un resumen válido.");
                $("#resumen").focus();
                return;
            }
        }
        if($("#palabras").val() == ""){
            alert("Introduzca al menos una palabra clave.");
            $("#palabras").focus();
            return;
        }
        else{
            var aux = $("#palabras").val();
            var reg = (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_,\s]+$/);
            if(! reg.test(aux)){
                alert("Introduzca una palabra válida.");
                $("#palabras").focus();
                return;
            }
        }
        if($("#url").val() == ""){
            alert("Introduzca la web.");
            $("#url").focus();
            return;
        }

        // Enviamos el formulario si todo ha ido bien
        $("#publicacion_form").submit();
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

function removeRow(element){
    // element es el objeto <i class='remove_row fa fa-remove' onclick='removeRow(this)'>
    // La función closest('tr') elige la linea (tr) en la que está incluido el i, y la borra.
    element.closest('tr').remove();
}

function habilitarTodos(){
    jQuery("#nombre_r").prop("disabled", false);
    jQuery("#volumen").prop("disabled", false);
    jQuery("#paginas").prop("disabled", false);
    jQuery("#editorial").prop("disabled", false);
    jQuery("#editor").prop("disabled", false);
    jQuery("#isbn").prop("disabled", false);
    jQuery("#titulo_l").prop("disabled", false);
    jQuery("#nombre_c").prop("disabled", false);
    jQuery("#lugar").prop("disabled", false);
    jQuery("#resena").prop("disabled", false);
} 
    
jQuery(document).ready(function(){
    
    jQuery("#fecha").datepicker({
        firstDay: 1,
        dayNames: dias,
        dayNamesMin: diasMin,
        dayNamesShort: diasShort,
        monthNames: meses,
        monthNamesShort: mesesShort,
        dateFormat: "dd-mm-yy"
    });   
    
    jQuery("#tipo").change(function(){
        console.log(jQuery("#tipo").val());
        if(jQuery("#tipo").val() == "articulo"){
            habilitarTodos();
            jQuery("#editorial").prop("disabled", true);
            jQuery("#editor").prop("disabled", true);
            jQuery("#isbn").prop("disabled", true);
            jQuery("#titulo_l").prop("disabled", true);
            jQuery("#nombre_c").prop("disabled", true);
            jQuery("#lugar").prop("disabled", true);
            jQuery("#resena").prop("disabled", true);
            jQuery("#editorial").val("");
            jQuery("#editor").val("");
            jQuery("#isbn").val("");
            jQuery("#titulo_l").val("");
            jQuery("#nombre_c").val("");
            jQuery("#lugar").val("");
            jQuery("#resena").val("");
        }
        if(jQuery("#tipo").val() == "libro"){
            habilitarTodos();            
            jQuery("#nombre_r").prop("disabled", true);
            jQuery("#volumen").prop("disabled", true);
            jQuery("#paginas").prop("disabled", true);
            jQuery("#titulo_l").prop("disabled", true);
            jQuery("#nombre_c").prop("disabled", true);
            jQuery("#lugar").prop("disabled", true);
            jQuery("#resena").prop("disabled", true);       
            jQuery("#nombre_r").val("");
            jQuery("#volumen").val("");
            jQuery("#paginas").val("");
            jQuery("#titulo_l").val("");
            jQuery("#nombre_c").val("");
            jQuery("#lugar").val("");
            jQuery("#resena").val("");
        }
        if(jQuery("#tipo").val() == "capitulo"){
            habilitarTodos();            
            jQuery("#nombre_r").prop("disabled", true);
            jQuery("#volumen").prop("disabled", true);
            jQuery("#nombre_c").prop("disabled", true);
            jQuery("#lugar").prop("disabled", true);
            jQuery("#resena").prop("disabled", true);
            jQuery("#nombre_r").val("");
            jQuery("#volumen").val("");
            jQuery("#nombre_c").val("");
            jQuery("#lugar").val("");
            jQuery("#resena").val("");
        }
        if(jQuery("#tipo").val() == "conferencia"){
            habilitarTodos();
            jQuery("#nombre_r").prop("disabled", true);
            jQuery("#volumen").prop("disabled", true);
            jQuery("#paginas").prop("disabled", true);
            jQuery("#editorial").prop("disabled", true);
            jQuery("#editor").prop("disabled", true);
            jQuery("#isbn").prop("disabled", true);
            jQuery("#titulo_l").prop("disabled", true);
            jQuery("#nombre_r").val("");
            jQuery("#volumen").val("");
            jQuery("#paginas").val("");
            jQuery("#editorial").val("");
            jQuery("#editor").val("");
            jQuery("#isbn").val("");
            jQuery("#titulo_l").val("");
        }
    }); 
});

</script>