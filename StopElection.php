<?php
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    $sql="SELECT Status from election";
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($query);
    //==> Election Status=1 : Election is going on
    if($query && $row['Status']==1){
        //make the election status as stopped
        $sql1="UPDATE election SET Status = 0";
        $q1=mysqli_query($con,$sql1);
        include('InsertIntoResult.php');
        echo'<script>
                window.location.href="ElectionStoppedPage.php";
                </script>';
    }
    //==> Election Status=0 : Election is stopped
    else{
        echo'<script>
                window.location.href="AlreadyStoppedPage.php";
                </script>';
    }
?>