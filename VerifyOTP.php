<?php
    session_start();
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        if( isset($_POST['voter_otp'])){
            $otp=$_POST['voter_otp'];
            if($otp==$_SESSION['otp']){
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Successful!"); 
                        window.location.href = "VoterChangePassword.php";
                        }
                        </script>';
            }
            else{
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("OTP is incorrect!"); 
                        window.location.href = "ForgotPasswordVoter.php";
                        }
                        </script>';
            }
        }
        else if( isset($_POST['admin_otp'])){
            $otp=$_POST['admin_otp'];
            if($otp==$_SESSION['otp']){
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Successful!"); 
                        window.location.href = "AdminChangePassword.php";
                        }
                        </script>';
            }
            else{
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("OTP is incorrect!"); 
                        window.location.href = "ForgotPasswordAdmin.php";
                        }
                        </script>';
            }
        }
        else{
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Some error occured!"); 
                        window.location.href = "EVotingMain1.php";
                        }
                        </script>';
        }
        
    }
?>