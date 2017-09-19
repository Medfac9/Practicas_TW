<?php

require_once('../include/head.php');

$mostrarMensaje = 0;

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
            <h1 class="page-header">Publicaciones</h1>
            <?php
            
            if(checkPermiso('PUBLI','escritura')){
                ?>
            
            <div class="row" style="margin-bottom:20px;">
                <div class="col-md-2">
                    <a href="formulario.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Nuevo
                    </a>
                </div>
            </div>
            <?php } ?>
            
            <form method="POST" id="formBusqueda" style="margin-bottom: 20px;">
                <div class="input-group custom-search-form">
                    <input type="hidden" name="accion" value="buscar">
                    <input name="palabras" type="text" class="form-control" placeholder="Buscar una palabra clave o varias separadas por comas...">
                    <span class="input-group-btn">
                        <button id="botonBuscar" class="btn btn-default" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Publicaciones
                </div>
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline collapsed" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                            <tr>
                                <th>Tipo de publicación</th>
                                <th>DOI</th>
                                <th>Resumen</th>
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
                            $idPublicacion = 0;
                            $tipo = '';
                            $doi = '';
                            $resumen = '';
                            $fecha = '';
                            $filtro = '';
                            $palabras = '';
                            $buscar = false;
                            $params = array();
                            $param_type = '';
                            $a_params = array();

                            if(isset($_POST["accion"]) && $_POST["accion"] == "buscar" && $_POST["palabras"] != ""){
                                $palabras = $_POST["palabras"];
                                $arrPalabras = explode(",",$palabras);
                                $primera = true;
                                foreach($arrPalabras as $ap){
                                    if($primera){
                                        $filtro .= " WHERE palabras LIKE ?";
                                        $primera = false;
                                    } else {
                                        $filtro .= " OR palabras LIKE ?";
                                    }
                                    $param_type .= 's';
                                    $params[] = "%".trim($ap)."%";
                                }
                            }
                            
                            $a_params = array();
                            $a_params[] = &$param_type;
                            foreach($params as $p){
                                $a_params[] = &$p;
                            }
                            
                            $sql = "SELECT idPublicacion,tipo,doi,resumen,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM publicacion ".$filtro." ORDER BY fecha DESC";
                      
                     
                            $stmt = $link->prepare($sql);
                            if($filtro != ''){
                                // debugArr($stmt,1);
                                //$stmt->bind_param('s',$palabras);
                                call_user_func_array(array($stmt, 'bind_param'), $a_params);
                            }
                            $stmt->execute();
                            $stmt->bind_result($idPublicacion,$tipo,$doi,$resumen, $fecha);
                            
                            while($stmt->fetch()){
                                if($tipo == 'libro')
                                    $tipo = 'Libros';
                                if($tipo == 'articulo')
                                    $tipo = 'Artículos';
                                if($tipo == 'capitulo')
                                    $tipo = 'Capítulos de libros';
                                if($tipo == 'conferencia')
                                    $tipo = 'Conferencias';
                                ?>
                            <tr id="publicacion_<?php echo $idPublicacion;?>">
                                <td><?php echo $tipo;?></td>
                                <td><?php echo $doi;?></td>
                                <td><?php echo $resumen;?></td>
                                <td><?php echo $fecha;?></td>
                                <?php
                                if(checkPermiso("PUBLI","escritura") || checkPermiso("PUBLI","borrado")){
                                    echo("<td>");
                                    if(checkPermiso("PUBLI","escritura")){
                                        ?>
                                        <div class="col-md-6">
                                            <a href='formulario.php?idPublicacion=<?php echo $idPublicacion;?>' class="btn btn-square btn-default"  ><i class='fa fa-pencil'></i></a>
                                        </div>
                                        <?php
                                    }
                                    if(checkPermiso("PUBLI","borrado")){
                                        ?>
                                        <div class="col-md-6">
                                            <button class="btn btn-danger btn-square delete" onclick="borrarPublicacion('<?php echo $idPublicacion;?>')"><i class="fa fa-remove"></i></button>
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
    function borrarPublicacion(id){
        if(confirm("¿Seguro que quieres borrar esta publicación?")){
            // 1: AJAX Borra la publicacion
            var parametros = {
                "idPublicacion" : id,
                "accion": "borrar_publicacion"
            };
            $.ajax({
                data: parametros,
                url: "<?php echo _URL_;?>/include/funciones_ajax.php",
                type: "post",
                success: function(response){
                    if(response == "0"){
                        alert("Se produjo un error.");
                    } else {
                        alert("Publicación eliminada correctamente");
                        // 2: Borramos el bloque de Publicación del HTML
                        $("#publicacion_"+id).remove();
                    }
                }
            });
        }
    }
</script>
