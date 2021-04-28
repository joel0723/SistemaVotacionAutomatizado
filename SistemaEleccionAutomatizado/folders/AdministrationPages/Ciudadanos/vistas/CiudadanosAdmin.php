<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../Ciudadanos/servicios/CiudadanosHandler.php';
require_once '../../../objects/Ciudadanos.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

$layout = new Layout(true, 'Ciudadanos', false);
$dataCiudadanos = new CiudadanosHandler('../../../databaseHandler');
$puestosCiudadanos = $dataCiudadanos->getAll();

?>

<?php $layout->Header(); ?>
<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2"><a class="btn btn-success" href="agregarCiudadano.php">Agregar Ciudadano</a></div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <?php if ($puestosCiudadanos == "" || $puestosCiudadanos == null) : ?>
        <div class="col-md-4">
            <h2>No hay ciudadanos agregados.</h2>
        </div>

    <?php else : ?>
        <?php foreach ($puestosCiudadanos as $post) : ?>
            <div class="col-md-2">
                <div class="card" style="width: 14rem;">
                    <div class="card-body">
                        <h5 class="card-title "><?= $post->nombre;?> <?= $post->apellido;?></h5>
                        <ul class="list-group list-group-flush text-muted">
                            <li class="list-group-item">Cedula: <?= $post->cedula; ?></li>
                            <li class="list-group-item">Correo: <?= $post->email; ?></li>

                        </ul>
                        <br>
                        <?php if ($post->estado == 1) : ?>
                            <a href="../servicios/desactivarCiudadano.php?cedula=<?= $post->cedula; ?>" class="btn btn-warning">Desactivar</a>
                        <?php else : ?>
                            <a href="../servicios/activarCiudadano.php?cedula=<?= $post->cedula; ?>" class="btn btn-warning">Activar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $layout->Footer(); ?>