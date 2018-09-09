<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Jobs
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <!--- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> --->
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
          <li>
            <a href="./cam.php">
              <i class="fa fa-camera"></i>
              <p>Cam</p>
            </a>
          </li>
          <li class="active">
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
                Jobs
                <div class="card-body ">
                <button id="resync" type="button" class="btn btn-dark float-right"><i class="fas fa-sync" style="color: white;" aria-hidden="true"></i></button> <br> <br><br>
                <ul class="list-group">
                  <div id="screenList"></div>
                </ul> <br> <br>
                <p>Latest Refresh: <span id="latestrefresh"></span></p>
              </div>
            </div>
          </div>
          <div class="card ">
            <div class="card-header ">
              Create Jobs
              <div class="card-body ">
              <ul class="list-group">
                <li class="list-group-item list-group-item-danger">Mission  <button type="button" id="beginMission" class="btn btn-warning">Begin</button></li>
                <li class="list-group-item list-group-item-light">Camera Stream  <button type="button" id="startStream" class="btn btn-light">Start</button></li>
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
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <!-- Control Center Js -->
  <script src="ccenter.js"></script>
  <script>
  function startStream(){
    $.ajax("../jobs.php?action=start&command=sudo%20screen%20-dmS%20camStream%20bash%20-c%20%27python3%20/var/www/html/dji_naza_web_interface/control_center/tools/cam_stream/server.py%27", { success: function(data) {},error: function() {}  });
  }
  function startMission(mission_hold){
    $.ajax("../jobs.php?action=start&command=sudo%20screen%20-dmS%20"+mission_hold+"%20/var/www/html/dji_naza_web_interface/bins/missions/"+mission_hold+".exe", { success: function(data) {},error: function() {}  });
  }
  function syncScreens(){
      $.ajax({
        type: "POST",
          url: "assets/php/screenList.php",
          success: function(html){
              $("#screenList").html(html);
          }
      });
    }
    function sleep(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    }
    async function sync(){
      do {
        await sleep(1000);
        syncScreens();
        $("#latestrefresh").text(new Date().toUTCString());
      } while (1){}
    }

    $(document).ready(function() {
      sync();
    });
    $("#resync").click(function(){
      syncScreens();
    });
    $("#beginMission").click(function(){
      startMission("mission_hold");
    });
    $("#startStream").click(function(){
      startStream();
    });
  </script>
</body>

</html>
