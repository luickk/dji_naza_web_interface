<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />

  <!-- Control Center Js -->
  <script src="ccenter.js"></script>

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <div class="logo">
        <a href="https://github.com/MrGrimod/dji_naza_interface_c-" class="simple-text logo-mini"></a>
        <a href="https://github.com/MrGrimod/dji_naza_interface_c-" class="simple-text logo-normal">
          Naza Interface
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="./dash.html">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="active">
            <a href="./conf.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Config</p>
            </a>
          </li>
          <li>
            <a href="./map.html">
              <i class="now-ui-icons location_map-big"></i>
              <p>GPS</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Naza PWM Config</h5>
              </div>
              <div class="card-body">
                <?php

                  $path = "/etc/naza/pwm_config.txt";

                  // include the class
                  include('../config/IniEditor.class.php');

                  // initialize the class object
                  $ini_editor = new IniEditor();

                  // include Javascript and CSS from jQuery and Bootstrap CDN
                  //echo IniEditor::getCssJsInclude();

                  // include class CSS (use your own if you prefer)
                  //echo IniEditor::getCSS();

                  // set folder where to put backups before saving the new version of the file (folder needs write permissions)
                  $ini_editor->setBackupFolder('backups');

                  // set the path of the file you want to edit or view
                  $ini_editor->setIniFile($path);

                  // set to true to allow edit of the config file (default is true)
                  $ini_editor->enableEdit(true);

                  // set to true to allow delete of conf in the config file (default is true)
                  $ini_editor->enableDelete(false);

                  // print the form. Use $ini_editor->getForm() to store it in a variable
                  $ini_editor->printForm();

                 ?>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <img src="assets/img/cali.png" alt="...">
              <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item"><span class="badge badge-warning">Middle:</span> Throttle Midpoint value <span class="badge badge-pill badge-warning">102 - 512</span></li>
                  <li class="list-group-item"><span class="badge badge-warning">Left:</span> Left side Throttle Endpoint value </li>
                  <li class="list-group-item"><span class="badge badge-warning">Middle:</span> Throttle Midpoint value <span class="badge badge-pill badge-warning">102 - 512</span></li>
                  <li class="list-group-item"><span class="badge badge-warning">Right:</span> Right side Throttle Endpoint value <span class="badge badge-pill badge-warning">102 - 512</span></li>
                  <li class="list-group-item"><span class="badge badge-warning">Stick motion:</span> Stick direction interpretation <span class="badge badge-pill badge-warning">rev / norm</span> </li>
                  <li class="list-group-item"><span class="badge badge-warning">Channel:</span> PWM Driverboard output channel <span class="badge badge-pill badge-warning">0 - 4</span> </li>
                  <li class="list-group-item"><span class="badge badge-secondary">GPS:</span> GPS Flightmode stick position value <span class="badge badge-pill badge-secondary">202 - 412</span></li>
                  <li class="list-group-item"><span class="badge badge-secondary">Failsafe:</span> Failsafe Flightmode stick position value <span class="badge badge-pill badge-secondary">202 - 412</span></li>
                  <li class="list-group-item"><span class="badge badge-secondary">Selectable:</span> Atti./ Manual Flightmode value <span class="badge badge-pill badge-secondary">202 - 412</span></li>
                </ul>

              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
</body>

</html>
