<?php
session_start();
session_destroy();
unset($_SESSION['uname']);
?>
<script>
window.location='../index.php'
</script>