<?php

class Layout
{
    public $directory;
    public $action;
    public $title;
    public $type;
    public $logout;
    public $menu;

    function __construct($action, $title, $type)
    {
        $this->action    = $action;
        $this->directory = ($this->action) ? "../../../../" : "";
        $this->title     = $title;
        $this->type      = $type;
    }

    public function header()
    {
        $this->logout = ($this->type) ? $this->directory . "folders/VistaElector/login/servicio/logout.php" : $this->directory . "folders/AdministrationPages/Login/servicios/logoutAdministration.php";
        if ($this->type == false) {
            $this->menu = <<<EOF

            <h5 class="text-light text-center ">Opciones</h5><Br>
            <li class="nav-item">
            <a class="nav-link text-light" href="{$this->directory}folders\AdministrationPages\Ciudadanos/vistas\CiudadanosAdmin.php">
            <span data-feather="users"></span> Ciudadanos
            </a>
            </li><Br>

            <li class="nav-item">
            <a class="nav-link text-light" href="{$this->directory}folders\AdministrationPages\Candidatos/vistas\candidatoIndex.php">
            <span data-feather="users"></span> Candidatos
            </a>
            </li><Br>

            <li class="nav-item">
        <a class="nav-link text-light" href="{$this->directory}folders\AdministrationPages\PuestoElectivo/vistas\PuestoElectivo.php">
        <span data-feather="file"></span> Puesto Electivo
        </a>
        </li><Br>

        <li class="nav-item">
        <a class="nav-link text-light" href="{$this->directory}folders\AdministrationPages\Partidos/vistas\PartidoAdministracion.php">
        <span data-feather="layers"></span> Partidos
        </a>
        </li><Br>
       
        <li class="nav-item">
        <a class="nav-link text-light" href="{$this->directory}folders\AdministrationPages\Elecciones/vistas\EleccionesAdmin.php">
        <span data-feather="bar-chart-2"></span> Elecciones
        </a>
        </li><Br>
     
        EOF;
        } else {
            $this->menu = "";
        }

        $header = <<<EOF
        <!doctype html>
        <html lang="en">

        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>$this->title</title>

        <link href="{$this->directory}folders\css\librarys\bootstrap\bootstrap.min.css" rel="stylesheet">
        <link href="{$this->directory}folders\css\dashboard.css" rel="stylesheet">
        </head>

        <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
  <div class="container-fluid row">

  

        <a>///////////////////////////////////////</a>
    
    <strong><a class="navbar-brand text-light" href="{$this->directory}folders\AdministrationPages\Login/vista/Administracion.php">Administracion</a></strong>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
        <strong><a class="nav-link active text-light" aria-current="page" href="{$this->logout}">Votacion</a></strong>

        </li>
        <li class="nav-item">
        <strong><a class="nav-link active text-light" href="{$this->logout}">Log Out</a></strong>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container-fluid">
        <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
        <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
        </li>
        {$this->menu}
        </ul>
        </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="jumbotron bg-secondary">
        <h1 class="h2 text-center text-light">{$this->title}</h1>
        </div>
        </div>
        </main>
    </div>
    </div>
    </header>
    <body>
       

    
    </header>
    <body>

EOF;

        echo $header;
    }

    public function Footer()
    {

        $footer = <<<EOF
        


    </body></html>
    <script src="{$this->directory}folders\js\librarys\jquery\jquery-3.5.1.min.js"></script>
    <script src="{$this->directory}folders\js\librarys\bootstrap\bootstrap.min.js"></script>
    <script src="{$this->directory}folders/js/librarys/toastr/toastr.min.js"></script>
    <script src="{$this->directory}folders\js\librarys\jquery\jquery-3.5.1.min.js"></script>
EOF;

        echo $footer;
    }
}
