<?php
    session_start();
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $pass1=$_POST['pass1'];
        $pass2=$_POST['pass2'];
        $email=$_SESSION['gmail_id'];
        if($pass1==$pass2){
            $passhash=hash('sha256',$pass1);
            $sql = "UPDATE voter_list SET Password='$passhash' WHERE Email='$email'";
            $result = mysqli_query($con, $sql);
            if($result){
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Successfully changed password!"); 
                        window.location.href = "VoterLoginPage2.php";
                        }
                        </script>';
            }
            else{
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Some error occured!"); 
                        window.location.href = "VoterLoginPage2.php";
                        }
                        </script>';
            }
        }
        else{
            echo '<script type="text/javascript">
                    window.onload = function () { 
                    alert("Passwords dont match!"); 
                    window.location.href = "VoterChangePassword.php";
                    }
                    </script>';
        }
    }
?>