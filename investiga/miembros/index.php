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
            <h1 class="page-header">Miembros</h1>
            <?php
            
            if(checkPermiso('MIEMB','escritura')){
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
                    Lista de Miembros
                </div>
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline collapsed" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                            <tr>
                                <th style="width: 150px;">Foto</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Universidad</th>
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
                            $idMiembro = 0;
                            $nombre = '';
                            $apellidos = '';
                            $email = '';
                            $universidad = '';
                            $formato = '';
                            $stmt = $link->prepare("SELECT idMiembro,nombre,apellidos,email,universidad,formato FROM miembro ORDER BY nombre");
                            $stmt->execute();
                            $stmt->bind_result($idMiembro,$nombre,$apellidos,$email,$universidad,$formato);
                            while($stmt->fetch()){
                                ?>
                            <tr id="miembro_<?php echo $idMiembro;?>">
                                <td><img src="../fotos/miembros/<?php echo $idMiembro;?>.<?php echo $formato;?>" style="max-width: 100%;"></td>
                                <td><?php echo $nombre." ".$apellidos;?></td>
                                <td><?php echo $email;?></td>
                                <td><?php echo $universidad;?></td>
                                <?php
                                if(checkPermiso("MIEMB","escritura") || checkPermiso("MIEMB","borrado")){
                                    echo("<td>");
                                    if(checkPermiso("MIEMB","escritura")){
                                        ?>
                                        <div class="col-md-6">
                                            <a href='formulario.php?idMiembro=<?php echo $idMiembro;?>' class="btn btn-square btn-default"  ><i class='fa fa-pencil'></i></a>
                                        </div>
                                        <?php
                                    }
                                    if(checkPermiso("MIEMB","borrado")){
                                        ?>
                                        <div class="col-md-6">
                                            <button class="btn btn-danger btn-square delete" onclick="borrarMiembro('<?php echo $idMiembro;?>')"><i class="fa fa-remove"></i></button>
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
    function borrarMiembro(id){
        if(confirm("¿Seguro que quieres borrar este miembro?")){
            // 1: AJAX Borra el miembro
            var parametros = {
                "idMiembro" : id,
                "accion": "borrar_miembro"
            };
            $.ajax({
                data: parametros,
                url: "<?php echo _URL_;?>/include/funciones_ajax.php",
                type: "post",
                success: function(response){
                    if(response == "0"){
                        alert("Se produjo un error.");
                    } else {
                        alert("Miembro eliminado correctamente");
                        // 2: Borramos el bloque de Miembro del HTML
                        $("#miembro_"+id).remove();
                    }
                }
            });
        }
    }
</script>