<?php
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    //query
    $sql="Select Status from Election";
    //execute the query
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($query);
    //Status=0 => election stopped
    if($row['Status']==0){
        echo '<script type="text/javascript">
                window.onload = function () { 
                window.location.href = "ResultPage6.php";
                }
                </script>';
    }
    //Status=1 => election going on
    else{
        echo '<script type="text/javascript">
                window.onload = function () { 
                window.location.href = "ResultErrorPage.php";
                }
                </script>';
    }
?>