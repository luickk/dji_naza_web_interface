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
                            <li class="active">Jobs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                Jobs
                <div class="card-body ">
                <ul class="list-group">
                  <div id="screenList"></div>
                </ul> 
				<br> <br>
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
	<script src="ccenter.js"></script>
	<script>
	function startStream(){
	$.ajax("../jobs.php?action=start&command=sudo%20screen%20-dmS%20camStream%20bash%20-c%20%27python3%20/var/www/html/dji_naza_web_interface_2/control_center/tools/cam_stream/server.py%27", { success: function(data) {},error: function() {}  });
	}
	function startMission(mission_hold){
	$.ajax("../jobs.php?action=start&command=sudo%20screen%20-dmS%20"+mission_hold+"%20/var/www/html/dji_naza_web_interface_2/bins/missions/"+mission_hold+".exe", { success: function(data) {},error: function() {}  });
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
	<script type="text/javascript">
	$(document).ready( function () {
		$("#header").load("sidebar.html");
	});
	</script>
</body>
</html>
