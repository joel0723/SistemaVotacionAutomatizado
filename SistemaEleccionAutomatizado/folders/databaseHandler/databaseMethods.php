<?php

require_once 'databaseConnection.php';

class DataBaseMethods
{
    private $connection;

    function __construct($directory)
    {
        $this->connection = new databaseConnection($directory);
    }

    public function getAdministrador($user, $password)
    {

        $stm = $this->connection->db->prepare('Select * FROM administracion where usuario = ? and clave = ?');
        $stm->bind_param('ss', $user, $password);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row = $result->fetch_object();
            $user = new Administrador();

            $user->id_usuario = $row->id_usuario;
            $user->usuario = $row->usuario;
            $user->clave = $row->clave;
            $user->nombre = $row->nombre;
            $user->apellido = $row->apellido;
            $user->cedula = $row->cedula;

            $stm->close();
            return $user;
        }
    }

    public function getAdministradorById($id)
    {

        $stm = $this->connection->db->prepare('Select * FROM administracion where id_usuario = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row = $result->fetch_object();
            $user = new Administrador();

            $user->id_usuario = $row->id_usuario;
            $user->usuario = $row->usuario;
            $user->clave = $row->clave;
            $user->nombre = $row->nombre;
            $user->apellido = $row->apellido;
            $user->cedula = $row->cedula;

            $stm->close();
            return $user;
        }
    }

    public function getPuestosActivos()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Puestos WHERE estado = true');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Puestos();

                $user->id_puesto = $row->id_puesto;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    public function getPuestosInactivos()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Puestos WHERE estado = false');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Puestos();

                $user->id_puesto = $row->id_puesto;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    public function getPuestoById($id)
    {

        $stm = $this->connection->db->prepare('Select * FROM Puestos where id_puesto = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row = $result->fetch_object();
            $user = new Puestos();

            $user->id_puesto = $row->id_puesto;
            $user->nombre = $row->nombre;
            $user->descripcion = $row->descripcion;
            $user->estado = $row->estado;

            $stm->close();
            return $user;
        }
    }

    public function getCandidatesActives()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Candidatos WHERE estado = true');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Candidatos();

                $user->id_candidato = $row->id_candidato;
                $user->nombre = $row->nombre;
                $user->apellido = $row->apellido;
                $user->id_partido = $row->id_partido;
                $user->id_puesto = $row->id_puesto;
                $user->foto_perfil = $row->foto_perfil;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    public function addPuesto($puesto)
    {

        $stm = $this->connection->db->prepare('insert into Puestos(nombre,descripcion) VALUES(?,?)');
        $stm->bind_param('ss', $puesto->nombre, $puesto->descripcion);
        $stm->execute();
    }

    public function EditPuesto($puesto)
    {

        $stm = $this->connection->db->prepare('update Puestos set nombre = ?, descripcion = ? where id_puesto = ?');
        $stm->bind_param('ssi', $puesto->nombre, $puesto->descripcion, $puesto->id_puesto);
        $stm->execute();
    }

    public function DeshabilitarPuesto($id)
    {

        $stm = $this->connection->db->prepare('update Puestos set estado = false where id_puesto = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
    }

    public function HabilitarPuesto($id)
    {

        $stm = $this->connection->db->prepare('update Puestos set estado = true where id_puesto = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
    }

    public function getPartidosActives()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Partidos WHERE estado = true');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Partidos();

                $user->id_partido = $row->id_partido;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
                $user->logo = $row->logo;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    public function AddPartido($partido)
    {
        if (isset($_FILES['logo'])) {
            $logo = $_FILES['logo'];

            if ($logo['error'] == 4) {
                $partido->logo = "";
            } else {

                $typeReplace = str_replace("image/", "", $_FILES['logo']['type']);
                $type = $logo['type'];
                $size = $logo['size'];
                $name = $partido->nombre . '.' . $typeReplace;
                $timeFile = $logo['tmp_name'];

                $sucess = $this->uploadImage('../assets/images/partidos/', $name, $timeFile, $type, $size);

                if ($sucess) {

                    $partido->logo = $name;
                }
            }
        }

        $stm = $this->connection->db->prepare('insert into Partidos(nombre,descripcion,logo) VALUES(?,?,?)');
        $stm->bind_param('sss', $partido->nombre, $partido->descripcion, $partido->logo);
        $stm->execute();
    }

    public function EditarPartido($partido)
    {
        if (isset($_FILES['logo'])) {
            $logo = $_FILES['logo'];

            if ($logo['error'] == 4) {
                $partido->logo = "";
            } else {

                $typeReplace = str_replace("image/", "", $_FILES['logo']['type']);
                $type = $logo['type'];
                $size = $logo['size'];
                $name = $partido->nombre . '.' . $typeReplace;
                $timeFile = $logo['tmp_name'];

                $sucess = $this->uploadImage('../assets/images/partidos/', $name, $timeFile, $type, $size);

                if ($sucess) {

                    $partido->logo = $name;
                }
            }
        }

        $stm = $this->connection->db->prepare('update partidos set nombre = ?, descripcion = ?, logo = ? where id_partido = ?');
        $stm->bind_param('ssso', $partido->nombre, $partido->descripcion, $partido->logo, $partido->id_partido);
        $stm->execute();
    }

    public function HabilitarPartido($id)
    {

        $stm = $this->connection->db->prepare('update Partidos set estado = false where id_partido = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
    }

    public function DeshabilitarPartido($id)
    {

        $stm = $this->connection->db->prepare('update Partidos set estado = true where id_partido = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
    }
    private function uploadFile($name, $timeFile)
    {

        if (file_exists($name)) {

            unlink($name);
        }

        move_uploaded_file($timeFile, $name);
    }

    public function uploadImage($directory, $name, $timeFile, $type, $size)
    {

        $isSucess = false;
        if (($type == "image/gif")
            || ($type == "image/jpeg")
            || ($type == "image/png")
            || ($type == "image/jpg")
            || ($type == "image/JPG")
            || ($type == "image/jfif")
            || ($type == "image/pjpeg") && ($size < 1000000)
        ) {


            if (!file_exists($directory)) {

                mkdir($directory, 0777, true);

                if (file_exists($directory)) {

                    $this->uploadFile($directory . $name, $timeFile);
                    $isSucess = true;
                }
            } else {

                $this->uploadFile($directory . $name, $timeFile);
                $isSucess = true;
            }
        } else {

            $isSucess = false;
        }

        return $isSucess;
    }

}
