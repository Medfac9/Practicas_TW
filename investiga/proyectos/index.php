<?php

require_once('../include/head.php');

$mostrarMensaje = 0;

/*
if(isset($_POST["accion"]) && $_POST["accion"] == "borrar"){
    $idProyecto = $_POST["idProyecto"];
    if($idProyecto > 0){
        $borrado = $idProyecto;
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        $stmt = $link->prepare("DELETE FROM proyecto WHERE idProyecto = ?");
        $stmt->bind_param('i',$idProyecto);
        if($stmt->execute()){
            $mensaje = "El Proyecto ha sido eliminado correctamente.";
            $class = "alert alert-success";
            $mostrarMensaje = 1;
            guardarLog($_SESSION["user_id"],"Proyecto Borrado - ID: ".$borrado);
        } else {
            $mensaje = "Se produjo un error al eliminar el Proyecto.";
            $class = "alert alert-danger";
            $mostrarMensaje = 1;
        }
    }
}
*/

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
            <h1 class="page-header">Proyectos</h1>
            <?php
            
            if(checkPermiso('PROYECT','escritura')){
                ?>
            
            <div class="row" style="margin-bottom:20px;">
                <div class="col-md-2">
                    <a href="formulario.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Nuevo
                    </a>
                </div>
            </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Proyectos
                </div>
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline collapsed" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                            <tr>
                                <th>Código</th>
                                <th style="width: 200px;">Título</th>
                                <th style="width: 300px;">Descripción</th>
                                <th>Publicaciones</th>
                                <th>Fecha</th>
                                <?php
                                    if(checkPermiso("MIEMB","escritura") || checkPermiso("MIEMB","borrado")){
                                        ?>
                                <th style="width: 150px;">Acciones</th>
                                        <?php
                                    }
                                ?>
                            </tr>
                            <?php
                            
                            $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
                            $link = $bbdd->conectar();
                            $idProyecto = 0;
                            $codigo = '';
                            $titulo = '';
                            $descripcion = '';
                            $fecha_fin = '';
                            $stmt = $link->prepare("SELECT idProyecto,codigo,titulo,descripcion,DATE_FORMAT(fecha_fin, '%d/%m/%Y') AS fecha_fin FROM proyecto ORDER BY fecha_fin DESC");
                            $stmt->execute();
                            $stmt->bind_result($idProyecto,$codigo,$titulo,$descripcion, $fecha_fin);
                            while($stmt->fetch()){
                                ?>
                            <tr id="proyecto_<?php echo $idProyecto;?>">
                                <td><?php echo $codigo;?></td>
                                <td><?php echo $titulo;?></td>
                                <td><?php echo $descripcion;?></td>
                                <td>
                                    <?php
                                    $sql = "SELECT idPublicacion,titulo FROM publicacion WHERE proyecto = ?";
                                    $link2 = $bbdd->conectar();
                                    $stmt2 = $link2->prepare($sql);
                                    $stmt2->bind_param('i',$idProyecto);
                                    if($stmt2->execute()){
                                        ?>
                                    <ul style="padding-left: 0px;">
                                            <?php
                                            $idPublicacion = '';
                                            $titulo = '';
                                            $stmt2->bind_result($idPublicacion,$titulo);
                                            while($stmt2->fetch()){
                                                ?>
                                            <li style="list-style: none"><a href='<?php echo _URL_."/publicaciones/formulario.php?idPublicacion=".$idPublicacion;?>'><?php echo $titulo;?></a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $fecha_fin;?></td>
                                <?php
                                if(checkPermiso("PROYECT","escritura") || checkPermiso("MIEMB","borrado")){
                                    echo("<td>");
                                    if(checkPermiso("PROYECT","escritura")){
                                        ?>
                                        <div class="col-md-6">
                                            <a href='formulario.php?idProyecto=<?php echo $idProyecto;?>' class="btn btn-square btn-default"  ><i class='fa fa-pencil'></i></a>
                                        </div>
                                        <?php
                                    }
                                    if(checkPermiso("PROYECT","borrado")){
                                        ?>
                                        <div class="col-md-6">
                                            <button class="btn btn-danger btn-square delete" onclick="borrarProyecto('<?php echo $idProyecto;?>')"><i class="fa fa-remove"></i></button>
                                        </div>
                                        <?php
                                    }
                                    echo("</td>");
                                }
                                ?>
                            </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>   
</div>

<?php

require_once('../include/footer.php');

?>


<script type="text/javascript">
    function borrarProyecto(id){
        if(confirm("¿Seguro que quieres borrar este proyecto?")){
            // 1: AJAX Borra el proyecto
            var parametros = {
                "idProyecto" : id,
                "accion": "borrar_proyecto"
            };
            $.ajax({
                data: parametros,
                url: "<?php echo _URL_;?>/include/funciones_ajax.php",
                type: "post",
                success: function(response){
                    if(response == "0"){
                        alert("Se produjo un error.");
                    } else {
                        alert("Proyecto eliminado correctamente");
                        // 2: Borramos el bloque de Proyecto del HTML
                        $("#proyecto_"+id).remove();
                    }
                }
            });
        }
    }
</script>