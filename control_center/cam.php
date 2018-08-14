<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Cam
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="assets/web-fonts-with-css/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
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
            <a href="./tools.html">
              <i class="fas fa-wrench"></i>
              <p>Tools</p>
            </a>
          </li>
          <li>
            <a href="./channels.html">
              <i class="now-ui-icons design_app"></i>
              <p>Channels</p>
            </a>
          </li>
          <li>
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
          <li class="active">
            <a href="./cam.php">
              <i class="fa fa-camera"></i>
              <p>Cam</p>
            </a>
          </li>
          <li>
            <a href="./jobs.php">
              <i class="fas fa-tasks"></i>
              <p>Jobs</p>
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
            <a class="navbar-brand" href="#pablo">Naza V2</a>
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
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                Camera
              </div>
              <div class="card-body ">

                <!-- The Canvas size specified here is the "initial" internal resolution. jsmpeg will
                  change this internal resolution to whatever the source provides. The size the
                  canvas is displayed on the website is dictated by the CSS style.
                -->
                <!-- style="width: 100%;" -->
                <canvas id="videoCanvas">
                  <p>
                    Please use a browser that supports the Canvas Element, like
                    <a href="http://www.google.com/chrome">Chrome</a>,
                    <a href="http://www.mozilla.com/firefox/">Firefox</a>,
                    <a href="http://www.apple.com/safari/">Safari</a> or Internet Explorer 10
                  </p>
                </canvas>
                <script type="text/javascript" src="tools/cam_stream/jsmpg.js"></script>
                <script type="text/javascript">
                  // Show loading notice
                  var canvas = document.getElementById('videoCanvas');
                  var ctx = canvas.getContext('2d');
                  ctx.fillStyle = '#444';
                  ctx.fillText('Loading...', canvas.width/2-30, canvas.height/3);

                  // Setup the WebSocket connection and start the player
                  var client = new WebSocket('ws://' + window.location.hostname + ':8084/');
                  var player = new jsmpeg(client, {canvas:canvas});
                </script>

                <div class="card">
                  <h5 class="card-header">Recorder</h5>
                  <div class="card-body">
                    <button id="startrecording" type="button" class="btn btn-primary">Start recording</button>
                    <button id="stoprecording" type="button" class="btn btn-light">Stoping recording</button> <br> <br>
                    <p>Status: <span id="stat" class="badge badge-primary"></span></p> <br>
                    <p>Latest Refresh: <span id="latestrefresh"></span></p>
                  </div>
                </div>
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

  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script type="text/javascript">
  function getRecordStat() {
    $.ajax("http://"+window.location.hostname+":4444?record=stat", {
            success: function(data) {

              $("#stat").text(data);

              $("#latestrefresh").text(new Date().toUTCString());

            },error: function() {  }  });
    }
  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }
  async function sync(){
    do {
      await sleep(1000);
      getRecordStat();
    } while (1){}
  }

  $(document).ready(function() {
    sync();
  });

  $("#startrecording").click(function(){
    $.ajax("http://"+window.location.hostname+":4444?record=on", {success: function(data){},error: function(){}});
  });

  $("#stoprecording").click(function(){
    $.ajax("http://"+window.location.hostname+":4444?record=off", {success: function(data) {},error: function(){}});
  });
  </script>
</body>

</html>
