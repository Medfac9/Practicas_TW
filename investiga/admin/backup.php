<?php

require_once('../include/funciones.php');

if(!checkPermiso('ADMINBACK','lectura')){
    redirigir(_URL_.'/accesoDenegado.php');
}

require_once('../include/head.php');

$mostrarMensaje = 0;

if(isset($_POST["accion"]) && $_POST["accion"] == "guardar"){
    $dbhost = _BD_HOST_;
    $dbname = _BD_BBDD_;
    $dbuser = _BD_USER_;
    $dbpass = _BD_PASS_;

    $backup_file = date("Y-m-d-H-i-s") . ".sql";
    $command = "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname > $backup_file"; 

    // ejecución y salida de éxito o errores
    system($command,$output);
    
    if($output == 0){
        $mostrarMensaje = 1;
        $class = "alert alert-success";
        $mensaje = "Copia de seguridad generada correctamente";
    } else {
        $mostrarMensaje = 1;
        $class = "alert alert-danger";
        $mensaje = "No se pudo realizar la copia de seguridad";
    }
}

if(isset($_POST["accion"]) && $_POST["accion"] == "restaurar"){
    //Hay que poner el que se pinche, de momento pongo siempre el mismo
    $nombreArchivo = $_POST["restauracion"];
    
    $archivo = dirname(__FILE__).'/../admin/'.$nombreArchivo;
    
    $query = "DROP TABLE log";
    $bbdd->query($query);

    $query = "DROP TABLE publicacion";
    $bbdd->query($query);

    $query = "DROP TABLE proyecto";
    $bbdd->query($query);

    $query = "DROP TABLE miembro";
    $bbdd->query($query);

    $query = "DROP TABLE menu";
    $bbdd->query($query);

    $query = "DROP TABLE permisosRoles";
    $bbdd->query($query);

    $query = "DROP TABLE permisos";
    $bbdd->query($query);

    $query = "DROP TABLE roles";
    $bbdd->query($query); 

    $sql= file_get_contents($archivo);
    $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
    $result = $bbdd->multi_query($sql);

    if($result){
        $mostrarMensaje = 1;
        $class = "alert alert-success";
        $mensaje = "Copia de seguridad restaurada correctamente";
    } else {
        $mostrarMensaje = 1;
        $class = "alert alert-danger";
        $mensaje = "No se pudo restaurar la copia de seguridad";
    }

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
            <h1 class="page-header">Backup</h1>
        </div>
        <!-- /.col-lg-12 -->
        
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Copias de seguridad
                </div>
                <!-- .panel-heading -->
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">Backup</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                                <div class="panel-body">
                                    ¿Desea realizar un backup del sistema?
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="accion" value="guardar">
                                        <input id="enviar" type="submit" class="btn btn-success" value="Backup">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">Restaurar backup</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <!--Lista de los backup hechos y al pulsar uno pregunte si quiere restaurar ese backup y restaurarlo(ejecuta un script de .sql)-->
                                        ¿Qué copia de seguridad desea restaurar?<br/>
                                        <form id="confirmacion" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="accion" value="restaurar">
                                            <select name="restauracion">
                                                
                                                <?php
                                                    $directorio = opendir("."); //ruta actual


                                                    while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                                                    {
                                                        if (!is_dir($archivo))//verificamos si es o no un directorio
                                                        {
                                                            $cadena_buscada   = '20';
                                                            $posicion_coincidencia = strpos($archivo, $cadena_buscada);
                                                            //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
                                                            if ($posicion_coincidencia === 0) {
                                                                echo "<option value='$archivo'> $archivo </option>";
                                                            }
                                                        }   
                                                    }
                                                ?>
                                            </select>
                                            <input type="button" class="btn btn-success" onclick="restaurar()" value="Restaurar">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    
</div>

<?php

require_once('../include/footer.php');

?>

<script type="text/javascript">
    function restaurar(){
        var mensaje = confirm("¿Seguro que quieres restaurar esta copia?");
        if(mensaje){
            $("#confirmacion").submit();
        }
        else{
            return;
        }
    }
</script>
