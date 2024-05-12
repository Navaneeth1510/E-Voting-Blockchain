<?php
    session_destroy();
    echo '<script type="text/javascript">
            window.onload = function () { 
            window.location.href = "EVotingMain1.php";
            }</script>';
?>