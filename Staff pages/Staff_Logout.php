<?php
    session_start();
    session_destroy();
    echo "<script>
          window.alert('Logged Out Successfully')
          window.location = '../Staff pages/Staff_Login.php'</script>";
?>
