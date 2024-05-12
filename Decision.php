<?php
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    $query="SELECT * FROM votes";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==0){
        echo '<script type="text/javascript">
                window.onload = function () { 
                alert("No Votes yet!");
                window.location.href = "AdminPage7.php";
                }</script>';
    }
    else{
        echo '<script type="text/javascript">
                window.onload = function () { 
                window.location.href = "Votes.php";
                }</script>';
    }
?>