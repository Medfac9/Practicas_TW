<?php

require_once('../include/funciones.php');

if(!checkPermiso('ADMINLOG','lectura')){
    redirigir(_URL_.'/accesoDenegado.php');
}

require_once('../include/head.php');

?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Log del Sistema</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Sucesos
                </div>
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline collapsed" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                            <tr>
                                <th>Miembro</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                            <?php
                            
                            $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
                            $link = $bbdd->conectar();
                            $idLog = 0;
                            $miembro = '';
                            $fecha = '';
                            $accion = '';
                            $stmt = $link->prepare("SELECT idLog,miembro,fecha,accion FROM log ORDER BY fecha DESC");
                            $stmt->execute();
                            $stmt->bind_result($idLog,$miembro,$fecha,$accion);
                            while($stmt->fetch()){
                                ?>
                            <tr>
                                <td><?php echo $miembro;?></td>
                                <td><?php echo $fecha;?></td>
                                <td><?php echo $accion;?></td>
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
