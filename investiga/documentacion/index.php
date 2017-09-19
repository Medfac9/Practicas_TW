<?php

require_once('../include/head.php');

?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Documentación</h1>
        </div>
        <!-- /.col-lg-12 -->
        
        <h3>1. Manual de usuario</h3>
            <p>En este apartado explicaré cómo se utiliza la página web, cómo se realiza 
                la instalación del sistema y su desinstalación.</p>
            <p>Al acceder al sitio web nos encontramos con el inicio de la página, para 
                poder realizar la instalación del sistema debes pulsar <a href="<?php echo _URL_ .'/install/index.php'; ?>">
                aquí</a> y rellenar los campos con los siguientes datos:</p> 
            <center>
                <p>Servidor: localhost</p>
                <p>Base de datos: ramefa1617sep</p>
                <p>Usuario: ramefa1617sep</p>
                <p>Contraseña: HacXa2</p> 
            </center>
            <p>Al enviar el formulario, en la base de datos se crearán un conjunto de tablas si no están creadas. 
                A continuación, se deberá rellenar un formulario para crear un miembro administrador, el cual será 
                el primer usuario del sistema. Una vez creado, el sitio le redirige a la pantalla principal.</p>
            <p>En la pantalla principal se podrá interactuar con las distintas entradas del menú de navegación o 
                iniciar sesión con tu correo y contraseña si eres un usuario. Dependiendo del tipo de usuario que seas 
                (administrador o usuario) al iniciar sesión, el menú de navegación mostrará más o menos item.</p>
            <p>Para desinstalar el sistema debemos ir <a href="<?php echo _URL_ .'/install/unistall.php'; ?>">
                aquí</a> y en el formulario confirmar que se desea deinstalar el sistema.</p>
            <p>Para iniciar sesión como administrador, si no se ha creado un usuario en la instalación,
                se deberá usar los siguientes datos:</p>
            <center>
                <p>Correo: admin@correo.com</p>
                <p>Contraseña: rafa</p>
            </center>
            <p>Mientras que para iniciar sesión como usuario:</p>
            <center>
                <p>Correo: usuario@correo.com</p>
                <p>Contraseña: rafa</p>
            </center>
            <p>Una vez dentro, podremos navegar por los distintos sitios de la web que se explican a continuación.</p>
            <h4>1.1. Inicio</h4>
                <p>En la página de inicio podemos observar una breve descripción de la web, así como una fotografía y abajo, 
                    en el pie de la página, una serie de enlaces de contacto con el creador de la web.</p>
            <h4>1.2. Miembros del grupo</h4>
                <p>En esta sección podemos observar el listado de miembros de la investigación, colaboradores y asociados, 
                    los cuales se encuentran ordenados alfabéticamente.</p>
            <h4>1.3. Editar miembros</h4>
                <p>En esta sección solo puede acceder un administrador, el cual podrá agregar nuevos miembros pulsando el botón
                    "Nuevo", el cual le redirigirá a un formulario donde inscribirá al nuevo miembro. Del mismo modo, pulsando 
                    el botón <button class="btn btn-square btn-default"><i class='fa fa-pencil'></i></button>, el administrador 
                    podrá editar los datos de los usuarios. Y por último, si se pulsa el botón 
                    <button class="btn btn-danger btn-square delete"><i class='fa fa-remove'></i></button>, tras una 
                    confirmación, el administrador puede borrar un miembro.</p>
            <h4>1.4. Publicaciones</h4>
                <p>Aquí podemos ver un listado de publicaciones en orden cronológico, donde las publicaciones más recientes 
                    se muestran al principio y las más antiguas al final. Las publicaciones están asociadas a su proyecto 
                    correspondiente.</p>
            <h4>1.5. Editar publicaciones</h4>
                <p>En esta sección podemos ver un listado de publicaciones en orden cronológico, donde tanto los usuarios 
                    como los administradores pueden modificar, agregar y borrar publicaciones.</p>
            <h4>1.6. Proyectos</h4>
                <p>Aquí podemos ver un listado de los proyectos en orden cronológico, donde los proyectos más recientes salen 
                    al principio y los más antiguos al final. Cada proyecto tiene un número de publicaciones asociadas, las 
                    cuales se pueden contemplar si se pincha en el enlace de una publicación.</p>
            <h4>1.7. Editar proyectos</h4>
                <p>En esta sección podemos ver un listado de proyectos en orden cronológico, donde tanto los usuarios como los 
                    administradores pueden modificar, agregar y borrar proyectos.</p>
            <h4>1.8. Log del sistema</h4>
                <p>Este apartado solo puede ser visto por los administradores, quienes pueden observar la fecha y 
                    la hora de cualquier movimiento en la base de datos, registros, modificaciones y eliminaciones de 
                    usuarios, publicaciones y proyectos.</p>
            <h4>1.9. Backup</h4>
                <p>Este apartado, al cual solo podrán acceder los administradores, nos mostrará dos opciones. La primera
                    es la realización de una copia de seguridad el sistema, la cual se genera simplemente pulsando el botón
                    Backup. La segunda opción nos muestra un select de las copias de seguridad que tiene el sistema, y tras la
                    elección de una de ellas, pulsamos el botón Restaurar y el restauraremos la copia del sistema seleccionada.</p>
        <h3>2. Diseño E-R de la BBDD</h3>
            <h3>2.1. Esquema E-R</h3>
                <img style="width: 100%;" src="../fotos/e_r.png" alt="Esquema E-R" />
            <h3>2.2. Tablas de la base de datos</h3>
                <p>miembro(idMiembro, nombre, apellidos, categoria, director, email, clave, foto, telefono, 
                    direccion, url, universidad, centro, departamento, direccion, rol, activo, bloqueado, formato)</p>
                <p>proyecto(idProyecto, codigo, titulo, descripcion, fecha_ini, fecha_fin, entidad, cuantia, principal, 
                    colaborador, url)</p>
                <p>publicacion(idPublicacion, tipo, doi, titulo, autor, fecha, resumen, palabras, url, proyecto, 
                    nombre_r, volumen, paginas, editorial, editor, isbn, titulo_l, nombre_c, lugar, resena, otro)</p>
                <p>log(idLog, miembro, fecha, accion)</p>
                <p>menu(idMenu, nombre, url, icono, idPadre, orden, codigo)</p>
                <p>permisos(idPermiso, codigo, tipo)</p>
                <p>roles(idRol, nombre)</p>
                <p>Fusión de tablas:</p>
                <p>permisosRoles(id, idPermiso, idRol)</p>
                <p>miembrosPublicaciones(idMiembro, idPublicacion)</p>
                <p>Las id son las claves primarias.</p>
        <h3>3. Elementos más relevantes del desarrollo</h3>
            <h4>3.1. Maquetación de la página</h4>
                <img src="../fotos/cajas.png" alt="Maquetación" />
                <p>El layout de la web es común en todas las páginas.</p>
                <p>En la cabecera siempre encontramos la misma estructura, el logo de la web a la izquierda, 
                    y a la derecha iniciar sesión si no estamos logeados o nuestro nombre de usuario y cerrar sesión.</p>
                <p>En la navegación, dependiendo de si estamos logeados o no y si somos usuarios o administradores 
                    podremos ver más o menos item.</p>
                <p>En el pie, siempre encontramos los mismos datos, información sobre el copyright y una
                    serie de botones de contacto.</p>
                <p>El contenido del cuerpo puede ir variando según la página en la que nos encontremos. Podremos 
                    ver formularios, cuerpos de texto o listas de contenido.</p>
            <h4>3.2. Código de la web</h4>
                <p>El código de la página web está repartido en diversas carpetas dependiendo el index.php
                    que se quiera visualizar.</p>
            <h4>3.3. AJAX</h4>
                <p>La tecnología de AJAX la utilizo a la hora de borrar miembros, publicaciones y proyectos. Con 
                    ella consigo que al borrar, por ejemplo, un usuario, no sea neceario recargar la 
                    web para ver que ese usuario ya no está, simplemente tras un aviso de si está seguro 
                    de borrar ese usuario el mismo desaparece, tanto en la web como en la base de datos.</p>
        <h3>4. Tecnología jQuery</h3>
            <p>La tecnología jQuery ha sido utilizada para la insercción de datos en los formularios. Gracias a 
                ella, si un dato obligatorio en el formulario ha quedado vacío, nos da un mensaje y nos redirigirá 
                el cursor al campo en concreto que está vacío. He decidido utilizar dicha tecnología ya que
                es algo más simple que JavaScript y para el apartado donde la he usado, nos aporta lo mismo.</p>
        
    </div>
    
</div>

<?php

require_once('../include/footer.php');

?>
