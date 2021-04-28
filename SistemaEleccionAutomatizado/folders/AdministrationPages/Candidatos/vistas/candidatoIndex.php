<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../objects/Candidatos.php';
require_once '../../../objects/Puestos.php';
require_once '../../../objects/Partidos.php';
require_once '../servicios/CandidatosHandler.php';
require_once '../../Partidos/servicios/PartidosHandler.php';
require_once '../../PuestoElectivo/servicios/PuestosHandler.php';
require_once '../../../iDataBase/IDatabase.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

$layout = new Layout(true, 'Candidatos', false);
$data   = new CandidatosHandler('../../../databaseHandler');
$dataPartido = new PartidosHandler('../../../databaseHandler');
$dataPuesto = new PuestosHandler('../../../databaseHandler');


$message    = " NO ACTIVO";
$background = " text-white bg-dark";
$directorio = "activarCandidato.php?id=";
$btnActivar = "Activar";

$candidatos = $data->getActive();

if (isset($_GET['id_puesto'])) {
    $candidatos = $data->getCandidateByPuesto($_GET['id_puesto']);
}

?>

<?php $layout->Header(); ?>


<div class="container " style="margin: auto auto auto 20%; width:auto">


    <div class="row">

        <div class="col-md-10"></div>
        <div class="col-md-2">
            <a href="agregarCandidato.php" type="submit" class="btn btn-success">Agregar candidato</a>
        </div>


        <?php if (empty($candidatos)) : ?>
            <div class="row">
                <h2>No hay candidatos</h2>


            </div>
        <?php else : ?>
            <?php foreach ($candidatos as $candidato) : ?>
                
                <?php if ($candidato->estado == 1) {
                    $message    = " ACTIVO";
                    $background = "";
                    $directorio = "desactivarCandidato.php?id=";
                    $btnActivar = "Desactivar";
                }
                ?><div class="col-md-4">
                    <div class="card<?php echo $background ?>" style="width: 18rem;">
                        <img src="<?php echo "../../../assets/images/candidatos/" . $candidato->foto_perfil ?>" class="card-img-top" alt=".">
                        <div class="card-body bg-secondary">
                            <h5 class="card-title text-white"><?php echo $candidato->nombre . " ". $candidato->apellido; ?></h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-secondary text-white"><strong>Postulado a:</strong> <?= $dataPuesto->getById($candidato->id_puesto)->nombre; ?></li>
                                <li class="list-group-item bg-secondary text-white"><strong>Partido:</strong> <?= $dataPartido->getById($candidato->id_partido)->nombre; ?></li>
                                <li class="list-group-item bg-secondary text-white"><strong>Estado: </strong><?php echo $message; ?></li>
                            </ul>

                            <a href="editarCandidato.php?id=<?php echo $candidato->id_candidato; ?>" class="btn btn-warning">Editar</a>

                            <a href="../servicios/<?php echo $directorio . $candidato->id_candidato; ?>" class="btn btn-danger"><?php echo $btnActivar ?></a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>


        <?php endif; ?>
        <?php ?>

    </div>
</div>

<?php $layout->Footer(); ?>