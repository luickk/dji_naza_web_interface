[1mdiff --git a/control_center/cam.html b/control_center/cam.html[m
[1mindex 34b497d..3e10d0d 100644[m
[1m--- a/control_center/cam.html[m
[1m+++ b/control_center/cam.html[m
[36m@@ -7,12 +7,12 @@[m
   <link rel="icon" type="image/png" href="assets/img/logo.png">[m
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />[m
   <title>[m
[31m-    Now UI Dashboard by Creative Tim[m
[32m+[m[32m    Cam[m[41m[m
   </title>[m
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />[m
   <!--     Fonts and icons     -->[m
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />[m
[31m-  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">[m
[32m+[m[32m  <link href="assets/web-fonts-with-css/css/all.css" rel="stylesheet">[m[41m[m
   <!-- CSS Files -->[m
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" />[m
   <link href="assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />[m
[36m@@ -49,10 +49,16 @@[m
               <p>GPS</p>[m
             </a>[m
           </li>[m
[32m+[m[32m          <li>[m[41m[m
[32m+[m[32m            <a href="./tools.html">[m[41m[m
[32m+[m[32m              <i class="fas fa-wrench"></i>[m[41m[m
[32m+[m[32m              <p>Tools</p>[m[41m[m
[32m+[m[32m            </a>[m[41m[m
[32m+[m[32m          </li>[m[41m[m
           <li class="active">[m
             <a href="./cam.html">[m
               <i class="fa fa-camera"></i>[m
[31m-              <p>GPS</p>[m
[32m+[m[32m              <p>Cam</p>[m[41m[m
             </a>[m
           </li>[m
         </ul>[m
[1mdiff --git a/control_center/ccenter.js b/control_center/ccenter.js[m
[1mindex 8e072ef..03e56ca 100644[m
[1m--- a/control_center/ccenter.js[m
[1m+++ b/control_center/ccenter.js[m
[36m@@ -16,6 +16,32 @@[m [mfunction perform_action(action, val) {[m
    });[m
 }[m
 [m
[32m+[m[41m[m
[32m+[m[32mfunction sync_gps_data() {[m[41m[m
[32m+[m[32m  $.ajax("../gps.php?all=1", {[m[41m[m
[32m+[m[32m    success: function(data) {[m[41m[m
[32m+[m[32m      $("#numberofsats").text(data.split(',')[0]);[m[41m[m
[32m+[m[32m      $("#alt").text(data.split(',')[4]);[m[41m[m
[32m+[m[32m      $("#heading").text(data.split(',')[3]);[m[41m[m
[32m+[m[32m      $("#latlon").text(data.split(',')[2] + "," + data.split(',')[1]);[m[41m[m
[32m+[m[32m      $("#latestrefresh").text(new Date().toUTCString());[m[41m[m
[32m+[m[32m    },[m[41m[m
[32m+[m[32m    error: function() {[m[41m[m
[32m+[m[41m[m
[32m+[m[32m    }[m[41m[m
[32m+[m[32m  });[m[41m[m
[32m+[m[32m}[m[41m[m
[32m+[m[41m[m
[32m+[m[32mfunction recalibrate() {[m[41m[m
[32m+[m[32m  $.ajax("../recalibrate.php", {[m[41m[m
[32m+[m[32m        success: function(data) {[m[41m[m
[32m+[m[32m          log_text(data);[m[41m[m
[32m+[m[32m        },[m[41m[m
[32m+[m[32m        error: function() {[m[41m[m
[32m+[m[41m[m
[32m+[m[32m        }[m[41m[m
[32m+[m[32m   });[m[41m[m
[32m+[m[32m}[m[41m[m
 function saveLogAsFile()[m
 {[m
     var textToWrite = $("#log_field").val();[m
[1mdiff --git a/control_center/channels.html b/control_center/channels.html[m
[1mindex 7b5f123..f436597 100644[m
[1m--- a/control_center/channels.html[m
[1m+++ b/control_center/channels.html[m
[36m@@ -7,12 +7,12 @@[m
   <link rel="icon" type="image/png" href="assets/img/logo.png">[m
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />[m
   <title>[m
[31m-    Dashboard[m
[32m+[m[32m    Channels[m
   </title>[m
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />[m
   <!--     Fonts and icons     -->[m
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />[m
[31m-  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">[m
[32m+[m[32m  <link href="assets/web-fonts-with-css/css/all.css" rel="stylesheet">[m
   <!-- CSS Files -->[m
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" />[m
   <link href="assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />[m
[36m@@ -54,6 +54,12 @@[m
             </a>[m
           </li>[m
           <li>[m
[32m+[m[32m            <a href="./tools.html">[m
[32m+[m[32m              <i class="fas fa-wrench"></i>[m
[32m+[m[32m              <p>Tools</p>[m
[32m+[m[32m            </a>[m
[32m+[m[32m          </li>[m
[32m+[m[32m          <li>[m
             <a href="./cam.html">[m
               <i class="fa fa-camera"></i>[m
               <p>Cam</p>[m
[1mdiff --git a/control_center/conf.php b/control_center/conf.php[m
[1mindex a5657cb..111ed7c 100755[m
[1m--- a/control_center/conf.php[m
[1m+++ b/control_center/conf.php[m
[36m@@ -12,7 +12,7 @@[m
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />[m
   <!--     Fonts and icons     -->[m
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />[m
[31m-  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">[m
[32m+[m[32m  <link href="assets/web-fonts-with-css/css/all.css" rel="stylesheet">[m
   <!-- CSS Files -->[m
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" />[m
   <link href="assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />[m
[36m@@ -54,6 +54,12 @@[m
             </a>[m
           </li>[m
           <li>[m
[32m+[m[32m            <a href="./tools.html">[m
[32m+[m[32m              <i class="fas fa-wrench"></i>[m
[32m+[m[32m              <p>Tools</p>[m
[32m+[m[32m            </a>[m
[32m+[m[32m          </li>[m
[32m+[m[32m          <li>[m
             <a href="./cam.html">[m
               <i class="fa fa-camera"></i>[m
               <p>Cam</p>[m
[1mdiff --git a/control_center/map.html b/control_center/map.html[m
[1mindex a19817b..6f61574 100644[m
[1m--- a/control_center/map.html[m
[1m+++ b/control_center/map.html[m
[36m@@ -7,17 +7,21 @@[m
   <link rel="icon" type="image/png" href="assets/img/logo.png">[m
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />[m
   <title>[m
[31m-    Now UI Dashboard by Creative Tim[m
[32m+[m[32m    Map[m
   </title>[m
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />[m
   <!--     Fonts and icons     -->[m
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />[m
[31m-  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">[m
[32m+[m[32m  <link href="assets/web-fonts-with-css/css/all.css" rel="stylesheet">[m
   <!-- CSS Files -->[m
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" />[m
   <link href="assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />[m
   <!-- CSS Just for demo purpose, don't include it in your project -->[m
   <link href="assets/demo/demo.css" rel="stylesheet" />[m
[32m+[m
[32m+[m[32m  <!-- Control Center Js -->[m
[32m+[m[32m  <script src="ccenter.js"></script>[m
[32m+[m
 </head>[m
 [m
 <body class="">[m
[36m@@ -50,6 +54,12 @@[m
             </a>[m
           </li>[m
           <li>[m
[32m+[m[32m            <a href="./tools.html">[m
[32m+[m[32m              <i class="fas fa-wrench"></i>[m
[32m+[m[32m              <p>Tools</p>[m
[32m+[m[32m            </a>[m
[32m+[m[32m          </li>[m
[32m+[m[32m          <li>[m
             <a href="./cam.html">[m
               <i class="fa fa-camera"></i>[m
               <p>Cam</p>[m
[36m@@ -87,10 +97,18 @@[m
           <div class="col-md-12">[m
             <div class="card ">[m
               <div class="card-header ">[m
[31m-                Google Maps[m
[32m+[m[32m                Serial GPS Data[m
[32m+[m[32m                <button id="refresh" type="button" class="btn btn-dark float-right"><i class="fas fa-sync" style="color: white;" aria-hidden="true"></i></button> <br> <br>[m
               </div>[m
               <div class="card-body ">[m
[31m-                <div id="map" class="map"></div>[m
[32m+[m[32m                <br>[m
[32m+[m[32m                <ul class="list-group">[m
[32m+[m[32m                  <li class="list-group-item active">Number of satellites:  <span class="badge badge-light" id="numberofsats"></span></li>[m
[32m+[m[32m                  <li class="list-group-item">Altitude: <span id="alt"></span></li>[m
[32m+[m[32m                  <li class="list-group-item">Heading:  <span id="heading"></span></li>[m
[32m+[m[32m                  <li class="list-group-item">Lat, Lon: <span id="latlon"></span></li>[m
[32m+[m[32m                  <li class="list-group-item">Latest Refresh: <span id="latestrefresh"></span></li>[m
[32m+[m[32m                </ul>[m
               </div>[m
             </div>[m
           </div>[m
[36m@@ -106,8 +124,6 @@[m
   <script src="assets/js/core/popper.min.js"></script>[m
   <script src="assets/js/core/bootstrap.min.js"></script>[m
   <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>[m
[31m-  <!--  Google Maps Plugin    -->[m
[31m-  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>[m
   <!-- Chart JS -->[m
   <script src="assets/js/plugins/chartjs.min.js"></script>[m
   <!--  Notifications Plugin    -->[m
[36m@@ -118,10 +134,15 @@[m
   <script src="assets/demo/demo.js"></script>[m
   <script>[m
     $(document).ready(function() {[m
[31m-      // Javascript method's body can be found in assets/js/demos.js[m
[31m-      demo.initGoogleMaps();[m
[32m+[m[32m      sync_gps_data();[m
     });[m
   </script>[m
[32m+[m[32m  <script type="text/javascript">[m
[32m+[m
[32m+[m[32m    $("#refresh").click(function(){[m
[32m+[m[32m      sync_gps_data();[m
[32m+[m[32m    });[m
[32m+[m[32m    </script>[m
 </body>[m
 [m
 </html>[m
[1mdiff --git a/gps.php b/gps.php[m
[1mindex f8674db..dcebbfc 100644[m
[1m--- a/gps.php[m
[1m+++ b/gps.php[m
[36m@@ -14,6 +14,7 @@[m [m$heading = $_GET["heading"];[m
 $lat = $_GET["lat"];[m
 $lon = $_GET["lon"];[m
 $numsat = $_GET["numsat"];[m
[32m+[m[32m$all = $_GET["all"];[m[41m[m
 [m
 $raw_gps_data = shell_exec ("sudo ./bins/rgps.exe");[m
 $gps_data = explode(",", $raw_gps_data);[m
[36m@@ -28,5 +29,7 @@[m [mif($alt!=""){[m
   echo $gps_data[1];[m
 } else if($numsat!=""){[m
   echo $gps_data[0];[m
[32m+[m[32m} else if($all!=""){[m[41m[m
[32m+[m[32m  echo $raw_gps_data;[m[41m[m
 }[m
 ?>[m
