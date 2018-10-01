<?php

$screens_raw = shell_exec ("sudo screen -ls");
$screens_expl = explode("\n", $screens_raw);
$screens_string = array_slice($screens_expl, 1, -2);
foreach($screens_string as $screen_string) {
    $screen_id_raw = explode(".", $screen_string);
    $screen_id = trim($screen_id_raw[0]);
    ?>
    <li class="list-group-item" style="padding: 20px;"><?php echo $screen_string; ?> <button type="button" id="stop_<?php echo $screen_id; ?>" class="btn btn-danger float-right"> Stop</button></li>
    <script>
      $("#stop_<?php echo $screen_id; ?>").click(function(){
        $.ajax("../jobs.php?action=stop&id=<?php echo $screen_id; ?>", { success: function(data) {},error: function() {}  });
      });
    </script>
    <?php
}
?>
