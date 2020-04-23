<?php
    session_start();
    session_destroy();
    echo "<script>
          window.alert('Logged Out Successfully')
          window.location = '../Home page/homie.php'</script>";
?>
