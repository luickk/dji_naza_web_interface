<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DJI Drone Web Interface</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

	<!-- Control Center Js -->
	<script src="ccenter.js"></script>
</head>
<body>


    <!-- Left Panel -->

    <aside id="header" class="left-panel">
	
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">PWM Config File</li>
                        </ol>
                    </div>
                </div>
            </div>
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
    <!-- Right Panel -->
	
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
	<script type="text/javascript">
	$(document).ready( function () {
		$("#header").load("sidebar.html");
	});
	</script>
</body>
</html>
