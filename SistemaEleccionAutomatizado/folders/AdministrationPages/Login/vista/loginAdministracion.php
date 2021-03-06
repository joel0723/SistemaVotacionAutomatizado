<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../servicios/AdministrationHandler.php';
require_once '../../../objects/Administrador.php';

session_start();

$getUser = new AdministrationHandler('../../../databaseHandler');

if (isset($_SESSION['administracion'])) {

    header('Location: Administracion.php');
}

if (isset($_POST['usuario']) && isset($_POST['clave'])) {

    if ($_POST['usuario'] == "" || $_POST['clave'] == "") {
        echo "<script> alert('Llene los espacios en blanco.'); </script>";
    } else {

        $administrador = $getUser->getAdministrador($_POST['usuario'], $_POST['clave']);
        if ($administrador == true) {

            $_SESSION['administracion'] = json_encode($administrador);
            
            header('Location: Administracion.php');
        } else {
            echo "<script> alert('Credenciales incorrectas.'); </script>";
        }
    }
}

$layout = new Layout(true, 'Acceso de Administración', true);

?>

<?php $layout->Header(); ?>

<br>
<br>
<br>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form class="form-signin" action="loginAdministracion.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal text-center">Iniciar sesion</h1>
            <label for="usuario" class="sr-only">Usuario</label>
            <input type="text" id="usuario" class="form-control" placeholder="Usuario" name ='usuario' required>
            <br>
            <label for="clave" class="sr-only">Contraseña</label>
            <input type="password" id="clave" class="form-control" placeholder="Contraseña" name ='clave' required>
            <br>
            <div>
            <a class="btn btn-lg btn-danger text-center" href="..\..\..\..\index.php">Volver a inicio</a>
            <button class="btn btn-lg btn-success" type="submit">Iniciar sesión</button>
            </div>
            

        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $layout->Footer(); ?>