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
                            <li class="active">Camera</li>
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
